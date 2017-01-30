<h1>$EventTitle</h1>
<p>$EventDescription</p>
<% loop $EventImages %>
    $Title
    <img src="$URL" class="img-responsive">
<% end_loop %>