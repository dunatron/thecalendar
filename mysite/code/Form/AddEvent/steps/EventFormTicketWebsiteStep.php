<?php
/**
 * Created by PhpStorm.
 * User: Heath
 * Date: 7/12/16
 * Time: 6:42 PM
 */
class EventFormTicketWebsiteStep extends MultiFormStep
{
    public static $next_steps = 'EventFormDateTimeStep';

    public function getFields()
    {
        $website = new TextField('TicketWebsite', 'Tiicket website');
        $phone = new TextField('TicketPhone', 'ticket provider website');

        return new FieldList(
            $website,
            $phone
        );
    }


}