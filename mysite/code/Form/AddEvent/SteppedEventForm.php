<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/12/16
 * Time: 11:34 AM
 */
class SteppedEventForm extends MultiForm
{
    public static $start_step = 'EventFormDetailsStep';

    public function finish($data, $form)
    {
        parent::finish($data, $form);

        $steps = DataObject::get(
            'MultiFormStep',
            "SessionID = {$this->session->ID}"
        );

        Session::set('ModalCheck', 0);
        $pageID = Session::get('CALID');

        $event = new Event();

        foreach ($steps as $step)
        {
            $data = $step->loadData();
            $event->CalendarPageID = $pageID;
            $event->update($data);
            $event->write();
            // Shows the step data (unserialized by loadData)
            //var_dump(Debug::show($step->loadData()));
        }
        //die('see above steps');

        $this->controller->redirect($this->controller->Link());
    }

}