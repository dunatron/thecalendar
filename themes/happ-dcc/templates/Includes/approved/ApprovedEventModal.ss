<!-- Modal -->
<div class="modal fade toggle-fade" id="ApprovedEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="event-title">
                    <h1>EventTitle AJAX REPLACE</h1>
                </div>
            </div>
            <div class="modal-body">
                $getEventTitle
                <% include ApprovedEventMap %>


                <div class="event-description">
                    <h1>EventDescription AJAX REPLACE</h1>
                </div>
                <div class="event-location">
                    <h1>EventLocation AJAX REPLACE</h1>
                </div>
                <div class="event-date">
                    <h1>EventDate AJAX REPLACE</h1>
                </div>
                <div class="event-startTime">
                    <h1>EventStartTime AJAX REPLACE</h1>
                </div>
                <div class="event-finishTime">
                    <h1>EventFinishTime AJAX REPLACE</h1>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>