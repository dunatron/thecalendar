<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30/01/17
 * Time: 11:28 AM
 */
class AddEventFindaEvents extends BuildTask
{
    // Guide for array conversion ->http://array.include-once.org/
    // Guide for array conversion ->http://array.include-once.org/

    protected $title = 'Add event finda events';

    protected $description = 'populate happ database with event finda events';

    public $apiUserName = 'whatshappnz';

    public $apiUserPass = '78nvbw7qn29x';

//    public  $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=10';
//    public  $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=10&,session:(timezone,datetime_start)&q=concert&order=popularity';

    // 20 is the max amount of events we can pull in
    //public  $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=20&session:(timezone,datetime_start)&q=concert&order=popularity';

    //public $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=20&session:(timezone,datetime_start)&q=concert&order=popularity';
    public $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=20&session:(timezone,datetime_start)&q=concert&order=popularity&location=126';
    //public $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=20&session:(timezone,datetime_start)&q=concert&order=popularity';

    /*
     * Generate number of api calls needed. Page has 20 events/rows
     */
    public function getOffsetPages($collection)
    {
        $count = $collection->{'@attributes'}->count;
        echo '<p>Event Count:' . $count . '</p>';
        $offset = $count / 20;
        $ceiling = ceil($offset);
        return $ceiling;
    }

    public function StoreEvents($collection)
    {
        foreach ($collection->events as $event) {

            echo '<p>' . $event->id . '</p>';
            // Check if we have this event already
            if (Event::get_by_finda_id('Event', $event->id) == false) {
                //create a new event
                $isNewEvent = true;
                $newEvent = Event::create();
                $newEvent->EventFindaID = $event->id;
                echo '<p style="color:green;">' . $event->name . ' created</p>';
            } else {
                //receive and update existing event
                $newEvent = Event::get_by_finda_id('Event', $event->id);
                $isNewEvent = false;
                echo '<p style="color:orange;">' . $event->name . ' updated</p>';
            }

            $newEvent->EventTitle = $event->name;
            $newEvent->EventFindaURL = $event->url;
            $newEvent->EventDescription = $event->description;
            $newEvent->CalendarPageID = 1;
            $newEvent->EventApproved = 1;
            $newEvent->IsEventFindaEvent = 1;
            $newEvent->EventVenue = $event->location->name;
            // venue name
            $newEvent->LocationText = $event->location->summary;
            // Location Summary
            $newEvent->LocationLat = $event->point->lat;
            // Lat address
            $newEvent->LocationLat = $event->point->lat;
            // Lon address
            $newEvent->LocationLon = $event->point->lng;
            // Event Date
            $newEvent->EventDate = $event->datetime_start;
            // Start Time
            $newEvent->StartTime = $event->datetime_start;
            // Finish Time
            $newEvent->FinishTime = $event->datetime_end;


            // Try store website if we have one. (just get the first site)
            if (!empty($event->web_sites->web_sites)) {
                $newEvent->TicketWebsite = $event->web_sites->web_sites[0]->url;
            }


            $newEvent->write(); // Must write event before we store image(or we dont know the events id)

            if($isNewEvent == true){
                $images = $event->images->images;
                $eventID = $newEvent->ID;
                // ToDo create check if is new image. If not dont run store images function
                $storeImage = $this->storeEventImage($images, $eventID);
            }else {
                continue;
            }

        }
    }

    /*
     * stores parsed images into event with the parsed id
     */
    public function storeEventImage($images, $eventID)
    {
        foreach ($images as $image) {

            echo '<h3>' . $image->id . "</h3>";
            // iterate over the transforms collection of transforms
            foreach ($image->transforms->transforms as $transform) {

                $checkImageExists = $this->checkRemoteFile($transform->url);
                if($checkImageExists == true){
                    echo '<p>Image exists</p>';

                    // ToDo | try 27 elseif
                    $rawFileName = $transform->url;
                    if(strpos($rawFileName, '?') !== false){
                        $fileName = substr($rawFileName, 0, strpos($rawFileName, "?"));
                    } else {
                        $fileName = $rawFileName;
                    }

                    if(!empty($fileName) ){
                        $file = EventImage::create();
                        $file->Filename = $fileName;
                        $string = 'event-finda-img-';
                        $file->Name = $string .= $fileName;
                        $file->transformation_id = $transform->transformation_id;

                        // associate file with event
                        $file->EventID = $eventID;

                        $file->write();
                    }

                    echo $transform->url . "\n";
                }else {
                    echo '<p>No Image</p>';
                }


            }
        }
        return;
    }

    public function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    /*
     * Default collection i.e 20 rows, no offset
     */
    public function getCollection()
    {
        $process = curl_init($this->apiURL);
        curl_setopt($process, CURLOPT_USERPWD, $this->apiUserName . ":" . $this->apiUserPass);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($process);

        $collection = json_decode($return);
        return $collection;
    }

    /*
     * Generate a collection from query input
     */
    public function dynamicCollection($query)
    {
        $process = curl_init($query);
        curl_setopt($process, CURLOPT_USERPWD, $this->apiUserName . ":" . $this->apiUserPass);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($process);

        $collection = json_decode($return);
        return $collection;
    }

    /*
     * Dynamic query which will add the offset vale
     */
    public function dynaQuery($count)
    {
        $addOffset = $count * 20;
        $rawQuery = $this->apiURL;
        $query = $rawQuery .= '&offset=' . $addOffset;
        return $query;
    }

    public function run($request)
    {
        $collection = $this->getCollection();
        $offset = $this->getOffsetPages($collection);

        echo '<h1>' . $offset . '</h1>';

        for ($i = 0; $i <= $offset; $i++) {
            $query = $this->dynaQuery($i);
            $c = $this->dynamicCollection($query);
            $saveCollection = $this->StoreEvents($c);
        }
        echo '<h1 style="color:green;">Events all stored/updated'.'</h1>';
    }

    /**
     *  Lists all of the locations/Regions in NZ | 15 in total on 30th Jan 2017
     *  http://api.eventfinda.co.nz/v2/locations.xml?rows=1&levels=2&fields=location:(id,url_slug,name,children)
     *
     * Northland = 1
     * Auckland = 2
     * The Coromandel = 41
     * [Hawke's Bay / Gisborne] = 6
     * Waikato = 3
     * Bay of Plenty = 4
     * Taranaki = 7
     * Manawatu / Whanganui = 9
     * Wellington Region = 11
     * Nelson / Tasman = 12
     * Marlborough = 13
     * West Coast = 14
     * Canterbury = 15
     * Otago = 17
     * Southland = 18
     *
     */

    /**
     * This below one will give us the children for the regions
     * http://api.eventfinda.co.nz/v2/locations.xml?rows=1&levels=3&fields=location:(id,url_slug,name,children)
     */

    /**
     * This guy is pulling 20 events from the Otago region with dunedin as its child which has id of 126
     * http://api.eventfinda.co.nz/v2/events.xml?rows=20&session:(timezone,datetime_start)&q=concert&order=popularity&location=126
     */


}