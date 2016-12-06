<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/12/16
 * Time: 11:41 AM
 */
class EventFormDateTimeStep extends MultiFormStep
{
    public static $next_steps = 'EventFormSummaryStep';

    public function getFields()
    {
//        $date = new DateField('EventDate', 'Date of the event');
//        $date->setConfig('showcalendar', true);
//        $date->setConfig('dateformat', 'dd-MM-yyyy');
//        $startTime = new TimePickerField('StartTime', 'Event start time');
//        $finishTime = new TimePickerField('FinishTime', 'Event finish time');
//        return new FieldList(
//            $date,
//            $startTime,
//            $finishTime
//        );

        $date = new DateField('EventDate', 'Date of the event');
        $date->setConfig('dateformat', 'dd-MM-yyyy');

        return new FieldList(
            $date
        );


    }
}