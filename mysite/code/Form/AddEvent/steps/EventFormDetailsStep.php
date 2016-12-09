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
        $title  = TextField::create('EventTitle', 'Title of the Event');
        $desc   = TextField::create('EventDescription', 'description of the event');
        $ticket = CheckboxField::create('HasTickets', 'Check if event has tickets');
        $tags   = MultiValueCheckboxField::create(
            'EventTags',
            'Check relevant Tags',
            Tag::get()->map('ID', 'Title')->toArray(),
            null,
            true
        );

        return new FieldList(
            $title,
            $desc,
            $ticket,
            $tags
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
        $s = Session::set('ModalCheck', 1);
        $data = $this->loadData();
        if(@$data['HasTickets'] == 1){
            return 'EventFormTicketStep';
        } else {
            return 'EventFormLocationStep';
        }
    }
}
