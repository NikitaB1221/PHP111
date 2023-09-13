<?php
if (!isset($page)):
	echo 'Invalid access';
endif;

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8" />
	<title>PV-111</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!--Import Google Icon Font-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
	<nav>
		<div class="nav-wrapper purple accent-3">
			<a href="/" class="brand-logo">PV-111</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li if($page == 'about.php') echo 'class="active"'><a href="about">About</a></li>
				<li if($page == 'forms.php') echo 'class="active"'><a href="forms">Forms</a></li>
				<li if($page == 'index.php') echo 'class="active"'><a href="index">Index</a></li>
				<li if($page == 'db.php') echo 'class="active"'><a href="db">Db</a></li>
				<li><a href="sass.html">Sass</a></li>
				<li><a href="badges.html">Components</a></li>
				<li><a href="collapsible.html">JavaScript</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<?php include $page; ?>
	</div>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
<footer class="page-footer purple accent-3">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">Footer Content</h5>
				<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.
				</p>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5 class="white-text">Links</h5>
				<ul>
					<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2014 Copyright Text
			<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
		</div>
	</div>
</footer>

</html>