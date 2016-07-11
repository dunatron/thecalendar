
<div class="container-fluid">
    <div class="nav-bar-wrapper row">
        <%--<div class="date-wrapper col-md-4 col-sm-4">--%>
            <%--<h2>$Title  $currentMonthName  <span><span>Week</span> | <a href="$AbsoluteBaseURL">Month</a></span></h2>--%>
        <%--</div>--%>
        <div class="date-wrapper col-md-4 col-sm-4">
            <h2><span class="theMonth">$currentMonthName</span><span class="theYear">$currentYear</span> </h2>
        </div>
        <div class="logo-wrapper col-md-4 col-sm-4">
            <%--<a href="$AbsoluteBaseURL/home">--%>
                <img src="$ThemeDir/images/DCC_logo_tiny.png" data-target="$AbsoluteBaseURL/home" id="reset-calendar-dates" class="img-responsive">
            <%--</a>--%>
        </div>
        <div class="controls-wrapper col-md-4 col-sm-4">

            <div class="controls-prev-next">

                <a class="month-button" id="previous-month" href="$AbsoluteBaseURL/home">
                    <i class="fa fa-2x fa-arrow-circle-o-left" aria-hidden="true">
                        <span class="short-previous-text">$prevShortMonth</span>
                    </i>
                </a>

                <a class="month-button" id="next-month" href="$AbsoluteBaseURL/home">
                    <i class="fa fa-2x fa-arrow-circle-o-right" aria-hidden="true">
                        <span class="short-next-text">$nextShortMonth</span>
                    </i>
                </a>

            </div>

            <div class="add-event">
                <a href="#" data-toggle="modal" data-target="#addEventModal"> <i class="fa fa-2x fa-plus-circle"></i></a>
                <% include AddEventModal %>

            </div>
        </div>
    </div>
</div>


