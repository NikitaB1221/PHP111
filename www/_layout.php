<?php
if (!isset($page)): # формалізм, схожий на Python
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
	<!-- Import Google Icon Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Local styles -->
	<link rel="stylesheet" href="/style.css" />
</head>

<body>
	<nav>
		<div class="nav-wrapper purple accent-3">
			<a href="/" class="brand-logo left">PV-111</a>
			<ul id="nav-mobile" class="right ">
				<li <?php if ($page == '')
					echo 'class="active"'; ?>>
					<a href="/shop">Shop</a>
				</li>
				<li <?php if ($page == 'about.php')
					echo 'class="active"'; ?>>
					<a href="/about">About</a>
				</li>
				<li <?php if ($page == 'forms.php')
					echo 'class="active"'; ?>>
					<a href="/forms">Forms</a>
				</li>
				<li <?php if ($page == 'db.php')
					echo 'class="active"'; ?>>
					<a href="/db">DB</a>
				</li>
				<li <?php if ($page == '')
					echo 'class="active"'; ?>>
					<a href="/oop">OOP</a>
				</li>
				<?php if (isset($_CONTEXT['user'])): /* авторизований режим */
					$avatar = empty($_CONTEXT['user']['avatar'])
						? 'no-photo.png'
						: $_CONTEXT['user']['avatar'];
					?>
					<li>
						<img class="circle" style="max-height:50px;margin:5px" src="/img/<?= $avatar ?>" alt="avatar" />
					</li>
					<li>
						<a id="logout-btn" class="waves-effect waves-light btn purple accent-3" href="#">
							<i class="material-icons">logout</i>
						</a>
					</li>
				<?php else: /* гостьовий режим */?>
					<li>
						<!-- Modal Trigger -->
						<a class="waves-effect waves-light btn modal-trigger purple accent-3" href="#auth-modal">
							<i class="material-icons">login</i>
						</a>
					</li>
				<?php endif ?>
			</ul>
		</div>
	</nav>
	<div class="row">
		<?php include $page; ?>
	</div>


	<!-- Modal Structure -->
	<div id="auth-modal" class="modal">
		<div class="modal-content">
			<h4>Login</h4>
			<div class="row">
				<div class="input-field col s6">
					<i class="material-icons prefix">account_circle</i>
					<input id="auth-login" name="auth-login" type="text">
					<label for="auth-login">login</label>
				</div>
				<div class="input-field col s6">
					<i class="material-icons prefix">pin</i>
					<input id="auth-password" name="auth-password" type="password">
					<label for="auth-password">Password</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<span id='auth-rejected-message'
				style="visibility:hidden;color:maroon;display:inline-block;width:50%;text-align:left">Authorization
				denied</span>
			<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
			<a href="#!" id="auth-btn" class="waves-effect waves-green btn-flat">Enter</a>
		</div>
	</div>

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src= /js/script.js></script>
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