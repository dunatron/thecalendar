<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30/01/17
 * Time: 11:28 AM
 */
class AddEventFindaEvents extends BuildTask
{
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

    public function run($request)
    {
        $process = curl_init($this->apiURL);
        curl_setopt($process, CURLOPT_USERPWD, $this->apiUserName . ":" . $this->apiUserPass);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($process);

        $collection = json_decode($return);


        echo '<pre>'.var_export($return, true).'</pre>';
//        echo '<pre>'.var_export($totalEvents['@attributes'], true).'</pre>';

        //echo '<pre>'.var_export($totalEvents[1], true).'</pre>';

        die();

        foreach ($totalEvents['@attributes'] as $element){
            //echo 'pid: ' . $element['count'] . '<br />';
            echo 'hello';
        }
        die();

        foreach ($collection->events as $event) {

            // Check if we have this event already
            if (Event::get_by_finda_id('Event', $event->id) == false) {
                //create a new event
                $newEvent = Event::create();
                $newEvent->EventFindaID = $event->id;
            } else {
                //receive and update existing event
                $newEvent = Event::get_by_finda_id('Event', $event->id);
            }

            $newEvent->EventTitle = $event->name;
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

            // Try store website if we have one.
            if(!empty($event->web_sites)){
//                $newEvent->TicketWebsite = $event->web_sites->web_site->url;
                foreach ($event->web_sites as $site){
//                    echo '<pre>';
//                    var_export($site, true);
//                    echo '</pre>';
                    echo '<pre>';
                    var_dump($site);
                    echo '</pre>';
                    //echo $site['url'];
                }
            }

            $newEvent->write();

            // iterate over the images collection of images
//            foreach ($event->images->images as $image) {
//
//                echo '<h3>'.$image->id . "</h3>";
//                // iterate over the transforms collection of transforms
//                foreach ($image->transforms->transforms as $transform) {
//                    $file = EventImage::create();
//                    // ToDo | try 27 elseif
//                    $rawFileName = $transform->url;
//                    // filename
//                    $fileName = substr($rawFileName, 0, strpos($rawFileName, "?"));
//                    $file->fileName = $fileName;
//                    // associate file with event
//                    $file->EventID = $newEvent->ID;
//                    //$file->EventID = $newEvent;
//                    echo $fileName;
//                    $boss = $transform->transformation_id;
//
//                    echo '<p style="color:red;">'.$boss.'</p>';
//                    $file->write();
//
//                    echo $transform->url . "\n";
//                }
//            }


        }


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