<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/12/16
 * Time: 1:01 PM
 */
class EventFormLocationStep extends MultiFormStep
{
    public static $next_steps = 'EventFormDateTimeStep';

    public function getFields()
    {
        $locationField = new TextField('LocationText');
        $locationField->setAttribute('id', 'addEventAddress');
        $locLat = new HiddenField('LocationLat', 'Location Latitude');
        $locLat->setAttribute('id', 'addEventLat');
        $locLong = new HiddenField('LocationLon', 'Location Longitude');
        $locLong->setAttribute('id', 'addEventLon');
        $locRadius = new HiddenField('LocationRadius', 'Radius of the event');
        $locRadius->setAttribute('id', 'addEventRadius');

        $map = new LiteralField('googleMap', '<div id="eventMap" style="width: 100%; height: 400px;"></div>');

        return new FieldList(
            $locationField,
            $locLat,
            $locLong,
            $locRadius,
            $map
        );
        
    }

    public function getValidator()
    {
        return new RequiredFields(array(
            'LocationText',
            'LocationLat',
            'LocationLon'
        ));
    }
}