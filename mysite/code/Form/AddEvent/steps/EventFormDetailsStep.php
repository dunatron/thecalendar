<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/12/16
 * Time: 11:38 AM
 */
class EventFormDetailsStep extends MultiFormStep
{
    public static $next_steps = 'EventFormLocationStep';

    public function getFields()
    {
        return new FieldList(
            new TextField('EventTitle', 'Title of the event'),
            new TextField('EventDescription', 'description of the event'),
            new CheckboxField('HasTickets', 'check if event has tickets'),
            new MultiValueCheckboxField('EventTags',
                'Choose A Tag',
                Tag::get()->map('ID', 'Title')->toArray(),
                null,
                true)
        );
    }

    public function getValidator()
    {
        return new RequiredFields(array(
            'EventTitle',
            'EventDescription'
        ));
    }

    public function getNextStep()
    {
        $data = $this->loadData();
        if(@$data['HasTickets'] == 1){
            return 'EventFormTicketStep';
        } else {
            return 'EventFormLocationStep';
        }
    }
}
