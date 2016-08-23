<div class="form-horizontal" style="width: 550px">
    <div class="form-group">
        <label class="col-sm-2 control-label">Location:</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" id="us3-address" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Radius:</label>

        <div class="col-sm-5">
            <input type="text" class="form-control" id="us3-radius" />
        </div>
    </div>
    <div id="us3" style="width: 100%; height: 400px;"></div>
    <div class="clearfix">&nbsp;</div>
    <div class="m-t-small">
        <label class="p-r-small col-sm-1 control-label">Lat.:</label>

        <div class="col-sm-3">
            <input type="text" class="form-control" style="width: 110px" id="us3-lat" />
        </div>
        <label class="p-r-small col-sm-2 control-label">Long.:</label>

        <div class="col-sm-3">
            <input type="text" class="form-control" style="width: 110px" id="us3-lon" />
        </div>
    </div>
    <div class="clearfix"></div>
    <script>
        $('#us3').locationpicker({
            location: {
                latitude: -45.8751791,
                longitude: 170.5031467
            },
            radius: 300,
            inputBinding: {
                latitudeInput: $('#us3-lat'),
                longitudeInput: $('#us3-lon'),
                radiusInput: $('#us3-radius'),
                locationNameInput: $('#us3-address')
            },
            enableAutocomplete: true,
            markerIcon: 'http://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png'
        });
        $('#us6-dialog').on('shown.bs.modal', function () {
            $('#us3').locationpicker('autosize');
        });
    </script>
</div>