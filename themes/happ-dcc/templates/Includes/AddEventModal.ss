<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">

                <%--$AddEventForm--%>
                <input class="timepicker timepicker-without-dropdown text-center" tabindex="0">
                <input class="timepicker-dropdown timepicker-without-dropdown text-center" tabindex="0">



                <% include HappEventForm %>

                <input id="pac-input" class="controls" type="text"
                       placeholder="Enter a location">
                <div id="type-selector" class="controls">
                    <input type="radio" name="type" id="changetype-all" checked="checked">
                    <label for="changetype-all">All</label>

                    <input type="radio" name="type" id="changetype-establishment">
                    <label for="changetype-establishment">Establishments</label>

                    <input type="radio" name="type" id="changetype-address">
                    <label for="changetype-address">Addresses</label>

                    <input type="radio" name="type" id="changetype-geocode">
                    <label for="changetype-geocode">Geocodes</label>
                </div>
                <div id="map"></div>

                <input id="address" type="text" size="90" autocomplete="off">



            </div>
            <div class="modal-footer">


                <img src="$ThemeDir/images/powered-by-happ.png" class="img-responsive powered-by-happ">
                <%--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--%>
                <%--<button type="button" class="btn btn-primary">Save changes</button>--%>
            </div>
        </div>
    </div>

</div>

<%-- IMPORTANT | keep this modal down here to prevent modal further up in the code from scroll--%>
<% include HappEventFinishModal %>
<% include HappEventLocationModal %>