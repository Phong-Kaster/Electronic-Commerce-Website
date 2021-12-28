<?php
	include '../../configuration/globalVariable.php';
	include ( __DIR__ .  '/section/header.php' );
?>
<?php 
	/**If a session does not exists, redirect to login.php */
	if( !Session::get("customerLogin"))
	{
		header('Location:login.php');
	}
?>
 <div class="main">
    <div class="content">
    	PAYMENT PAGE	
    </div>
 </div>

 <?php 
	 include (__DIR__ . '/section/footer.php' ) ;
  ?>