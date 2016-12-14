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
        'Events' => 'Event',
        'Tags' => 'Tag',
        'Restrictions' => 'EventRestriction',
        'AccessTypes' => 'EventAccess'
    );
    private static $can_be_root = true;

    //Get CMS Fields for events to add on calendar page
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        // Events on this calendar
        $fields->addFieldToTab('Root.Events', GridField::create(
            'Event',
            'Events on this page',
            $this->Events(),
            GridFieldConfig_RecordEditor::create()
        ));

        // Tags for calendar
        $fields->addFieldToTab('Root.Tags', GridField::create(
            'Tag',
            'Tags on this calendar',
            $this->Tags(),
            GridFieldConfig_RecordEditor::create()
        ));

        // Restrictions for calendar
        $fields->addFieldToTab('Root.Restrictions', GridField::create(
            'EventRestriction',
            'Restrictions on this calendar',
            $this->Restrictions(),
            GridFieldConfig_RecordEditor::create()
        ));

        $fields->addFieldToTab('Root.ClientLogo', $screenShot = UploadField::create('ClientLogo'));
        //Set allowed upload extensions
        $screenShot->getValidator()->setAllowedExtensions(array('png', 'gif', 'jpg', 'jpeg'));
        $screenShot->setFolderName('Client-Logos');


        return $fields;
    }

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
        Requirements::css($this->ThemeDir() . "/css/select2/select2.min.css");

        // If session is not set, get today's date and set year and month
        if (!isset($_SESSION['Month'])) {
            //@session_start();
            $m = date("m");
            Session::set('Month', $m);
            $y = date("Y");
            Session::set('Year', $y);
        }
        // Check if module session is active, if not set initialise the session variable and set it to 0
        if(!isset($_SESSION['CALID'])){
            Session::set('CALID', $this->CalendarID());
        }

    }


    // Methods allowed to run on this controller
    private static $allowed_actions = array(
        'CommentForm',
        'AddEventForm',
        'processAddEvent',
        'jaxNextMonth',
        'jaxPreviousMonth',
        'currentYear',
        'currentMonthName',
        'nextShortMonth',
        'prevShortMonth',
        'resetCalendarDate',
        'tronTest',
        'EventTitle',
        'EventDescription',
        'EventLocation',
        'EventStartTime',
        'EventFinishTime',
        'EventDate'
    );

    public function CalendarID()
    {
        return $this->ID;
    }

    /**
     * Get Tags associated With Calendar
     */
    public function CalendarTags()
    {
        $tags = Tag::get();
        return $tags;
    }

    /**
     * Ajax | Return EventTitle for event modal
     */
    public function EventTitle()
    {
        $EventTitle = 'I need an Id';
        if (isset($_POST['EventID'])) {
            $eventID = $_POST['EventID'];
            $HappEvent = Event::get()->byID($eventID);
            $EventTitle = $HappEvent->EventTitle;
        }
        return $EventTitle;
    }

    /**
     * Ajax | Return EventDescription for event modal
     */
    public function EventDescription()
    {
        $EventDescription = 'I need an Id';
        if (isset($_POST['EventID'])) {
            $eventID = $_POST['EventID'];
            $HappEvent = Event::get()->byID($eventID);
            $EventDescription = $HappEvent->EventDescription;
        }
        return $EventDescription;
    }

    /**
     * Ajax | Return EventLocation for event modal
     */
    public function EventLocation()
    {
        $EventLocation = 'I need an Id';
        if (isset($_POST['EventID'])) {
            $eventID = $_POST['EventID'];
            $HappEvent = Event::get()->byID($eventID);
            $EventLocation = $HappEvent->LocationText;
        }
        return $EventLocation;
    }


    /**
     * Ajax | Return EventDate for event modal
     */
    public function EventDate()
    {
        $EventDate = 'I need an Id';
        if (isset($_POST['EventID'])) {
            $eventID = $_POST['EventID'];
            $HappEvent = Event::get()->byID($eventID);
            $EventDate = $HappEvent->EventDate;
        }
        return $EventDate;
    }

    /**
     * Ajax | Return EventStartTime for event modal
     */
    public function EventStartTime()
    {
        $EventStartTime = 'I need an Id';
        if (isset($_POST['EventID'])) {
            $eventID = $_POST['EventID'];
            $HappEvent = Event::get()->byID($eventID);
            $EventStartTime = $HappEvent->StartTime;
        }
        return $EventStartTime;
    }

    /**
     * Ajax | Return EventFinishTime for event modal
     */
    public function EventFinishTime()
    {
        $EventFinishTime = 'I need an Id';
        if (isset($_POST['EventID'])) {
            $eventID = $_POST['EventID'];
            $HappEvent = Event::get()->byID($eventID);
            $EventFinishTime = $HappEvent->FinishTime;
        }
        return $EventFinishTime;
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
        $fMonthName = $this->formatMonth($mthNum);
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
        $fMonthName = $this->formatMonth($mthNum);
        return $fMonthName;
    }

    /**
     * @return Calendar Body {previousMonth}
     */
    public function jaxPreviousMonth()
    {
        Session::set('ModalCheck', 0);
        $m = Session::get('Month');

        $m--;
        $this->formatMonthNumber($m);

        $cal = $this->draw_calendar();
        return $cal;
    }


    /**
     * @return Calendar Body {nextMonth}
     */
    public function jaxNextMonth()
    {
        Session::set('ModalCheck', 0);
        $m = Session::get('Month');
        $m++;
        $this->formatMonthNumber($m);
        $cal = $this->draw_calendar();
        return $cal;
    }

    /**
     * Format long month{April} to short month{Apr}
     */
    public function formatMonth($m = '')
    {
        $dateObj = DateTime::createFromFormat('!m', $m);
        $LongMonth = $dateObj->format('F'); // April
        $mthName = $LongMonth;
        if ($mthName == "January") {
            $mN = "Jan";
        } elseif ($mthName == "February") {
            $mN = "Feb";
        } elseif ($mthName == "March") {
            $mN = "Mar";
        } elseif ($mthName == "April") {
            $mN = "Apr";
        } elseif ($mthName == "May") {
            $mN = "May";
        } elseif ($mthName == "June") {
            $mN = "June";
        } elseif ($mthName == "July") {
            $mN = "July";
        } elseif ($mthName == "August") {
            $mN = "Aug";
        } elseif ($mthName == "September") {
            $mN = "Sep";
        } elseif ($mthName == "October") {
            $mN = "Oct";
        } elseif ($mthName == "November") {
            $mN = "Nov";
        } elseif ($mthName == "December") {
            $mN = "Dec";
        }
        return $mN;
    }

    /**
     * Format Month Number 2 = "02"
     */
    public function formatMonthNumber($m = '')
    {
        $y = Session::get('Year');

        if ($m == 0) {
            $y--;
            $m = 12;
        } elseif ($m == 13) {
            $y++;
            $m = "01";
        } elseif ($m == 1) {
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
        return;
    }

    public function tronTest()
    {
        $e = Event::create();
        // CalendarID (foreign key)
        $e->CalendarPageID = $this->ID;
        // EventTitle
        $e->EventTitle = $_POST['EventTitle'];
        // LocationText
        $e->LocationText = $_POST['addEventAddress'];
        //LocationLat
        $e->LocationLat = $_POST['addEventLat'];
        //LocationLon
        $e->LocationLon = $_POST['addEventLon'];
        //LocationRadius
        $e->LocationRadius = $_POST['addEventRadius'];
        //EventDescription
        $e->EventDescription = $_POST['EventDescription'];
        //EventDate
        $e->EventDate = $_POST['EventDate'];
        //StartTime
        $e->StartTime = $_POST['EventStartTime'];
        //FinishTime
        $e->FinishTime = $_POST['EventFinishTime'];
        //Type
        //$e->Type = $_POST['EventType'];
        //EventApproved
        $e->EventApproved = false;
        $e->write();

        /*
         * TEST UNIT
         *
        var_dump('Event Title' . $e->EventTitle . '</br>');
        var_dump('Location Text' . $e->LocationText . '</br>');
        var_dump('Location Lat' . $e->LocationLat . '</br>');
        var_dump('Location Lon' . $e->LocationLon . '</br>');
        var_dump('Location Radius' . $e->LocationRadius . '</br>');
        var_dump('Event Description' . $e->EventDescription . '</br>');
        var_dump('Event Date' . $e->EventDate . '</br>');
        var_dump('Start Time' . $e->StartTime . '</br>');
        var_dump('Finish Time' . $e->FinishTime . '</br>');
        var_dump('Type' . '</br>');
        var_dump('EventApproved' . $e->EventApproved . '</br>');
        die('Hi dead man');
        *
        */

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
        $currentMonth = Session::get('Month');
        $currentYear = Session::get('Year');
        $events = Event::get()
            ->where('EventApproved', 'TRUE')
            ->filter(array(
                'EventDate:PartialMatch' => '%'.$currentYear.'-'.$currentMonth.'-%'
            ))
            ->sort('EventDate', 'ASC'); // returns a 'DataList' containing all the 'Event' objects]


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
        $lastMonthDay = 1; // used for below function render last months days
        for ($x = 0; $x < $running_day; $x++):
            $calendar .= '<div class="day-square last-month-wrap">';
            $calendar .= '<span class="day-number last-month last-month-'.$lastMonthDay.'" style="">' . '</span></br>';
            $calendar .= '</div>';
            $lastMonthDay++;
            $days_in_this_week++;
        endfor;
        /* keep going with days.... */
        // GET THE EVENTS OBJECTS IN A DATALIST TO CALL OBJECT VARIABLEIS
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar .= '<div class="day-square">';
            $calendar .= '<div class="tron-inner-square">';
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
                    $calendar .= '<div class="event-btn show-event" data-toggle="modal" data-target="#ApprovedEventModal" lat="' . $e->LocationLat . '" lon="' . $e->LocationLon . '" radius="' . $e->LocationRadius . '" EID="' . $e->ID . '" data-tag="' .$e->EventTags . '" ><a  class="happ_e_button">' . $e->EventTitle . '</a></div>';
                } else {
                    continue;
                }
            }

            $calendar .= '<span class="fc-weekday">';
            $calendar .= '</span>';
            $calendar .= '</div>';
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
            $nextMonthDay = 1;
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar .= '<div class="day-square next-month-wrap">';
                $calendar .= '<span class="day-number next-month next-month-'.$nextMonthDay.'" style="">' . $nextMonthDay . '</span></br>';
                $calendar .= '</div>';
                $nextMonthDay++;
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