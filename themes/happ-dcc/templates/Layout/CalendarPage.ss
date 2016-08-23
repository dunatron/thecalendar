<%--<% include TopBar %>--%>

<%-- Calendar nav is casuing the geolocation not to work--%>
<% include CalendarNav %>


<div class="container-calendar-wrapper">

    <div class="custom-calendar-wrap custom-calendar-full">

        <!-- Substitute this calendar below for silverstripe variables, creating a calendar on the fly -->
        <div class="fc-calendar-container">
            <%--$draw_calendar--%>
            <%--$draw_calendar--%>
            <% include RenderCalendar %>


        </div>
    </div>

    <!-- END CALENDAR -->

</div>


</div><!-- /container -->



<!-- Structure to use start -->

<!-- START CALENDAR -->


<!-- Structure to use end -->