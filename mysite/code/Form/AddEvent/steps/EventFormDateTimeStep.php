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
        $date = new DateField('EventDate', 'Date of the event');
        $date->setConfig('dateformat', 'dd-MM-yyyy');
        $date->setAttribute('type', 'date');
        $startTime = new TextField('StartTime', 'Event start time');
        $startTime->setAttribute('type', 'time');
        $finishTime = new TextField('FinishTime', 'Event finish time');
        $finishTime->setAttribute('type', 'time');

        return new FieldList(
            $date,
            $startTime,
            $finishTime
        );
    }
}