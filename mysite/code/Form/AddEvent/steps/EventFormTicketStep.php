<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/12/16
 * Time: 5:16 PM
 */
class EventFormTicketStep extends MultiFormStep
{
    public static $next_steps = 'EventFormDateTimeStep';

    public function getFields()
    {

        $restrictions = new DropdownField(
            'Restriction',
            'Restrictions for event',
            EventRestriction::get()->map('ID', 'Description')->toArray(),
            null,
            true
        );

        $acc = new AccessTypeArray();
        $acc->getAccessValues();

        $access = $acc->getAccessValues();

        return new FieldList(
           $restrictions,
            $access
        );
    }

}