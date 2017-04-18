<%-- Location --%>
<div class="location-strip">
    {$getLocationSVG} <h2 class="location-text">$LocationText</h2>
</div>
<div class="date-time-strip">
    <%-- Date --%>
    <div class="date-strip">
        {$getCalendarSVG} <span class="date-text">$EventDate</span>
    </div>
    <%-- Time --%>
    <div class="time-strip">
        {$getClockSVG} <span class="time-text">$StartToFinishTime</span>
    </div>
</div>
<%-- Image --%>
<div class="image-strip">
    <% include ImageSlider %>
</div>



<%-- Ticket --%>
<div class="ticket-strip">
    {$getTicketSVG}
</div>
<%-- Restriction --%>
<div class="restriction-strip">
    {$getRestrictSVG}
</div>
<%-- Description --%>
<div class="description-strip">

</div>