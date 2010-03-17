<p>The following feedback was given on your website:</p>

<table border="1">
	<tbody>
		<tr><td>Date:</td><td>$Created.Nice</td></tr>
		<tr><td>Name:</td><td>$MemberName</td></tr>
		<tr><td>Email:</td><td><a href="mailto:$MemberEmail">$MemberEmail</a></td></tr>
		<% if Page %><tr><td>Page:</td><td><a href="$Page.Link">$Page.Link</a></td></tr><% end_if %>
		<% if URL %><tr><td>URL:</td><td><a href="$URL">$URL</a></td></tr><% end_if %>
		<tr><td>Category</td><td>$Category</td></tr>
		<tr><td>Message:</td><td>$Message</td></tr>
		
	</tbody>
</table>