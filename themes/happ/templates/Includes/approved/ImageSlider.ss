


<% if $EventFindaImages %>
    <% if $EventFindaImages.Count >= 2 %>
        <ul class="event-image-bxslider">
            <% loop $EventFindaImages %>
                <li><img src="$URL" style="width: 100%;"/></li>
            <% end_loop %>
        </ul>
    <% else %>
        <% loop $EventFindaImages %>
            <img src="$URL" style="width: 100%;" class="img-responsive"/>
        <% end_loop %>
    <% end_if %>

<% else_if $EventImages %>
    <ul class="event-image-bxslider">
        <% loop $EventImages %>
            <li><img src="$fileName" style="width: 100%;" class="img-responsive"/></li>
        <% end_loop %>
    </ul>
<% end_if %>
