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
        'CloseModal'
	);

    public function SteppedEventForm()
    {
        $EventForm = new SteppedEventForm($this, 'SteppedEventForm');
        return $EventForm;
    }

    public function CloseModal()
    {
        var_dump('Calling the close modal');
        die();
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



	}

}
