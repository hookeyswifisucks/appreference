<!DOCTYPE html>
<html>
	<head>
        <title>Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<?php
            include('connect.php');
            if(isset($_GET['error'])){
                if($_GET['error'] == 'login'){
                } else if ($_GET['error'] == 'register') {
                } else if ($_GET['error'] == 'takenusername') {
                }
            }
        ?>
	</head>
    <body>
		<div>
			<form id="login" action="functions.php" method="POST">
				<h3>Login Here:</h3>

				<label>Username</label><br/>
				<input type="text" name="username" required><br><br>

				<label>Password</label><br/>
				<input type="password" name="password" required><br><br>

				<button name="login" type="submit">Sign in</button>
			</form>
			<br>
			<br>
			<form id="signup" action="functions.php" method="POST">
				<h3>Register Here:</h3>

				<label>Username</label><br/>
				<input type="text" name="username" required><br /><br />

				<label>Password</label><br/>
				<input type="password" name="password" required><br /><br />

				<label>Display Name</label><br/>
				<input type="text" name="display_name" required><br /><br />

				<button name="register" type="submit">Register</button>
			</form>	
			<br>
		</div>
	</body>
</html>