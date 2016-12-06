<div class="container-fluid">
    <div class="nav-bar-wrapper row">

        <div class="logo-wrapper">
            <%--<a href="$AbsoluteBaseURL/home">--%>
            <a href="$AbsoluteBaseURL" id="siteBaseUrl">
                <img src="$ThemeDir/images/DCC_logo_tiny.png" data-target="$AbsoluteBaseURL/home" id="reset-calendar-dates"
                     class="img-responsive">
            </a>
            <%--</a>--%>
        </div>
        <div class="date-wrapper">
            <h2 class="full-date"><span class="theMonth">$currentMonthName</span><span class="theYear">$currentYear</span></h2>
        </div>
        <div class="filter-wrapper">
            <a class="filter-modal-btn" data-toggle="modal" data-target="#FilterModal">
                <img src="$ThemeDir/svg/filter.svg">
            </a>


            <%--<% include EventFilter %>--%>
        </div>

        <div class="controls-wrapper">
            <div class="controls-prev-next">
                <a class="month-button" id="previous-month" href="$AbsoluteBaseURL/home">
                    <span class="short-previous-text">$prevShortMonth</span>
                </a>
                <a class="month-button" id="next-month" href="$AbsoluteBaseURL/home">
                    <span class="short-next-text">$nextShortMonth</span>
                </a>
            </div>
            <div class="add-event">
                <%-- Add Event --%>
                <a data-toggle="modal" data-target="#AddHappEventModal">
                    <i class="fa fa-2x fa-plus-circle"></i>
                    <img src="$ThemeDir/svg/plus.svg"/>
                </a>
            </div>
        </div>
    </div>
</div>


