<?php
	include '../../configuration/globalVariable.php';
	include '../../model/adminlogin.php';
?>
<?php
	$adminLogin = new AdminLogin();

	$username = "";
	$password = "";
	if( isset($_POST['username']) && isset($_POST['password']) )
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
	}

	$loginStatus = $adminLogin->login($username, $password);
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>/admin/css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span>
				<?php
					if( isset($loginStatus) )
					{
						echo $loginStatus;
					}
				?>
			</span>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>