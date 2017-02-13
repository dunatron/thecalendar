<div class="happLocationPicker">
    <div class="form-group">
        <label class="control-label">Location:</label>
        <div class="input-wrapper">
            <div class="input-icon" id="EventAddress-Icon"></div>
            <input type="text" class="form-control" id="addEventAddress" name="addEventAddress" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Radius:</label>
        <div class="input-wrapper">
            <div class="input-icon" id="EventRadius-Icon"></div>
            <input type="text" class="form-control" id="addEventRadius" name="addEventRadius" />
        </div>
    </div>
    <%-- Add Event | MAP Location--%>
    <div id="eventMap" style="width: 100%; height: 400px;"></div>
    <div class="clearfix">&nbsp;</div>
    <div class="location-details">
        <label class="control-label">Lat.:</label>
        <%-- Event Latitude | Input --%>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="addEventLat" name="addEventLat" />
        </div>
        <label class="control-label">Long.:</label>
        <%-- Event Longitude | Input --%>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="addEventLon" name="addEventLon" />
        </div>
    </div>
    <div class="clearfix"></div>
</div>
