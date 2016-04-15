<!-- Our Sites Link -->
<div class="codrops-top clearfix">
    <a href="$AbsoluteBaseURL"><strong>&laquo; HAPP : </strong>calendars </a>
				<span class="right">
					<a href="http://dunatron.nz"><strong>Tron Studios</strong></a>
				</span>
</div><!--/ Our Sites Link  -->


<div class="container">
    hiii

    <div class="custom-calendar-wrap custom-calendar-full">
        <div class="custom-header clearfix" style="padding-top: 0px; padding-bottom: 0px;">
            <h2>$Title  $CurrentMonth  <span><span>Week</span> | <a href="$AbsoluteBaseURL">Month</a></span></h2>

            <h3 class="custom-month-year">
                <span><i class="fa fa-plus">
                    <small>Event</small>
                    | </i></span>
                <span id="custom-month" class="custom-month"></span>
                <span id="custom-year" class="custom-year"></span>
                <nav>

                    <a href="#"> <span id="custom-prev" class="custom-prev"> </span></a>

                    <span id="custom-next" class="custom-next"></span>
                    <span id="custom-current" class="custom-current" title="Got to current date"></span>
                </nav>
            </h3>
        </div>
        <!-- Substitute this calendar below for silverstripe variables, creating a calendar on the fly -->
        <div class="fc-calendar-container">
            $draw_calendar
        </div>
    </div>

    <!-- END CALENDAR -->

</div>


</div><!-- /container -->


<!-- Structure to use start -->

<!-- START CALENDAR -->


<!-- Structure to use end -->