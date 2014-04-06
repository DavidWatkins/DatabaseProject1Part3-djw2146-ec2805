<!DOCTYPE html>
<html>
<head>
  <title>ProjectCurrently</title>
 
  <%= javascript_include_tag "bootstrap", "data-turbolinks-track" => true %>
  <%= javascript_include_tag "application", "data-turbolinks-track" => true %>
  <%= stylesheet_link_tag "application.css", media: "all", "data-turbolinks-track" => true %>
  <%= csrf_meta_tags %>
</head>
<body>

	<%= render :partial => "layouts/nav" %>

	<div class="container">
	  <%= yield %>
	</div>

	<%= render :partial => "layouts/footer" %>

</body>
</html>
