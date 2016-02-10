<?      
include 'common/config.php';
  
if ($_REQUEST['tryout'] == '1') {
    
    if ($_SERVER[REMOTE_ADDR] == '46.146.232.230') {
        $ip_addr = '78.80.3.70';
    } else {
        $ip_addr = $_SERVER[REMOTE_ADDR]; 
        //$ip_addr = '78.80.3.70';
       
    }
    
    //var_dump($_REQUEST);exit;
    //$country = get_country($ip_addr);    //david
        
    $ip_addr = '61.176.96.70';  
    $country = "CN";   //david

    
       
    $sql = "SELECT * FROM `users` WHERE (LOWER(`user_email`)='" . strtolower($_REQUEST['user_email']) . "' OR LOWER(`user_name`)='" . strtolower($_REQUEST['user_email']) . "') AND `user_pass`='" . strtolower(md5($_REQUEST['user_pass'])) . "'";
    //echo $sql;  exit;
    $q = mysql_query($sql);
       
    $row = mysql_fetch_array($q);
    //var_dump($row);exit;
                
    if (mysql_num_rows($q) == 0) {
        $errormsg = 'Wrong user name and/or password!';
        //mysql_query("INSERT INTO `users_log` (`tryout_ip`, `tryout_country`, `tryout_user_email`, `tryout_status`) VALUES ('{$ip_addr}', '{$country}', '$_REQUEST[user_email]', 'UNSUCCESS')");
        
        //echo('<script language="JavaScript"> alert("' . $errormsg . '");</script>');
        echo('<script language="JavaScript">window.location.href = "index.php?mode=login&error=wrong"</script>'); 
        
    } else {      
        if ($row[user_system_status] == '0') 
        {   
            $errormsg = 'Your account is suspended!';
            //echo('<script language="JavaScript"> alert("' . $errormsg . '");</script>');
            echo('<script language="JavaScript">window.location.href = "index.php?mode=login&error=suspend"</script>'); 
        } 
        else if ($row[user_system_status] == '2') 
        {   
            $errormsg = 'Your account is reviewing! it will finish in 48hrs ';
            //echo('<script language="JavaScript"> alert("' . $errormsg . '");</script>');
            echo('<script language="JavaScript">window.location.href = "index.php?mode=login&error=review"</script>'); 
        }
        else 
        {
                           
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_first_name'] = $row['user_first_name'];
            $_SESSION['user_last_name'] = $row['user_last_name'];
            $_SESSION['user_status'] = $row['user_status'];
            $_SESSION['user_system_status'] = $row['user_system_status'];
            $_SESSION['network_id'] = $row['network_id'];
            mysql_query("UPDATE `users` SET `lastvisit_datetime`=NOW(), `lastvisit_ip`='$ip_addr', `lastvisit_country`='{$country}' WHERE LOWER(`user_email`)='" . strtolower($_REQUEST['user_email']) . "'");
            mysql_query("INSERT INTO `users_log` (`tryout_ip`, `tryout_country`, `tryout_user_email`, `tryout_status`) VALUES ('{$ip_addr}', '{$country}', '$_REQUEST[user_email]', 'SUCCESS')");

            $user_s = $row[user_status];
            
            //var_dump($user_s);exit;
            
            if($user_s == "0" || $user_s == "1")
            {
                //var_dump($user_s);exit;
                echo('<script language="JavaScript">window.location.href = "networkowner/dashboard.php"</script>');
            } 
            else if($user_s == "2")
            {
                 echo('<script language="JavaScript">window.location.href = "advertiser_manager/dashboard.php"</script>');   
            }  
            else if($user_s == "3")
            {
                 echo('<script language="JavaScript">window.location.href = "publisher/dashboard.php"</script>');
            }
            else if($user_s == "4")
            {
                 echo('<script language="JavaScript">window.location.href = "advertiser_manager/dashboard.php"</script>');
            }
            else if($user_s == "5")
            {
                 echo('<script language="JavaScript">window.location.href = "publisher_manager/dashboard.php"</script>');
            }
            
            break;

        }
    }
} else {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_first_name']);
    unset($_SESSION['user_last_name']);
    unset($_SESSION['user_status']);
    unset($_SESSION['user_system_status']);
    unset($_SESSION['network_id']);
    
    echo('<script language="JavaScript">window.location.href = "index.html"</script>');   
}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>StartInstaller</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="common/assets/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="common/assets/css/style.css" rel="stylesheet" />
        <link href="common/assets/css/style_responsive.css" rel="stylesheet" />
        <link href="common/assets/css/style_default.css" rel="stylesheet" id="style_color" />
        <link rel="stylesheet" type="text/css" href="common/assets/uniform/css/uniform.default.css" />

        <link rel="shortcut icon" href="favicon.png">
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body>
        <!-- BEGIN LOGO -->
        <div id="logo" class="center">
            <img src="common/assets/img/logo.png" alt="logo" class="center" />
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div id="login">
            <!-- BEGIN LOGIN FORM -->
            <form id="loginform" class="form-vertical no-padding no-margin" action="login.php" method="POST">
                <input type="hidden" name="tryout" value="1"/>
                <p class="center">Enter your username and password.</p>
                <div class="control-group <? if ($errormsg != '') echo 'error'; ?>">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input id="input-username" name="user_email" type="text" placeholder="Username OR Email" value="<?= $_REQUEST[user_email] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="control-group <? if ($errormsg != '') echo 'error'; ?>">

                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input id="input-password" name="user_pass" type="password" placeholder="Password" value="<?= $_REQUEST[user_pass] ?>"/>
                        </div>
                        <!--          <div class="block-hint pull-right">
                                    <a href="javascript:;" class="" id="forget-password">Forgot Password?</a>
                                  </div>-->
                        <div class="clearfix space5"></div>
                    </div>
                </div>
                <input type="submit" id="login-btn" class="btn btn-block btn-inverse" value="Login" />
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form id="forgotform" class="form-vertical no-padding no-margin hide" action="index.html">
                <p class="center">Enter your e-mail address below to reset your password.</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input id="input-email" type="text" placeholder="Email" />
                        </div>
                    </div>
                    <div class="space10"></div>
                </div>
                <input type="button" id="forget-btn" class="btn btn-block btn-inverse" value="Submit" />
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div id="login-copyright">
            2013 &copy; StartInstaller.
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS -->
        <script src="common/assets/js/jquery-1.8.2.min.js"></script>
        <script src="common/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="common/assets/js/jquery.blockui.js"></script>
        <script src="common/assets/js/app.js"></script>
        <script>
            jQuery(document).ready(function() {
                App.initLogin();
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
