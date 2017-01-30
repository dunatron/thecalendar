<h1>$Name</h1>
<p>Now loop over all our data</p>
<% loop $myImages %>
    $Title
    <img src="$URL" class="img-responsive">
<% end_loop %>