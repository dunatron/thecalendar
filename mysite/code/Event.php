<?php
/**
 * Created by PhpStorm.
 * User: Heath
 * Date: 16/04/16
 * Time: 12:27 AM
 */
class Event extends DataObject {

    private static $has_one = array(
        'CalendarPage' => 'CalendarPage',
        'EventImage' => 'Image'
    );

    private static $db = array(
        'EventTitle' => 'Varchar(100)',
        'EventDescription' => 'HTMLText',
        'EventDate' => 'Date',
        'StartTime' => 'Time',
        'FinishTime' => 'Time',
        'Type' => "Enum(array('Sport', 'Concert'))",
        'EventApproved' => 'Boolean',

    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Event Title:'));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Description', 'Description'));
        $fields->addFieldToTab('Root.Main', DateField::create('EventDate', 'Date of the Event')
            ->setConfig('dateformat', 'dd-MM-yyyy')
            ->setConfig('showcalendar', true));
        $fields->addFieldToTab('Root.Main', TimePickerField::create('StartTime'));
        $fields->addFieldToTab('Root.Main', TimePickerField::create('FinishTime'));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('Approved'));

        $fields->addFieldToTab('Root.Main', $eventImage = UploadField::create('EventImage'));
        //Set allowed upload extensions
        $eventImage->getValidator()->setAllowedExtensions(array('png', 'gif', 'jpg', 'jpeg'));
        $eventImage->setFolderName('event-Images');

        return $fields;
    }

}