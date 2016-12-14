<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	    'SteppedEventForm',
        'finished',
        'CloseModal',
        'HappEventForm'
	);

    public function HappEventForm()
    {
        // Details Fields
        $detailsStart = LiteralField::create('DetailsStart', '<div id="details-step">');
        $title  = TextField::create('EventTitle', 'Title of the Event');
        $desc   = TextField::create('EventDescription', 'description of the event');
        $ticket = CheckboxField::create('HasTickets', 'Check if event has tickets')->setAttribute('id', 'hasTickets');
        $tags   = MultiValueCheckboxField::create(
            'EventTags',
            'Check relevant Tags',
            Tag::get()->map('ID', 'Title')->toArray(),
            null,
            true
        );
        $detailsNext = LiteralField::create('detailsNextBtn', '<input type="button" id="detailsNextBtn">');
        $detailsEnd = LiteralField::create('DetailsEnd', '</div>');

        // Ticket Step
        $ticketStart = LiteralField::create('TicketStart', '<div id="ticket-step" class="field-hidden">');
        $restrictions = DropdownField::create('Restriction',
            'Restrictions for event',
            EventRestriction::get()->map('ID', 'Description')->toArray(),
            null,
            true
        );

        $acc = new AccessTypeArray();
        $acc->getAccessValues();
        $ticketBack = LiteralField::create('ticketBackBtn', '<input type="button" id="ticketBackBtn">');
        $ticketNext = LiteralField::create('ticketNextBtn', '<input type="button" id="ticketNextBtn">');

        $access = $acc->getAccessValues();
        $ticketEnd = LiteralField::create('TicketEnd', '</div>');

        // Ticket Website (Option 5 is selected for radio option field)
        $ticWebStart = LiteralField::create('TicWebStart', '<div id="ticket-web-step" class="field-hidden">');
        $website = TextField::create('TicketWebsite', 'Ticket website');
        $phone = TextField::create('TicketPhone', 'Ticket provider phone number');
        $ticketWebBack = LiteralField::create('ticketWebBack', '<input type="button" id="ticketWebBack">');
        $ticketWebNext = LiteralField::create('ticketWebNext', '<input type="button" id="ticketWebNext">');
        $ticWebEnd = LiteralField::create('TicWebEnd', '</div>');

        // Location Step
        $locationStart = LiteralField::create('LocationStart', '<div id="location-step" class="field-hidden">');
        $locationField = TextField::create('LocationText')->setAttribute('id', 'addEventAddress');
        $locLat = HiddenField::create('LocationLat', 'Location Latitude')->setAttribute('id', 'addEventLat');
        $locLong = HiddenField::create('LocationLon', 'Location Longitude')->setAttribute('id', 'addEventLon');
        $locRadius = HiddenField::create('LocationRadius', 'Radius of the event')->setAttribute('id', 'addEventRadius');
        $map = LiteralField::create('googleMap', '<div id="addEventMap" style="width: 100%; height: 400px;"></div>');
        $locationBack = LiteralField::create('LocationBack', '<input type="button" id="locationBack">');
        $locationNext = LiteralField::create('LocationNext', '<input type="button" id="locationNext">');
        $locationEnd = LiteralField::create('LocationEnd', '</div>');

        $fields = new FieldList(
            $detailsStart,
            $title,
            $desc,
            $ticket,
            $tags,
            $detailsNext,
            $detailsEnd,
            $ticketStart,
            $restrictions,
            $access,
            $ticketBack,
            $ticketNext,
            $ticketEnd,
            $ticWebStart,
            $website,
            $phone,
            $ticketWebBack,
            $ticketWebNext,
            $ticWebEnd,
            $locationStart,
            $locationField,
            $locLat,
            $locLong,
            $locRadius,
            $map,
            $locationBack,
            $locationNext,
            $locationEnd
        );



        $actions = new FieldList(

        );

        $form = new Form($this, 'HappEventForm', $fields, $actions);
        return $form;
    }

    public function SteppedEventForm()
    {
        $EventForm = new SteppedEventForm($this, 'SteppedEventForm');
        return $EventForm;
    }

    public function CloseModal()
    {
        $m = 'Add Event';
        Session::set('ModalCheck', 0);
        return $m;
    }

    public function ModalState()
    {
        $s = Session::get('ModalCheck');
        return $s;
    }

    public function finished()
    {
        return array(
            'Title' => 'Thank you for your submission',
            'Content' => '<p>You have submitted an Event</p>',
            'SessionMessage' => 'Thank-you for your event submission'
        );
    }

	public function init() {
		parent::init();
        Requirements::clear();
        Requirements::set_write_js_to_body(false);
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
//        Requirements::css($this->ThemeDir() . "/css/calendar.css");
        Requirements::javascript($this->ThemeDir() . "/js/jquery-1.10.2.min.js");
        Requirements::javascript($this->ThemeDir() . "/js/bootstrap-3.0.3.min.js");
        Requirements::javascript('http://maps.google.com/maps/api/js?key=AIzaSyBWVd4651hNv8mOn-RaHZdC166O82S-BbY&sensor=false&libraries=places');
        Requirements::javascript($this->ThemeDir() . "/js/locationpicker/locationpicker.jquery.min.js");
        Requirements::javascript($this->ThemeDir() . "/js/modals/add-event.js");

        Requirements::set_force_js_to_bottom(true);
        Requirements::javascript($this->ThemeDir() . "/js/navigation.js");
        Requirements::javascript($this->ThemeDir() . "/js/locationpicker/location-picker-autofill.js");
        Requirements::javascript($this->ThemeDir() . "/js/approved/approved-event.js");
        Requirements::javascript($this->ThemeDir() . "/js/select2/custom-select2.js");
        Requirements::javascript($this->ThemeDir() . "/js/modals/add-event.js");
        Requirements::javascript($this->ThemeDir() . "/js/add-event/add-happ-event.js");
	}

}
