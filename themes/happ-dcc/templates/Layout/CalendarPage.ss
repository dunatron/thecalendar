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

    <%-- Approved Events Modal | AJax to get event id and render maps and data --%>

    <% include ApprovedEventModal %>


    <!-- END CALENDAR -->

</div>


</div><!-- /container -->

<% include AddHappEventModal %>

<!-- Structure to use start -->

<!-- START CALENDAR -->


<!-- Structure to use end -->