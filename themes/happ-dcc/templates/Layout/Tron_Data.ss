<h1>$EventTitle</h1>
<p>Event descr: $EventDescription</p>
<p>Event venue: $EventVenue</p>
<p>Location Text: $LocationText</p>
<p>Event date: $EventDate</p>
<p>Start time: $StartTime</p>
<p>finish time; $FinishTime</p>
<p>ticket website: $TicketWebsite</p>
<p>ticketphone: $TicketPhone</p>

<% loop $EventImages %>
    $Title
    <img src="$fileName" class="img-responsive">
<% end_loop %>