<!-- Modal -->
<div class="modal fade toggle-fade" id="ApprovedEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <%--<button type="button" class="close" ><span aria-hidden="true">&times;</span></button>--%>
                <img class="close-btn" src="$ThemeDir/svg/close.svg"data-dismiss="modal" aria-label="Close">
                <div class="modal-title">
                    <%--<h1>EventTitle AJAX REPLACE</h1>--%>
                </div>
            </div>
            <div class="modal-body">
                <p class="event-startTime"></p>
                <div class="event-finishTime"></div>
                <div class="event-date"></div>
                <div class="event-location"></div>
                <div class="event-description"></div>
                <div class="event-assocData">Data will load here</div>
                <% include ApprovedEventMap %>

            </div>
            <%--<div class="modal-footer">--%>
                <%--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--%>
                <%--<button type="button" class="btn btn-primary">Save changes</button>--%>
            <%--</div>--%>
        </div>
    </div>
</div>