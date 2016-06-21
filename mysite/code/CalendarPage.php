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

//    public function index(SS_HTTPRequest $request)
//    {
//        /**
//         * DO AJAX
//         */
//        if (Director::is_ajax()) {

//        } else {
//            return Array(); // execution as usual in this case...
//        }
//    }

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
        Requirements::javascript($this->ThemeDir() . "js/datepicker.js");

        if (!isset($_SESSION['Month'])) {
            //@session_start();
            $var = 3;
            Session::set('MyVar', $var);
            $m = date("m");
            Session::set('Month', $m);
            $y = date("Y");
            Session::set('Year', $y);
        }
    }

    private static $allowed_actions = array(
        'show',
        'CommentForm',
        'test',
        'HelloForm',
        'AddEventForm',
        'processAddEvent',
        'testJax',
        'jaxNextMonth',
        'jaxPreviousMonth',
        'FMonthName',
        'BMonthName',
        'currentYear',
        'currentMonthName',
        'nextShortMonth',
        'prevShortMonth',
        'resetCalendarDate'

    );

    /**
     * Format & return Month, Names & Year
     */
    public function FMonthName()
    {
        $month = Session::get('Month');
        return $month;
    }

    public function BMonthName()
    {
        $month = Session::get('Month');
        return $month;
    }

    public function currentMonth()
    {
        $var = Session::get('Month'); // month session variable1
        return $var;
    }

    public function currentYear()
    {
        $var = Session::get('Year'); // year session var
        return $var;
    }

    public function currentMonthName()
    {
        $mthNum = Session::get('Month'); // month session variable1
        $dateObj = DateTime::createFromFormat('!m', $mthNum);
        $mthName = $dateObj->format('F'); // April

        return $mthName;
    }

    public function resetCalendarDate()
    {

        $m = date("m");
        $y = date("Y");
        Session::set('Month', $m);
        Session::set('Year', $y);

        $cal = $this->draw_calendar();
        return $cal;
    }

    /**
     * @return string
     * Short month name for previous month
     */
    public function prevShortMonth()
    {
        $mthNum = Session::get('Month'); // month session variable1
        $mthNum--;
        $dateObj = DateTime::createFromFormat('!m', $mthNum);
        $mthName = $dateObj->format('F'); // April
        if ($mthName == "January"){
            $fMonthName = "Jan";
        } elseif($mthName == "February") {
            $fMonthName = "Jan";
        }
        elseif($mthName == "March") {
            $fMonthName = "Mar";
        }
        elseif($mthName == "April") {
            $fMonthName = "Apr";
        }
        elseif($mthName == "May") {
            $fMonthName = "May";
        }
        elseif($mthName == "June") {
            $fMonthName = "June";
        }
        elseif($mthName == "July") {
            $fMonthName = "July";
        }
        elseif($mthName == "August") {
            $fMonthName = "Aug";
        }
        elseif($mthName == "September") {
            $fMonthName = "Sep";
        }
        elseif($mthName == "October") {
            $fMonthName = "Oct";
        }
        elseif($mthName == "November") {
            $fMonthName = "Nov";
        }
        elseif($mthName == "December") {
            $fMonthName = "Dec";
        }

        return $fMonthName;
    }


    /**
     * @return string
     * Short month name for next month
     */
    public function nextShortMonth()
    {
        $mthNum = Session::get('Month'); // month session variable1
        $mthNum++;
        $dateObj = DateTime::createFromFormat('!m', $mthNum);
        $mthName = $dateObj->format('F'); // April
        if ($mthName == "January"){
            $fMonthName = "Jan";
        } elseif($mthName == "February") {
            $fMonthName = "Jan";
        }
        elseif($mthName == "March") {
            $fMonthName = "Mar";
        }
        elseif($mthName == "April") {
            $fMonthName = "Apr";
        }
        elseif($mthName == "May") {
            $fMonthName = "May";
        }
        elseif($mthName == "June") {
            $fMonthName = "June";
        }
        elseif($mthName == "July") {
            $fMonthName = "July";
        }
        elseif($mthName == "August") {
            $fMonthName = "Aug";
        }
        elseif($mthName == "September") {
            $fMonthName = "Sep";
        }
        elseif($mthName == "October") {
            $fMonthName = "Oct";
        }
        elseif($mthName == "November") {
            $fMonthName = "Nov";
        }
        elseif($mthName == "December") {
            $fMonthName = "Dec";
        }

        return $fMonthName;
    }

    public function jaxPreviousMonth()
    {
        $m = Session::get('Month');
        $y = Session::get('Year');
        $m--;
        if ($m == 0) {
            $y--;
            $m = 12;
        }
        if ($m == 1) {
            $m = "01";
        } elseif ($m == 2) {
            $m = "02";
        } elseif ($m == 3) {
            $m = "03";
        } elseif ($m == 4) {
            $m = "04";
        } elseif ($m == 5) {
            $m = "05";
        } elseif ($m == 6) {
            $m = "06";
        } elseif ($m == 7) {
            $m = "07";
        } elseif ($m == 8) {
            $m = "08";
        } elseif ($m == 9) {
            $m = "09";
        } else {
            $m = $m;
        }
        Session::set('Month', $m);
        Session::set('Year', $y);
        $cal = $this->draw_calendar();
        return $cal;
    }


    public function jaxNextMonth()
    {

//        $initial = $this->init();
//        parent::init($initial);

        $m = Session::get('Month');
        $y = Session::get('Year');
        $m++;

        if ($m == 12) {
            $y++;
            $m = 1;
        }
        if ($m == 1) {
            $m = "01";
        } elseif ($m == 2) {
            $m = "02";
        } elseif ($m == 3) {
            $m = "03";
        } elseif ($m == 4) {
            $m = "04";
        } elseif ($m == 5) {
            $m = "05";
        } elseif ($m == 6) {
            $m = "06";
        } elseif ($m == 7) {
            $m = "07";
        } elseif ($m == 8) {
            $m = "08";
        } elseif ($m == 9) {
            $m = "09";
        } else {
            $m = $m;
        }

        Session::set('Month', $m);
        Session::set('Year', $y);

        $cal = $this->draw_calendar();

        return $cal;

    }

    public function testJax()
    {
        $jax = "Hi this was jax method returning";
        echo($jax);
        return $jax;
    }

    /**
     * Format Month Method (if = 1 make it 01 etc...)
     */
    public function formatMonth($m = '')
    {
        $m = 3;

        if ($m == 1) {
            $m = "01";
        } elseif ($m == 2) {
            $m = "02";
        } elseif ($m == 3) {
            $m = "03";
        } elseif ($m == 4) {
            $m = "04";
        } elseif ($m == 5) {
            $m = "05";
        } elseif ($m == 6) {
            $m = "06";
        } elseif ($m == 7) {
            $m = "07";
        } elseif ($m == 8) {
            $m = "08";
        } elseif ($m == 9) {
            $m = "09";
        } else {
            $m = $m;
        }

        return $m;

    }


    /**
     * Create Add Event Form
     */
    public function AddEventForm()
    {

        $form = Form::create(
            $this,
            __FUNCTION__,
            FieldList::create(
                TextField::create('Title', '')
                    ->setAttribute('placeholder', 'Name')
                    ->addExtraClass('add-event-form-element'),
                DateField::create('EventDate', '')
                    ->setAttribute('placeholder', 'Date')
                    ->addExtraClass('add-event-form-element')
                    ->setConfig('dateformat', 'MM-dd-yyyy')
                    ->setConfig('showcalendar', true)
                    ->setAttribute('id', 'event-date'),
                TimePickerField::create('StartTime', '')
                    ->setAttribute('placeholder', 'Start Time')
                    ->addExtraClass('add-event-form-element'),
                TimePickerField::create('FinishTime', '')
                    ->setAttribute('placeholder', 'Finish Time')
                    ->addExtraClass('add-event-form-element'),

                TextField::create('Type', '')
                    ->setAttribute('placeholder', 'Type')
                    ->addExtraClass('add-event-form-element'),
                TextField::create('Location', '')
                    ->setAttribute('placeholder', 'Location')
                    ->addExtraClass('add-event-form-element'),
//                DropdownField::create('Module',
//                    'Please Choose What Module your issue relates to',
//                    Page::get("ModulePage")->map("ID", "Title", "Please Select"))
//                    ->addExtraClass('onboard-form-element'),
                TextareaField::create('Message', '')
                    ->setAttribute('placeholder', 'Event Details')
                    ->addExtraClass('add-event-form-element'),
                FileField::create('EventImage')
                    ->addExtraClass('add-event-form-element')


            ),
            FieldList::create(
                FormAction::create('processAddEvent', 'Apply To Add Event')
                    ->setUseButtonTag(true)
                    ->addExtraClass('btn btn-lg')
            ),
            RequiredFields::create('Title', 'EventDate', 'StartTime')
        );

        $form->addExtraClass('add-event-form');

        $data = Session::get("FormData.{$form->getName()}.data");

        return $data ? $form->loadDataFrom($data) : $form;


    }

    public function processAddEvent($data, $form)
    {
        //ToDo add image to db->map it to Image
        $formdate = $data['EventDate'];
        $transformdate = date("d-m-Y", strtotime($formdate));
        $event = Event::create();
        $event->Title = $data['Title'];
        $event->EventDate = $transformdate;
//        $event->EventDate = $data['EventDate'];
        $event->StartTime = $data['StartTime'];
        $event->FinishTime = $data['FinishTime'];
        $event->Type = $data['Type'];
        $event->Location = $data['Location'];
        $event->Message = $data['Message'];
        $event->CalendarPageID = $this->ID;
        //Proccess Image
        $image = $data['EventImage'];
        $event->write();
//        echo '<pre>';
//        var_dump($event);
//        die('made it to the end');
        $form->sessionMessage('Thanks for adding an event ', 'good');

        return $this->redirectBack();
    }

    /**
     * ToDo Query events by session month variable and test
     */

    /**
     * @return DataList of Events to Render on Calendar
     */
    public function getEvents()
    {
        $events = Event::get()
            ->where('Approved', 'TRUE')
            ->where('')
            ->sort('EventDate', 'ASC'); // returns a 'DataList' containing all the 'Event' objects


//        // Read in Session Data
//        $M = Session::get('Month');
//        $Y = Session::get('Year');


//        $sqlQuery = new SQLSelect();
//
//        $events = DB::prepared_query('SELECT FROM "Events" WHERE "month("$M"), year($Y)" = ?', array(0));



        return $events;

    }

    function draw_calendar($m = '', $y = '')
    {

        $m = Session::get('Month'); // $var = 3 from init function
        $y = Session::get('Year');

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

            //test
            $test = 0;

            $days_in_this_week++;
        endfor;
        /* keep going with days.... */
        // GET THE EVENTS OBJECTS IN A DATALIST TO CALL OBJECT VARIABLEIS
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar .= '<div class="day-square">';
            $calendar .= '<span class="day-number" style="">' . $list_day . '</span></br>';


            $events = $this->getEvents();
            if ($list_day == 1) {
                $convertday = "01";
            } elseif ($list_day == 2) {
                $convertday = "02";
            } elseif ($list_day == 3) {
                $convertday = "03";
            } elseif ($list_day == 4) {
                $convertday = "04";
            } elseif ($list_day == 5) {
                $convertday = "05";
            } elseif ($list_day == 6) {
                $convertday = "06";
            } elseif ($list_day == 7) {
                $convertday = "07";
            } elseif ($list_day == 8) {
                $convertday = "08";
            } elseif ($list_day == 9) {
                $convertday = "09";
            } else {
                $convertday = $list_day;
            }
            $sqDate = $year . '-' . $month . '-' . $convertday;

            foreach ($events as $e) {

                if ($sqDate == $e->EventDate) {
                    /**
                     * Begin event button build
                     */
                    //var_dump($e); // memory test

                    $calendar .= '<div class="event-btn"><a  class="happ_e_button" data-toggle="modal" data-target="#myModal-' . $e->ID . '">
                    ' . $e->Title . '
                    </a></div>

<!-- Modal -->
<div class="modal fade toggle-fade" id="myModal-' . $e->ID . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">' . $e->Title . '</h4>
      </div>
      <div class="modal-body">
        ' . $e->Description . '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>';

                } else {
                    continue;
                }
            }

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

        $calendar .= '<script>
        (function(c){var a=["DOMMouseScroll","mousewheel"];c.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var d=a.length;d;){this.addEventListener(a[--d],b,false)}}else{this.onmousewheel=b}},teardown:function(){if(this.removeEventListener){for(var d=a.length;d;){this.removeEventListener(a[--d],b,false)}}else{this.onmousewheel=null}}};c.fn.extend({mousewheel:function(d){return d?this.bind("mousewheel",d):this.trigger("mousewheel")},unmousewheel:function(d){return this.unbind("mousewheel",d)}});function b(f){var d=[].slice.call(arguments,1),g=0,e=true;f=c.event.fix(f||window.event);f.type="mousewheel";if(f.wheelDelta){g=f.wheelDelta/120}if(f.detail){g=-f.detail/3}d.unshift(f,g);return c.event.handle.apply(this,d)}})(jQuery);

/*
 Configure the below code to whatever div you want to scroll
 */
$(".day-square").bind("mousewheel",function(ev, delta) {
    var scrollTop = $(this).scrollTop();
    $(this).scrollTop(scrollTop-Math.round(delta * 20));
});

$(".modal-body").bind("mousewheel",function(ev, delta) {
    var scrollTop = $(this).scrollTop();
    $(this).scrollTop(scrollTop-Math.round(delta * 20));
});

$(".calendarpage").bind("mousewheel",function(ev, delta) {
    var scrollTop = $(this).scrollTop();
    $(this).scrollTop(scrollTop-Math.round(delta * 20));
});
        </script>';

        return $calendar;
    }


}