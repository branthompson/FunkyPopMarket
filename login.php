

<!-- Display message when they have successfully registered -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'success') 
{
    echo '<p class="success">You have successfully registered! You can now login.</p>';
}
?> 

<!-- Login page for a registered user. Username and Password are handled by
authenticate.php -->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Funky Pops Login</title>
		<link rel="stylesheet" href="login.css">
	</head>
	<body>
		<header>
			<h1 class="title">Funky Pop Marketplace</h1>
		</header>
		<p>If you have an account, log in to begin shopping.</p>
		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username"></label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password"></label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>			
		</div>
		<p>Need an Account? <a href="register.html">Register here</a></p>
	</body>
</html>