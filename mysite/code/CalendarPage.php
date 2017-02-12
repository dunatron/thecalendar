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
        'EventDate',
        'associatedEventData',
        'resetApprovedModal'
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


    public function associatedEventData()
    {

        if (isset($_POST['EventID'])) {
            $eventID = $_POST['EventID'];
            $HappEvent = Event::get()->byID($eventID);

            $assocImages = $HappEvent->EventImages();
        }
        $date = new DateTime($HappEvent->EventDate);
//        $dateFormat = $date->format('Y-m-d H:i:s');
        $dateFormat = $date->format('d M Y');
        $startTime = new DateTime($HappEvent->StartTime);
        $startTimeFormat = $startTime->format('h:i a');
        $finishTime = new DateTime($HappEvent->FinishTime);
        $finishTimeFormat = $finishTime->format('h:i a');

        $data = new ArrayData(array(
            'EventTitle'  =>  $HappEvent->EventTitle,
            'EventDescription'  => $HappEvent->EventDescription,
            'EventVenue'    =>  $HappEvent->EventVenue,
            'LocationText'  =>  $HappEvent->LocationText,
            'EventDate' =>  $dateFormat,
            'StartTime' =>  $startTimeFormat,
            'FinishTime'    =>  $finishTimeFormat,
            'TicketWebsite' =>  $HappEvent->TicketWebsite,
            'TicketPhone'   =>  $HappEvent->TicketPhone,
            'EventFindaURL' =>  $HappEvent->EventFindaURL,
            'EventImages'  => $assocImages,

        ));
        echo $data->renderWith('Tron_data');
    }

    public function resetApprovedModal()
    {
        $html = '<div class="ajax-loader"><div class="ajax-load-icon"></div> </div>';
        return $html;
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
        $this->reAddScripts();
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
        $this->reAddScripts();
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
        $this->reAddScripts();
        return $cal;
    }

    /**
     * Format long month{April} to short month{Apr}
     */
    public function formatMonth($m = '')
    {
        $dateObj = DateTime::createFromFormat('!m', $m);
        $shortMonth = $dateObj->format('M'); // April
        return $shortMonth;
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

   public function reAddScripts()
   {
       echo '<script src="'.$this->ThemeDir() .'/js/approved/approved-event.js"></script>';
       return;
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
            $calendar .= '<span class="day-number" style="">' . $list_day . '</span>';


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

            $calendar .= '<div class="opaque-head"></div>';
            $calendar .= '<div class="events-day-wrapper">';
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
            $calendar .= '</div>';//close events-day-wrapper

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
        //$calendar.= '<script src="'.$this->ThemeDir() .'/js/locationpicker/locationpicker.jquery.min.js"></script>';
        //$this->ThemeDir() . "/js/locationpicker/locationpicker.jquery.min.js"

        return $calendar;
    }


}