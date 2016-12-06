<div id="modal-status">Add Event</div>
<% if $SteppedEventForm %>
    <% with $SteppedEventForm %>
        <% include MultiFormProgressList %>
    <% end_with %>
    $SteppedEventForm
<% end_if %>

<%--<div id="eventMap" style="width: 100%; height: 400px;"></div>--%>


<%--<form class="happ-add-event-form" action="$BaseHref/home/tronTest" method="POST">--%>
    <%--<fieldset>--%>

        <%--<!-- EventTitle | Text input-->--%>
        <%--<div class="form-group">--%>
            <%--<label class="control-label" for="EventTitle">Event Title</label>--%>
            <%--<div class="input-wrapper">--%>
                <%--<div class="input-icon" id="EventTitle-Icon"></div>--%>
                <%--<input id="EventTitle" name="EventTitle" type="text" placeholder="" class="form-control" required="">--%>
            <%--</div>--%>
        <%--</div>--%>

        <%-- IMPORTANT | Map Location Picker (include) --%>
        <%-- EVENT | LOCATION--%>
        <%--<% include PickLocation %>--%>

        <%--<!-- EventType | Select Multiple -->--%>
        <%--<div class="form-group">--%>
            <%--<label class="control-label" for="EventType">Event Type</label>--%>

            <%--<div class="input-wrapper">--%>
                <%--<div class="input-icon" id="EventType-Icon"></div>--%>
                <%--<select id="EventType" name="EventType" class="form-control" multiple="multiple">--%>
                    <%--<option value="1">Sport</option>--%>
                    <%--<option value="2">Concert</option>--%>
                    <%--<option value="3">Pokemon Hunt</option>--%>
                    <%--<option value="4">Markets</option>--%>
                <%--</select>--%>
            <%--</div>--%>
        <%--</div>--%>
        <%--<!-- Description | Textarea -->--%>
        <%--<div class="form-group">--%>
            <%--<label class="control-label" for="Description">Description</label>--%>
            <%--<div class="input-wrapper">--%>
                <%--<div class="input-icon" id="EventDescription-Icon"></div>--%>
                <%--<textarea class="form-control" id="EventDescription" name="EventDescription"></textarea>--%>
            <%--</div>--%>
        <%--</div>--%>
        <%--<!-- EventDate | Prepended text-->--%>
        <%--<div class="form-group">--%>
            <%--<label class="control-label" for="EventDate">Event Date</label>--%>
            <%--<div class="input-wrapper">--%>
                <%--<div class="input-group">--%>
                    <%--<div class="input-icon" id="EventDate-Icon"></div>--%>
                    <%--<input id="EventDate" name="EventDate" class="form-control" placeholder="" type="text" required="">--%>
                <%--</div>--%>
            <%--</div>--%>
        <%--</div>--%>
        <%--<!-- EventStartTime | Prepended text-->--%>
        <%--<div class="form-group">--%>
            <%--<label class="control-label" for="EventStartTime">Event Start Time</label>--%>
            <%--<div class="input-wrapper">--%>
                <%--<div class="input-group">--%>
                    <%--<div class="input-icon" id="EventStartTime-Icon"></div>--%>
                    <%--<input id="EventStartTime" name="EventStartTime" class="form-control" placeholder="" type="text" required="">--%>
                <%--</div>--%>
            <%--</div>--%>
        <%--</div>--%>
        <%--<!-- EventFinishTime | Prepended text-->--%>
        <%--<div class="form-group">--%>
            <%--<label class="control-label" for="EventFinishTime">Event Finish Time</label>--%>
            <%--<div class="input-wrapper">--%>
                <%--<div class="input-group">--%>
                    <%--<div class="input-icon" id="EventFinishTime-Icon"></div>--%>
                    <%--<input id="EventFinishTime" name="EventFinishTime" class="form-control" placeholder="" type="text" required="">--%>
                <%--</div>--%>
            <%--</div>--%>
        <%--</div>--%>
        <%--<!-- EventImage | File Button | TODO -->--%>
        <%--<div class="form-group">--%>
            <%--<label class="control-label" for="EventImage">Event Image</label>--%>
            <%--<div class="input-wrapper">--%>
                <%--<input id="EventImage" name="EventImage" class="input-file" type="file">--%>
            <%--</div>--%>
        <%--</div>--%>


        <%--<!-- Button -->--%>
        <%--<div class="form-group">--%>
            <%--<button id="SubmitHappEvent" name="SubmitHappEvent" class="happ_btn submit-form">Submit Event</button>--%>
        <%--</div>--%>

    <%--</fieldset>--%>
<%--</form>--%>
