<?php
	include '../../configuration/globalVariable.php';
	include ( __DIR__ .  '/section/header.php' );
?>
<?php 
	/**If a session exists, redirect to payment.php */
	if( Session::get("customerLogin"))
	{
		header('Location:payment.php');
	}
?>
<?php 
	if( isset( $_POST['createAccount'] ) )
	{
		$status = $customerModel->createAccount($_POST);
	}

	if( isset( $_POST['login']) )
	{
		$status = $customerModel->login($_POST);
	}
?>
 <div class="main">
 	<?php
            if( isset($status))
            {
                echo $status;
            }
			// echo "CUSTOMER LOGIN". Session::get("customerLogin")."<br>";
            // echo "CUSTOMER ID". Session::get("customerID")."<br>";
            // echo "CUSTOMER NAME". Session::get("customerName")."<br>";
    ?>
    <div class="content">
		
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form method="post"  action="" enctype="multipart/form-data" >
                	<input name="username" type="text" placeholder="Username" >
                    <input name="password" type="password" placeholder="Password">
					<div class="buttons">
						<div>
							<input type="submit" name="login" value="Log In" /> 
						</div>
					</div>
        	</form>
                 <p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
                    
        </div>


    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<form method="post" action="" enctype="multipart/form-data">
		   			 <table>
		   				<tbody>
							<tr>
								<td>
									<div>
										<input type="text" name="email"  placeholder="Email">
									</div>

									<div>
										<input type="text" name="address" placeholder="Address">
									</div>

									<div>
										<input type="text" name="username" placeholder="Username" >
									</div>
									
									<div>
										<input type="text" name="password" placeholder="Password">
									</div>
									
									<div>
										<input type="text" name="confirmpassword" placeholder="ConfirmPassword">
									</div>


								</td>
							</tr> 
						</tbody>
					</table> 
		   			<div class="search">
					   <div>
						   <input type="submit" name="createAccount" value="Create" /> 
						</div>
					</div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php 
	include (__DIR__ . '/section/footer.php' ) ;
 ?>