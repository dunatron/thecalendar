<div class="custom-header clearfix" style="padding-top: 0px; padding-bottom: 0px;">
    <h2>$Title  $currentMonth  <span><span>Week</span> | <a href="$AbsoluteBaseURL">Month</a></span></h2>

    <h3 class="custom-month-year">
                <span><a href="#" data-toggle="modal" data-target="#addEventModal"> <i class="fa fa-plus">
                    <small>Event
                    </small>
                    | </i></a>
                </span>

        <!-- Modal -->
        <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">

                        $CommentForm

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <span id="custom-month" class="custom-month"></span>
        <span id="custom-year" class="custom-year"></span>
        <nav>

            <a href="$prevMonth"> <span id="custom-prev" class="custom-prev"> </span></a>

            <span id="custom-next" class="custom-next"></span>
            <span id="custom-current" class="custom-current" title="Got to current date"></span>
        </nav>
    </h3>
</div>