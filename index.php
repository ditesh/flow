<?php

require_once "../includes.php";
$backgroundImage = mt_rand(0, 4);
RenderPrint::header();

?>
<div class="background"><img src="resources/images/homepage/4.jpg"></div>
<div class="title-text-name">
	Fold
</div>
<div id="signin-or-signup" style="display:none">
	<div class="signin" id="signin">
		<h1>Sign In</h1>
		<div id="signin-error" class="error"></div>
		<form method="post" action="signin">
			<label for="signin-username">email</label><br>
			<input type="text" name="username" id="signin-username" autofocus><br>
			<label for="signin-password">password</label><br>
			<input type="password" name="password" id="signin-password"><br>
			<input type="checkbox" name="remember-me" id="signin-remember-me">
			<label for="signin-remember-me">Remember me</label><br>
			<input class="right" type="button" value="Sign in" id="signin-button">
		</form>

	</div>
	<div class="signup" id="signup">
		<h1>Sign Up</h1>
		Completely free photo hosting, no gotchas.
		Check out <a href="ditesh/wedding">a sample gallery</a>.<br><br>
		<form method="post" action="/signup">
			<label for="signup-username">email</label><br>
			<input type="text" name="username" id="signup-username"><br>
			<label for="signup-password">password</label><br>
			<input type="password" name="password" id="signup-password"><br>
			<label for="signup-password2">password (verification)</label><br>
			<input type="password" name="password2" id="signup-password2"><br>
			<input class="right" type="button" value="Create new" id="signup-button">
		</form>

	</div>
</div>	
<div class="title-text-pitch">
	<ul id="pitches">
		<li id="pitch-0">Upload unlimited photos.</li>
		<li id="pitch-1">Completely free.</li>
		<li id="pitch-2">Share with family & friends.</li>
	</ul>
</div>

<div id="footer">
	<ul>
		<li><a href="http://twitter.com/foldmy">Twitter</a></li>
		<li><a href="http://ditesh.gathani.org/blog">Blog</a></li>
		<li><a href="/contact">Contact</a></li>
		<li><a href="/site-policies">Site Policies</a></li>
		<li><a href="/faq">FAQ</a></li>
		<li><a href="/careers">Careers</a></li>
		<li><a href="/about">About</a></li>
	</ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="resources/js/main.js"></script>
<script src="resources/js/jquery.inputmsg.js"></script>
<script src="resources/js/jquery.validation.js"></script>
<script>

	$(document).ready(function() {

/*			$("#signup-username, #signup-password, #signup-password2, #signin-username, #signin-password").inputmsg(function(elem) {

			var id = elem.attr("id");
			var val = elem.val();

			if (val.length === 0)
				return null;

			if (val.length > 255)
				return false;

			if (id === "signup-password2") {

				var password = $("#signup-password").val();

				if (password !== val)
					return false;

			}

			return true;

		});*/

		$("#signin-or-signup").css("top", ($(window).height()-$("#signin-or-signup").height())/2);
		$("#signin-or-signup").css("left", ($(window).width()-$("#signin-or-signup").width())/2);
		$("#signin-or-signup").fadeIn("slow");

		$("#signin").hover(function() {

			$(this).css("opacity", 1);
			$("#signup").css("opacity", 0.5);
		//	$("#signin > form").children("input:first").focus();

		});

		$("#signup").hover(function() {

			$(this).css("opacity", 1);
			$("#signin").css("opacity", 0.5);
		//	$("#signup > form").children("input:first").focus();

		});

		$("#signin-button").click(function() {

			var username = $("#signin-username").val();
			var password = $("#signin-password").val();

			$("#signin-username, #signin-password").isset(function(elem) {

				elem.inputerr();
				$("#signin-error").html("Invalid email or password");

			}, function() {

				$.post("signin", {

					"username": username,
					"password": password

				}, function(data, textStatus) {

					if (textStatus === "success" && data.status === 1) {

						console.log("ok");

					} else {

						$("#signin-error").html("Invalid email or password");

					}


				}, "json");

			});

		});

		$("#signup-password").blur(function() {

			var val = $(this).val();

			if (val.length > 0 && val.length < 255)
				$(this).children(".input-status:first").val("ok");


		});

		$("#signup-button").click(function() {

			$.post("signup", {

				"username": $("#signup-username").val(),
				"password": $("#signup-password").val()

			}, function(data, textStatus) {

				if (textStatus === "success" && data.status === 1)
					console.log("ok");
				else
					console.log("nok");

			}, "json");

		});

		$("#pitch-0").fadeIn("slow");

		setInterval(function() {

			var elem = $("#pitches > li:visible");
			var id = parseInt(elem.attr("id").split("-")[1]);

			if (id == 2)
				id = 0;
			else
				id += 1;
			
			elem.fadeOut("slow", function() {

				$("#pitch-"+id).fadeIn("slow");

			});
		}, 4000);
	});
</script>

<?php RenderPrint::footer() ?>
