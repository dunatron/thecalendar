<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/12/16
 * Time: 5:16 PM
 */
class EventFormTicketStep extends MultiFormStep
{
    public static $next_steps = 'EventFormLocationStep';

    public function getFields()
    {
        $restrictions = TextField::create('Restriction', 'restrictions for ticket purchase');
        return new FieldList(
           $restrictions
        );
    }

}