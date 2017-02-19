<% loop $Results %>
    <h1>$EventTitle<span>$EventDate</span></h1>
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
        <a class="happ_e_button">
            View More
        </a>
    </div>
    <script src="$ThemeDir/js/approved/approved-event.js"></script>
<% end_loop %>