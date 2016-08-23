<div class="container-fluid">
    <div class="nav-bar-wrapper row">
        <div class="date-wrapper col-md-4 col-sm-4">
            <h2><span class="theMonth">$currentMonthName</span><span class="theYear">$currentYear</span></h2>
        </div>
        <div class="logo-wrapper col-md-4 col-sm-4">
            <%--<a href="$AbsoluteBaseURL/home">--%>
            <img src="$ThemeDir/images/DCC_logo_tiny.png" data-target="$AbsoluteBaseURL/home" id="reset-calendar-dates"
                 class="img-responsive">
            <%--</a>--%>
        </div>
        <div class="controls-wrapper col-md-4 col-sm-4">
            <div class="controls-prev-next">
                <a class="month-button" id="previous-month" href="$AbsoluteBaseURL/home">
                    <span class="short-previous-text">$prevShortMonth</span>
                </a>
                <a class="month-button" id="next-month" href="$AbsoluteBaseURL/home">
                    <span class="short-next-text">$nextShortMonth</span>
                </a>
            </div>
            <div class="add-event">

                <%--<a href="#" data-toggle="modal" data-target="#addEventModal">--%>
                <a data-toggle="modal" data-target="#us6-dialog">
                    <i class="fa fa-2x fa-plus-circle"></i>
                    <img src="$ThemeDir/svg/plus.svg"/>
                </a>
                <%--<button data-target="#us6-dialog" data-toggle="modal">Click hear to open dialog</button>--%>
                <%--<% include AddEventModal %>--%>
                <!-- Button trigger modal -->
                <%--<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalinModal">--%>
                    <%--Launch demo modal--%>
                <%--</button>--%>
            </div>
        </div>
    </div>
</div>


