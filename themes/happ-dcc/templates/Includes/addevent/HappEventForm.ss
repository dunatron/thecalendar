<form class="happ-add-event-form" action="$BaseHref/home/tronTest" method="POST">
    <fieldset>

        <!-- EventTitle | Text input-->
        <div class="form-group">
            <label class="control-label" for="EventTitle">Event Title</label>
            <div class="input-wrapper">
                <input id="EventTitle" name="EventTitle" type="text" placeholder="Event Title" class="form-control" required="">
                <span class="help-block">enter the title of the event</span>
            </div>
        </div>

        <%-- IMPORTANT | Map Location Picker (include) --%>
        <%-- EVENT | LOCATION--%>
        <% include PickLocation %>

        <!-- EventType | Select Multiple -->
        <div class="form-group">
            <label class="control-label" for="EventType">Event Type</label>
            <div class="input-wrapper">
                <select id="EventType" name="EventType" class="form-control" multiple="multiple">
                    <option value="1">Sport</option>
                    <option value="2">Concert</option>
                    <option value="3">Pokemon Hunt</option>
                    <option value="4">Markets</option>
                </select>
            </div>
        </div>
        <!-- Description | Textarea -->
        <div class="form-group">
            <label class="control-label" for="Description">Description</label>
            <div class="input-wrapper">
                <textarea class="form-control" id="EventDescription" name="EventDescription">event description...</textarea>
            </div>
        </div>
        <!-- EventDate | Prepended text-->
        <div class="form-group">
            <label class="control-label" for="EventDate">Event Date</label>
            <div class="input-wrapper">
                <div class="input-group">
                    <span class="input-group-addon">Event Date</span>
                    <input id="EventDate" name="EventDate" class="form-control" placeholder="Event Date" type="text" required="">
                </div>
                <p class="help-block">event date, try our datepicker</p>
            </div>
        </div>
        <!-- EventStartTime | Prepended text-->
        <div class="form-group">
            <label class="control-label" for="EventStartTime">Event Start Time</label>
            <div class="input-wrapper">
                <div class="input-group">
                    <span class="input-group-addon">S Time</span>
                    <input id="EventStartTime" name="EventStartTime" class="form-control" placeholder="Event Start Time" type="text" required="">
                </div>
                <p class="help-block">use our time picker</p>
            </div>
        </div>
        <!-- EventFinishTime | Prepended text-->
        <div class="form-group">
            <label class="control-label" for="EventFinishTime">Event Finish Time</label>
            <div class="input-wrapper">
                <div class="input-group">
                    <span class="input-group-addon"> <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#EventFinishModal">
            Launch demo modal
        </button></span>
                    <input id="EventFinishTime" name="EventFinishTime" class="form-control" placeholder="Event Finish Time" type="text" required="">
                </div>
                <p class="help-block">use our time picker via the icon</p>
            </div>
        </div>
        <!-- EventImage | File Button -->
        <div class="form-group">
            <label class="control-label" for="EventImage">Event Image</label>
            <div class="input-wrapper">
                <input id="EventImage" name="EventImage" class="input-file" type="file">
            </div>
        </div>


        <!-- Button -->
        <div class="form-group">
            <label class="control-label" for="singlebutton">Single Button</label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Button</button>
            </div>
        </div>

    </fieldset>
</form>