<%--<h1 class="keyword-searched">Results for "$Keyword"</h1>--%>
<% loop $Results %>
    <div class="result-item">

        <% if $EventImages %>
            <% loop $EventImages.Limit(1) %>
                <img src="$URL" class="img-responsive">
            <% end_loop %>
        <% else_if $EventFindaImages %>
            <% loop $EventFindaImages.Limit(1) %>
                <img src="$URL" class="img-responsive">
            <% end_loop %>
        <% else %>
            <img src="http://placehold.it/140x100">
        <% end_if %>

        <div class="search-event-content">
            <h1 class="title">$EventTitle
                <span class="date">$StartTime.Nice $EventDate.Day $EventDate.Long</span>
                <span class="venue"><span class="whats-happ-symbol">@ </span>{$EventVenue}</span>
            </h1>
            <%--<p><span></span>$BiographicalNotes.ContextSummary(500, 0,1,1, '...', '...')</p>--%>
            <p>$EventDescription.ContextSummary(300)</p>
            <%--<p>$Excerpt</p>--%>


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
        <div class="clearfix"></div>
    </div>
<% end_loop %>
<script src="$ThemeDir/js/approved/approved-event.js"></script>