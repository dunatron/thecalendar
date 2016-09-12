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

    private static $summary_fields = array(
        'EventTitle' => 'EventTitle',
        'LocationText' => 'LocationText',
        'EventDate' => 'EventDate'
    );

    private static $db = array(
        'EventTitle' => 'Varchar(100)',
        'LocationText' => 'Text',
        'LocationLat' => 'Varchar(100)', // Find a better data type
        'LocationLon' => 'Varchar(100)',
        'LocationRadius' => 'Int',
        'EventDescription' => 'HTMLText',
        'EventDate' => 'Date',
        'StartTime' => 'Time',
        'FinishTime' => 'Time',
        'EventApproved' => 'Boolean',
        'EventTags' => 'Text'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();

        // EventTitle
        $fields->addFieldToTab('Root.Main', TextField::create('EventTitle', 'Event Title:')
            ->setDescription('e.g <strong>Little johnys bakeoff</strong>'));
        // LocationText
        $fields->addFieldToTab('Root.Main', TextField::create('LocationText', 'Event Location:')
            ->setDescription('e.g <strong>182 Bowmar Rd, Waimumu 9774, New Zealand</strong>'));
        // LocationLat
        $fields->addFieldToTab('Root.Main', NumericField::create('LocationLat', 'Event location Latitude:')
            ->setDescription('e.g <strong>-46.1326615</strong>'));
        // LocationLon
        $fields->addFieldToTab('Root.Main', NumericField::create('LocationLon', 'Event location Longitude:')
            ->setDescription('e.g <strong>168.89592100000004</strong>'));
        // LocationRadius
        $fields->addFieldToTab('Root.Main', NumericField::create('LocationRadius', 'Event location Radius:'));
        // EventDate
        $fields->addFieldToTab('Root.Main', DateField::create('EventDate', 'Date of the Event')
            ->setConfig('dateformat', 'dd-MM-yyyy')
            ->setConfig('showcalendar', true));
        // StartTime
        $fields->addFieldToTab('Root.Main', TimePickerField::create('StartTime'));
        // FinishTime
        $fields->addFieldToTab('Root.Main', TimePickerField::create('FinishTime'));
        // Type
        $fields->addFieldToTab('Root.Main', CheckboxField::create('EventApproved', 'Event Approved'));
        // EventDescription
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('EventDescription', 'Description')
        ->setDescription('The real description field'));

        // Tags
//        $fields->addFieldToTab('Root.Main', new DropdownField(
//           'EventTags',
//            'Choose A Tag',
//            DataObject::get("Tag")->map("ID", "Title", "Please Select")
//        ));

        $fields->addFieldToTab('Root.Main', new DropdownField(
            'EventTags',
            'Choose A Tag',
            Tag::get()->map('ID', 'Title')->toArray(),
            null,
            true
        ));


        $fields->addFieldToTab('Root.Main', $eventImage = UploadField::create('EventImage'));
        //Set allowed upload extensions
        $eventImage->getValidator()->setAllowedExtensions(array('png', 'gif', 'jpg', 'jpeg'));
        $eventImage->setFolderName('event-Images');

        return $fields;
    }

}