<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['verified_user_id']))
{
    if(isset($_SESSION['verified_admin']))
    {
        $uid = $_SESSION['verified_user_id'];
        $idTokenString = $_SESSION['idTokenString'];

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

            $claims = $auth->getUser($uid)->customClaims;
            if(isset($claims['admin']) == true)
            {
                 //echo "Working"; 
            }  
            else
            {
                header("Location: logout.php");
                exit(0);
            }          
        } catch (InvalidToken $e) {
        // echo 'The token is invalid: '.$e->getMessage();
            $_SESSION['expiry_status'] ="Token Expired/Invalid. Login Again";
            header('Location: logout.php');
            exit();
        } catch (\InvalidArgumentException $e) {
            echo 'The token could not be parsed: '.$e->getMessage();
            $_SESSION['expiry_status'] ="Token Expired/Invalid. Login Again";
            header('Location: logout.php');
            exit();
        }
    }
    else
    {
        $_SESSION['status'] ="Access Denied, not an Admin";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
}
else
{
    $_SESSION['status'] ="Login to access this page";
    header('Location: login.php');
    exit();
}

?>