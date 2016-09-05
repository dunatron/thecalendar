<div id="AddHappEventModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <%--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--%>
                <img class="close-btn" src="$ThemeDir/svg/close.svg"data-dismiss="modal" aria-label="Close">
                <h4 class="modal-title">Add Happ Event</h4>
            </div>
            <div class="modal-body">
                <%-- Add Event | Form --%>
                <% include HappEventForm %>
            </div>
            <%--<div class="modal-footer">--%>
                <%--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--%>
                <%--<button type="button" class="btn btn-primary">Save changes</button>--%>
            <%--</div>--%>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->