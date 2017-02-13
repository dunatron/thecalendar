<% if $EventDescription %>
    <div class="description-strip">
        $EventDescription
    </div>
<% end_if %>
<% if $EventVenue || $LocationText %>
    <div class="location-strip">
        <% if $EventVenue %>
            <p class="venue-text"><span class="head-text">Venue: </span>$EventVenue</p>
        <% end_if %>
        <% if $LocationText %>
            <p class="location-text"><span class="head-text">Location: </span>$LocationText</p>
        <% end_if %>
    </div>
<% end_if %>
<% if $StartTime || $FinishTime || $EventDate %>
    <div class="date-strip">
        <% if $StartTime %>
            <p class="start-time"><span class="head-text">Start time: </span>$StartTime</p>
        <% end_if %>
        <% if $FinishTime %>
            <p class="finish-time"><span class="head-text">Finish time: </span>$FinishTime</p>
        <% end_if %>
        <% if $EventDate %>
            <p class="date"><span class="head-text">Date: </span>$EventDate</p>
        <% end_if %>
    </div>
<% end_if %>
<% if $TicketWebsite || $TicketPhone %>
    <div class="extras-strip">
        <% if $TicketWebsite %>
            <p class="start-time"><span class="head-text">Ticket website: </span><a href="$TicketWebsite" target="_blank">$TicketWebsite</a></p>
        <% end_if %>
        <% if $EventFindaURL %>
            <a href="$EventFindaURL" target="_blank">View on event finda website</a>
        <% end_if %>
    </div>
<% end_if %>
<% loop $EventImages %>
    <img src="$fileName" class="img-responsive event-img">
<% end_loop %>