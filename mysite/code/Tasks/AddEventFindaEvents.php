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

    public  $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=20&session:(timezone,datetime_start)&q=concert&order=popularity';

    public function run($request)
    {
        $process = curl_init($this->apiURL);
        curl_setopt($process, CURLOPT_USERPWD, $this->apiUserName . ":" . $this->apiUserPass);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($process);

        $collection = json_decode($return);


        $count = 0;
        foreach ($collection->events as $event) {
            $count++;
            // echo the name field
            $newEvent = Event::create();

            $newEvent->EventTitle = $event->name;
            $newEvent->EventDescription = $event->description;
            $newEvent->CalendarPageID = 1;
            $newEvent->EventApproved = 1;
            $newEvent->IsEventFindaEvent = 1;

            // Event Date
            $newEvent->EventDate = $event->datetime_start;
            // Start Time
            $newEvent->StartTime = $event->datetime_start;

            $newEvent->write();
            echo '<h1>'.$count.'</h1>';


            // iterate over the images collection of images
            foreach ($event->images->images as $image) {

                echo '<h3>'.$image->id . "</h3>";
                // iterate over the transforms collection of transforms
                foreach ($image->transforms->transforms as $transform) {
                    $file = EventImage::create();
                    // ToDo | try 27 elseif
                    $rawFileName = $transform->url;
                    // filename
                    $fileName = substr($rawFileName, 0, strpos($rawFileName, "?"));
                    $file->fileName = $fileName;
                    // associate file with event
                    $file->EventID = $newEvent->ID;
                    //$file->EventID = $newEvent;
                    echo $fileName;
                    $boss = $transform->transformation_id;

                    echo '<p style="color:red;">'.$boss.'</p>';
                    $file->write();

                    echo $transform->url . "\n";
                }
            }


        }



    }






}