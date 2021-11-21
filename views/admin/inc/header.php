<?php
    include dirname( __DIR__, 3) . '/lib/session.php';
    Session::checkSession();
?>
<?php
  
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>/admin/css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>/admin/css/text.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>/admin/css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>/admin/css/layout.css" media="screen" />
   
    <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>/admin/css/nav.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= ASSET_URL ?>/admin/css/table/demo_page.css"  />
    <!-- BEGIN: load jquery -->
    <script src="<?= ASSET_URL ?>/admin/js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="<?= ASSET_URL ?>/admin/js/jquery-ui/jquery.ui.core.min.js" type="text/javascript"></script>
    <script src="<?= ASSET_URL ?>/admin/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>

    <script src="<?= ASSET_URL ?>/admin/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="<?= ASSET_URL ?>/admin/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    
    <script src="<?= ASSET_URL ?>/admin/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="<?= ASSET_URL ?>/admin/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    
    <script src="<?= ASSET_URL ?>/admin/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="<?= ASSET_URL ?>/admin/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script src="<?= ASSET_URL ?>/admin/js/table/table.js" type="text/javascript"></script>
    <script src="<?= ASSET_URL ?>/admin/js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="<?= ASSET_URL ?>/admin/img/livelogo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Shine like a diamond</h1>
					<p>Nguyen Thanh Phong</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="<?= ASSET_URL ?>/admin/img/Blue.jpg" width="20px;" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <?php 
                                /************************************************************
                                 * if GET action is set and action equals 'logout', remove the session
                                 ************************************************************/
                                if( isset( $_GET['action'] ) && $_GET['action'] == 'logout')
                                {
                                    Session::destroy();
                                }
                            ?>
                            <li>Hi <?php echo Session::get("name") ?></li><!-- Hi phong kaster -->
                            
                            <li>
                                <a href="?action=logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href=""><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox</span></a></li>
                <li class="ic-charts"><a href=""><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
    