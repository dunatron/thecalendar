<%--<div class="custom-header clearfix" style="padding-top: 0px; padding-bottom: 0px;">--%>
    <%--<h2>$Title  $currentMonth  <span><span>Week</span> | <a href="$AbsoluteBaseURL">Month</a></span></h2>--%>

    <%--<h3 class="custom-month-year">--%>
                <%--<span><a href="#" data-toggle="modal" data-target="#addEventModal"> <i class="fa fa-plus">--%>
                    <%--<small>Event--%>
                    <%--</small>--%>
                    <%--| </i></a>--%>
                <%--</span>--%>

        <%--<!-- Modal -->--%>
        <%--<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--%>
            <%--<div class="modal-dialog" role="document">--%>
                <%--<div class="modal-content">--%>
                    <%--<div class="modal-header">--%>
                        <%--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--%>
                        <%--<h4 class="modal-title" id="myModalLabel">Modal title</h4>--%>
                    <%--</div>--%>
                    <%--<div class="modal-body">--%>

                        <%--$CommentForm--%>

                    <%--</div>--%>
                    <%--<div class="modal-footer">--%>
                        <%--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--%>
                        <%--<button type="button" class="btn btn-primary">Save changes</button>--%>
                    <%--</div>--%>
                <%--</div>--%>
            <%--</div>--%>
        <%--</div>--%>

        <%--<span id="custom-month" class="custom-month"></span>--%>
        <%--<span id="custom-year" class="custom-year"></span>--%>
        <%--<nav id="page-navigator">--%>

            <%--<a href="$prevMonth"> <span id="custom-prev" class="custom-prev"> </span></a>--%>

            <%--<span id="custom-next" class="custom-next"></span>--%>
            <%--<span id="custom-current" class="custom-current" title="Got to current date"></span>--%>
        <%--</nav>--%>
    <%--</h3>--%>
<%--</div>--%>
<div class="container-fluid">
    <div class="nav-bar-wrapper row">
        <%--<div class="date-wrapper col-md-4 col-sm-4">--%>
            <%--<h2>$Title  $currentMonthName  <span><span>Week</span> | <a href="$AbsoluteBaseURL">Month</a></span></h2>--%>
        <%--</div>--%>
        <div class="date-wrapper col-md-4 col-sm-4">
            <h2>$Title  $currentMonthName</h2>
        </div>
        <div class="logo-wrapper col-md-4 col-sm-4">
            <img src="$ThemeDir/images/DCC_logo_tiny.png" class="img-responsive">
        </div>
        <div class="controls-wrapper col-md-4 col-sm-4">

            <div class="controls-prev-next">

                <a class="" id="previous-month" onclick="clickPrev()" href="#"><i class="fa fa-2x fa-long-arrow-left" aria-hidden="true"></i></a>

                <a class="" id="#next-month" onclick="clickNext()" href=""><i class="fa fa-2x fa-long-arrow-right" aria-hidden="true"></i></a>

            </div>

            <div class="add-event">
                <a href="#" data-toggle="modal" data-target="#addEventModal"> <i class="fa fa-2x fa-plus"></i></a>
                <% include AddEventModal %>
            </div>
        </div>
    </div>
</div>


