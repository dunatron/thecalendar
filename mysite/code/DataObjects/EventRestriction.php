<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/12/16
 * Time: 3:12 PM
 */
class EventRestriction extends DataObject
{
    private static $has_one = array(
        'CalendarPage' => 'CalendarPage',
    );

    private static $db = array(
        'Description' => 'Text'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        return $fields;
    }
}
