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
    private static $has_many = array(
        'Events' => 'Event'
    );
    private static $can_be_root = false;
    //Get CMS Fields for events to add on calendar page
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Events', GridField::create(
            'Events',
            'Events on this page',
            $this->Events(),
            GridFieldConfig_RecordEditor::create()
        ));
        return $fields;
    }
    /**
     * PROPERTY
     */
    private $dayLabels = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    private $currentYear = 0;
    public $currentMonth = 0;
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
        Requirements::css($this->ThemeDir() . "/css/calendarstyle.css");
        //JS ASSETS
        Requirements::javascript($this->ThemeDir() . "js/calendar.js");
        Requirements::javascript($this->ThemeDir() . "js/data.js");
        Requirements::javascript($this->ThemeDir() . "js/jquery.calendario.js");
        Requirements::javascript($this->ThemeDir() . "js/modernizr.js");
        Requirements::javascript($this->ThemeDir() . "js/trondata.js");
    }
    private static $allowed_actions = array(
        'show',
        'CommentForm',
        'test'
    );
    //Previous Month
    public function prevMonth()
    {
        global $cmonth;
        $cmonth - 1;
        //return $this->redirectBack();
    }
    public function forwardMonth()
    {
        global $cmonth;
        $cmonth + 1;
        return $this->redirectBack();
    }
//    function draw_calendar($month, $year)
    function draw_calendar()
    {
        if (isset($_GET['year'])) {
            if (isset($_GET['month'])) {
                $cmonth = $_GET['month'];
                $cyear = $_GET['year'];
                $monthname = "";
                if ($cmonth == '01') $monthname = "Jan";
                if ($cmonth == '02') $monthname = "Feb";
                if ($cmonth == '03') $monthname = "Mar";
                if ($cmonth == '04') $monthname = "Apr";
                if ($cmonth == '05') $monthname = "May";
                if ($cmonth == '06') $monthname = "Jun";
                if ($cmonth == '07') $monthname = "Jul";
                if ($cmonth == '08') $monthname = "Aug";
                if ($cmonth == '09') $monthname = "Sep";
                if ($cmonth == '10') $monthname = "Oct";
                if ($cmonth == '11') $monthname = "Nov";
                if ($cmonth == '12') $monthname = "Dec";
            }
        } else {
            $cmonth = date("m");
            $cyear = date("Y");
            $monthname = "";
            if ($cmonth == '01') $monthname = "Jan";
            if ($cmonth == '02') $monthname = "Feb";
            if ($cmonth == '03') $monthname = "Mar";
            if ($cmonth == '04') $monthname = "Apr";
            if ($cmonth == '05') $monthname = "May";
            if ($cmonth == '06') $monthname = "Jun";
            if ($cmonth == '07') $monthname = "Jul";
            if ($cmonth == '08') $monthname = "Aug";
            if ($cmonth == '09') $monthname = "Sep";
            if ($cmonth == '10') $monthname = "Oct";
            if ($cmonth == '11') $monthname = "Nov";
            if ($cmonth == '12') $monthname = "Dec";
        }
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
            $calendar .= '<div></div>';
            $days_in_this_week++;
        endfor;
        /* keep going with days.... */
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar .= '<div>';
            $calendar .= '<span class="day-number" style="color: #FFF;margin-right: 5px;">' . $list_day . '</span></br>';
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