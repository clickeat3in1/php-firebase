<?php
session_start();

unset( $_SESSION['verified_user_id']);
unset( $_SESSION['idTokenString']);

if(isset($_SESSION['verified_admin']))
{
    unset($_SESSION['verified_admin']);
    $_SESSION['status'] = "Logged out Successfully ";
}
elseif($_SESSION['verified_merchant'])
{
    unset($_SESSION['verified_merchant']);
    $_SESSION['status'] = "Logged out Successfully ";
}


if(isset($_SESSION['expiry_status']))
{
    $_SESSION['status'] = "Session Expired";
}
else
{
    $_SESSION['status'] = "Logged Out Successfully";
}
$_SESSION['status'] = "Logged Out Successfully";
header('Location: login.php');
exit();

?>