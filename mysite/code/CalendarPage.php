<?php
/**
 * Created by PhpStorm.
 * User: heath
 * Date: 15/04/16
 * Time: 4:42 PM
 */
class CalendarPage extends Page
{
    private static $db = array();

    private static $has_one = array(
        'ClientLogo' => 'Image'
    );

    private static $has_many = array(
        'Events' => 'Event'
    );
    private static $can_be_root = true;

    //Get CMS Fields for events to add on calendar page
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Events', GridField::create(
            'Event',
            'Events on this page',
            $this->Events(),
            GridFieldConfig_RecordEditor::create()
        ));

        $fields->addFieldToTab('Root.ClientLogo', $screenShot = UploadField::create('ClientLogo'));
        //Set allowed upload extensions
        $screenShot->getValidator()->setAllowedExtensions(array('png', 'gif', 'jpg', 'jpeg'));
        $screenShot->setFolderName('Client-Logos');


        return $fields;
    }
    /**
     * PROPERTY
     */
    private $dayLabels = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    private $currentYear = 0;
    public $currentMonth = 1;
    private $currentDay = 0;
    private $currentDate = null;
    private $daysInMonth = 0;
    private $naviHref = null;

}
class CalendarPage_Controller extends Page_Controller
{
    //Inject assets through controller
    public function init()
    {
        parent::init();
        //CSS ASSETS
        Requirements::css($this->ThemeDir() . "/css/calendar.css");
        Requirements::css($this->ThemeDir() . "/css/demo.css");
        Requirements::css($this->ThemeDir() . "/css/homepage.css");
        Requirements::css($this->ThemeDir() . "/css/calendarstyle.css");
        //JS ASSETS
        Requirements::javascript($this->ThemeDir() . "js/calendar.js");
        Requirements::javascript($this->ThemeDir() . "js/data.js");
        Requirements::javascript($this->ThemeDir() . "js/jquery.calendario.js");
        Requirements::javascript($this->ThemeDir() . "js/modernizr.js");
        Requirements::javascript($this->ThemeDir() . "js/trondata.js");


        // save a variable
        $var = 3;
        Session::set('MyVar', $var);

        $m= date("m");
        Session::set('Month', $m);

        $y= date("Y");
        Session::set('Year', $y);
    }
    private static $allowed_actions = array(
        'show',
        'CommentForm',
        'test',
        'HelloForm',
        'AddEventForm',
        'proccessAddEvent'

    );

    /**
     * Create Add Event Form
     */
    public function AddEventForm()
    {

        $form = Form::create(
            $this,
            __FUNCTION__,
            FieldList::create(
                TextField::create('Title','')
                    ->setAttribute('placeholder','Name')
                    ->addExtraClass('onboard-form-element'),
                DateField::create('EventDate','')
                    ->setAttribute('placeholder','Date')
                    ->addExtraClass('onboard-form-element')
                    ->setConfig('dateformat', 'dd-MM-yyyy')
                    ->setConfig('showcalendar', true)
                    ->setAttribute('id', 'event-date'),
                TimePickerField::create('StartTime','')
                    ->setAttribute('placeholder','Start Time')
                    ->addExtraClass('onboard-form-element'),
                TimePickerField::create('FinishTime','')
                    ->setAttribute('placeholder','Finish Time')
                    ->addExtraClass('onboard-form-element'),

                TextField::create('Type','')
                    ->setAttribute('placeholder','Type')
                    ->addExtraClass('onboard-form-element'),
                TextField::create('Location','')
                    ->setAttribute('placeholder','Location')
                    ->addExtraClass('onboard-form-element'),
//                DropdownField::create('Module',
//                    'Please Choose What Module your issue relates to',
//                    Page::get("ModulePage")->map("ID", "Title", "Please Select"))
//                    ->addExtraClass('onboard-form-element'),
                TextareaField::create('Message','')
                    ->setAttribute('placeholder','Your Message')
                    ->addExtraClass('onboard-form-element')


            ),
            FieldList::create(
                FormAction::create('processAddEvent','Send')
                    ->setUseButtonTag(true)
                    ->addExtraClass('btn btn-lg')
            ),
            RequiredFields::create('Title','EventDate','StartTime')
        );

        $form->addExtraClass('form-style');

        return $form;


    }

    public function processAddEvent($data, $form)
    {

        $formdate = $data['EventDate'];
        $transformdate = date("d-m-Y", strtotime($formdate));

        $event = Event::create();
        $event->Title = $data['Title'];
        $event->EventDate = $transformdate;
        $event->StartTime = $data['StartTime'];
        $event->FinishTime = $data['FinishTime'];
        $event->Type = $data['Type'];
        $event->Location = $data['Location'];
        $event->Message = $data['Message'];
        $event->Title = $data['Title'];
        $event->CalendarPageID = $this->ID;
        $form->saveInto($event);
        $event->write();


    }




    public function currentMonthName(){
        $mthNum   = Session::get('Month'); // month session variable1
        $dateObj = DateTime::createFromFormat('!m', $mthNum);
        $mthName = $dateObj->format('F'); // April

        return $mthName;
    }

    public function currentMonth(){
        $var   = Session::get('Month'); // month session variable1
        return $var;
    }
    public function currentYear(){
        $var = Session::get('Year'); // year session var
        return $var;
    }
    //Previous Month
    public function prevMonth()
    {
//        $calendar = $this->draw_calendar(1);
//        // Kinda
//        return $calendar;
    }
    public function forwardMonth()
    {
        global $cmonth;
        $cmonth + 1;
        return $this->redirectBack();
    }

    public function getEvents(){
        $events = Event::get()->sort('EventDate', 'ASC'); // returns a 'DataList' containing all the 'Event' objects
        return $events;

    }
    function draw_calendar($m='', $y='')
    //function draw_calendar()
    {

        $m   = Session::get('Month'); // $var = 3 from init function
        $y = Session::get('Year');

        // TODO: 01 to 1 bug or 1 to 01
//        $events = $this->getEvents();
//        foreach($events as $e){
//            echo $e->EventDate;
//
//        }


        $cmonth = $m;
        $cyear = $y;

        $month = $cmonth;
        $year = $cyear;
        //count days then store as days,weeks in the month
        $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();
        //store how many days are in a week
        for ($x = 0; $x < $running_day; $x++):
            $days_in_this_week++;
        endfor;
        //set counter to count rows
        $counterday = 1;
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            if ($running_day == 6):
                if (($day_counter + 1) != $days_in_month):
                    $counterday++;
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        endfor;
        //get row variables
        if ($counterday == 5) {
            $fcc = "five";
        }
        if ($counterday == 6) {
            $fcc = "six";
        }
        //print row variables
        $calendar = "<div class='fc-calendar fc-" . $fcc . "-rows'>";
        // reset calendar to do original count
        $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();
        /* table headings */
        $headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $calendar .= '<div class="fc-head"><div>' . implode('</div><div>', $headings) . '</div></div>';
        /* days and weeks vars now ... */
        /* start body fc-body */
        $calendar .= '<div class="fc-body">';
        /* row for week one */
        $calendar .= '<div class="fc-row">';
        /* print "blank" days until the first of the current week */
        for ($x = 0; $x < $running_day; $x++):
            $calendar .= '<div class="outer-square"></div> <div class="day-square"></div>';
            $days_in_this_week++;
        endfor;
        /* keep going with days.... */
        // GET THE EVENTS OBJECTS IN A DATALIST TO CALL OBJECT VARIABLEIS
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar .= '<div class="day-square">';
            $calendar .= '<span class="day-number" style="">' . $list_day . '</span></br>';


            $events = $this->getEvents();
            $sqDate = $year .'-'. $month .'-'.$list_day;

            foreach($events as $e){

                if($sqDate == $e->EventDate){
                    /**
                     * Begin event button build
                     */
                    //var_dump($e); // memory test

                    $calendar .= '<div class="event-btn"><a  class="happ_e_button" data-toggle="modal" data-target="#myModal-'.$e->ID.'">
                    '.$e->Title.'
                    </a></div>

<!-- Modal -->
<div class="modal fade toggle-fade" id="myModal-'.$e->ID.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">'.$e->Title.'</h4>
      </div>
      <div class="modal-body">
        '.$e->Description.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>';



//                    $calendar .= '<button type="button" class="btn happ_e_button" data-toggle="modal" data-target="#myModal-'.$e->ID.'">
//                    '.$e->Title.'
//                    </button>
//
//<!-- Modal -->
//<div class="modal fade toggle-fade" id="myModal-'.$e->ID.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
//  <div class="modal-dialog" role="document">
//    <div class="modal-content">
//      <div class="modal-header">
//        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
//        <h4 class="modal-title" id="myModalLabel">'.$e->Title.'</h4>
//      </div>
//      <div class="modal-body">
//        '.$e->Description.'
//      </div>
//      <div class="modal-footer">
//        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
//        <button type="button" class="btn btn-primary">Save changes</button>
//      </div>
//    </div>
//  </div>
//</div>';



                }
                else {
                    continue;
                }

            }

            // store events by month then loop over month events



            //Pull out the events from the events Objetcs Page
            /*
            $getevents = $esql;//mysql_query("SELECT * FROM events") or die(mysql_error());
            while($rowe = mysql_fetch_assoc($getevents)) {
                $dateinp = $rowe['eventdate'];
                $qtime  = strtotime($dateinp);
                $qday   = date('d',$qtime);
                $qmonth = date('m',$qtime);
                $qyear  = date('Y',$qtime);
                if($qday == $list_day && $qmonth == $month && $qyear == $year){$calendar.= "<a style='text-decoration:none;overflow:hidden;' rel='gallery' class='fancybox fancybox.iframe' title='' href='singleEvent.php?eid=".$rowe['id']."'>".$rowe['title']. "</a></br> ";}
            }
            */
            $calendar .= '<span class="fc-weekday">';
            $calendar .= '</span>';
            $calendar .= '</div>';
            if ($running_day == 6):
                $calendar .= '</div>';
                if (($day_counter + 1) != $days_in_month):
                    $calendar .= '<div class="fc-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        endfor;
        /* finish the rest of the days in the week */
        if ($days_in_this_week < 8):
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar .= '<div> </div>';
            endfor;
        endif;
        /* final row */
        $calendar .= '</div>';
        /* end body fc-body */
        $calendar .= '</div>';
        /* end the table */
        $calendar .= '</div>';
        /* end calendar */
        /* all done, return result */

        return $calendar;
    }


}