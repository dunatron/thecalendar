<?php
/**
 * Created by PhpStorm.
 * User: Heath
 * Date: 16/04/16
 * Time: 12:27 AM
 */
class Event extends DataObject {

    private static $has_one = array(
        'CalendarPage' => 'CalendarPage'
    );

    private static $db = array(
        'Title' => 'Varchar(100)',
        'Description' => 'Text',
        'EventDate' => 'Date'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Event Title:'));
        $fields->addFieldToTab('Root.Main', TextField::create('Description', 'Description'));
        $fields->addFieldToTab('Root.Main', DateField::create('EventDate', 'Date of the Event')
            ->setConfig('dateformat', 'dd-MM-yyyy')
            ->setConfig('showcalendar', true));

        return $fields;
    }

}