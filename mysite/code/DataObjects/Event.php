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

    private static $has_many = array(
        'Tickets' => 'Ticket',
        'EventImages'  =>  'EventImage'
    );

    private static $summary_fields = array(
        'EventTitle' => 'EventTitle',
        'EventVenue'    =>  'EventVenue',
        'LocationText' => 'LocationText',
        'EventDate' => 'EventDate',
        'IsApproved' => 'Approved status'
    );

    public function getIsApproved()
    {
        $check = '';
        if($this->EventApproved == 1){
            $check = 'Yes';
        }else {
            $check = 'No';
        }
        return $check;
    }

    private static $db = array(
        'EventTitle' => 'Varchar(100)',
        'EventVenue' => 'Varchar(100)',
        'LocationText' => 'Text',
        'LocationLat' => 'Varchar(100)', // Find a better data type
        'LocationLon' => 'Varchar(100)',
        'LocationRadius' => 'Int',
        'EventDescription' => 'HTMLText',
        'EventDate' => 'Date',
        'StartTime' => 'Time',
        'FinishTime' => 'Time',
        'EventApproved' => 'Boolean',
        'EventTags' => 'Text',
        'TicketWebsite' => 'Text',
        'TicketPhone' => 'Varchar(30)',
        'Restriction' => 'Text',
        'AccessType' => 'Text',
        'IsEventFindaEvent' =>  'Boolean',
        'EventFindaID'  =>  'Int'
    );

    private static $searchable_fields = array(
        'EventTitle',
        'EventDate',
        'EventApproved',
        'EventVenue',
        'LocationText'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();

        // EventTitle
        $fields->addFieldToTab('Root.Main', TextField::create('EventTitle', 'Event Title:')
            ->setDescription('e.g <strong>Little johnys bakeoff</strong>'));
        //EventVenue
        $fields->addFieldToTab('Root.Main', TextField::create('EventVenue', 'Event Venue:')
            ->setDescription('e.g <strong>Entertainment Centre</strong>'));
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
        // Event Month
        $fields->addFieldToTab('Root.Main', ReadonlyField::create('EventMonth', 'Month generated from picking date'));
        // StartTime
        $fields->addFieldToTab('Root.Main', TimePickerField::create('StartTime'));
        // FinishTime
        $fields->addFieldToTab('Root.Main', TimePickerField::create('FinishTime'));
        // Type
        $fields->addFieldToTab('Root.Main', CheckboxField::create('EventApproved', 'Event Approved'));

        $fields->addFieldToTab('Root.Main', TextField::create('TicketWebsite', 'Ticket Website'));

        $fields->addFieldToTab('Root.Main', TextField::create('TicketPhone', 'Ticket Phone'));

        // Tags
        $fields->addFieldToTab('Root.Main', new DropdownField(
            'EventTags',
            'Choose A Tag',
            Tag::get()->map('ID', 'Title')->toArray(),
            null,
            true
        ));

        // Restrictions
        $fields->addFieldToTab('Root.Main', new DropdownField(
            'Restriction',
            'Choose A Restriction Type',
            EventRestriction::get()->map('ID', 'Description')->toArray(),
            null,
            true
        ));

        // Access Type
        $acc = new AccessTypeArray();
        $fields->addFieldToTab('Root.Main', $acc->getAccessValues());

//        $fields->addFieldToTab('Root.EventImages', $eventImages = UploadField::create('EventImages'));
//        //Set allowed upload extensions
//        $eventImages->getValidator()->setAllowedExtensions(array('png', 'gif', 'jpg', 'jpeg'));
//        $eventImages->setFolderName('event-Images');
        $fields->addFieldToTab('Root.EventImages', $eventImages = UploadField::create('EventImages'));
        //Set allowed upload extensions
        $eventImages->getValidator()->setAllowedExtensions(array('png', 'gif', 'jpg', 'jpeg'));
        $eventImages->setFolderName('event-Images');

        // EventDescription
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('EventDescription', 'Description')
        ->setDescription('The real description field'));

        return $fields;
    }

    public static function get_by_finda_id($callerClass, $id, $cache = true) {
        if(!is_numeric($id)) {
            user_error("DataObject::get_by_finda_id passed a non-numeric ID #$id", E_USER_WARNING);
        }

        // Check filter column
        if(is_subclass_of($callerClass, 'DataObject')) {
            $baseClass = ClassInfo::baseDataClass($callerClass);
            $column = "\"$baseClass\".\"EventFindaID\"";
        } else{
            // This simpler code will be used by non-DataObject classes that implement DataObjectInterface
            $column = '"EventFindaID"';
        }
        $column = '"EventFindaID"';

        // Relegate to get_one
        return DataObject::get_one($callerClass, array($column => $id), $cache);
    }

}

class EventImage extends Image
{
    static $db=array(
        'transformation_id' => 'int'
    );

    public static $has_one = array(
        'Event' =>  'Event'
    );
}