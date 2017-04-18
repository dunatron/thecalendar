<ul class="event-image-bxslider">
    <% if $EventFindaImages %>
        <% loop $EventFindaImages %>
            <li><img src="$URL" style="width: 100%;"/></li>
        <% end_loop %>
    <% else_if $EventImages %>
        <% loop $EventImages %>
            <li><img src="$fileName" style="width: 100%;"/></li>
        <% end_loop %>
    <% end_if %>
</ul>