<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/12/16
 * Time: 11:45 AM
 */
class EventFormSummaryStep extends MultiFormStep
{
    public static $is_final_step = true;

    public function getFields()
    {
        $Title = new ReadonlyField('EventTitle', 'Title of the event');
        $Desc = new ReadonlyField('EventDescription', 'Description of the event');
        $fields = new FieldList(
            $Title,
            $Desc
        );

        $this->copyValueFromOtherStep($fields, 'EventFormDetailsStep', 'EventTitle');
        $this->copyValueFromOtherStep($fields, 'EventFormDetailsStep', 'EventDescription');

        return $fields;
    }

}