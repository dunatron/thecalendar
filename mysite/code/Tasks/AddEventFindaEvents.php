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

    public  $apiURL = 'http://api.eventfinda.co.nz/v2/events.json?rows=2';

    public function run($request)
    {
        $process = curl_init($this->apiURL);
        curl_setopt($process, CURLOPT_USERPWD, $this->apiUserName . ":" . $this->apiUserPass);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($process);

        $collection = json_decode($return);

        // Iterate over the events and their image transforms echoing out the event
        // name and the image transform URLs
//        foreach ($collection->events as $event) {
//            // echo the name field
//            echo '================================================================';
//            echo '<h1>'.$event->name . '</h1>';
//            echo '<h2>'.$event->description. '</h2>';
//
//            // iterate over the images collection of images
//            foreach ($event->images->images as $image) {
//                echo '<h3>'.$image->id . "</h3>";
//                // iterate over the transforms collection of transforms
//                foreach ($image->transforms->transforms as $transform) {
//                    echo $transform->url . "\n";
//                }
//            }
//        }

        foreach ($collection->events as $event) {
            // echo the name field
            $newEvent = Event::create();

            $newEvent->EventTitle = $event->name;
            $newEvent->EventDescription = $event->description;
            $newEvent->EventApproved = 1;
            //$newEvent->EventDate = new DateTime();

            $newEvent->write();

            // iterate over the images collection of images
            foreach ($event->images->images as $image) {
                echo '<h3>'.$image->id . "</h3>";
                // iterate over the transforms collection of transforms
                foreach ($image->transforms->transforms as $transform) {
                    $file = HappImage::create();
                    $rawFileName = $transform->url;
                    $fileName = substr($rawFileName, 0, strpos($rawFileName, "?"));
                    $file->fileName = $fileName;
                    $file->write();
                    echo $transform->url . "\n";
                }
            }
        }



    }






}