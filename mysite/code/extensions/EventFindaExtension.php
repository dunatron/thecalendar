<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2/02/17
 * Time: 1:55 PM
 */
class EventFindaExtension extends DataExtension
{
    private static $db = array(
        'BaseQuery' => 'Varchar(255)',
        'LocationQuery' => 'Varchar(255)'
    );

    private static $has_one = array();

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.EventFindaConfig",
            new TextField("BaseQuery", 'e.g. http://api.eventfinda.co.nz/v2/events.json?rows=20&session:(timezone,datetime_start)&order=popularity')
        );
        $fields->addFieldToTab("Root.EventFindaConfig",
            new TextField("LocationQuery", 'e.g. &location=126')
        );
    }
}