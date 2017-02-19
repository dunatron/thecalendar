<h1 class="keyword-searched">Results for "$Keyword"</h1>
<% loop $Results %>
    <div class="result-item">
        <h1 class="title">$EventTitle<span class="date">$EventDate</span></h1>
        <p>$EventDescription</p>
        <%--<div class="event-btn happ_e_button show-event" data-toggle="modal"--%>
        <%--data-target="#ApprovedEventModal"--%>
        <%--lat="$LocationLat"--%>
        <%--lon="$LocationLon"--%>
        <%--eid="$ID"--%>
        <%--data-tag="Tags to come g"--%>
        <%-->View More--%>
        <%--</div>--%>
        <div class="event-btn show-event"
             data-toggle="modal"
             data-target="#ApprovedEventModal"
             lat="$LocationLat"
             lon="$LocationLon"
             radius=""
             eid="$ID" data-tag=""
        >
            View more
        </div>
    </div>
<% end_loop %>
<script src="$ThemeDir/js/approved/approved-event.js"></script>