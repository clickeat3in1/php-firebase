<?php
session_start();
include('dbcon.php');

//Register
use Kreait\Firebase\Exception\FirebaseException;
try {
if(isset($_POST['register_btn']))
{
    $fullname = $_POST['full_name'];
    $storename = $_POST['storeName'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile = $_FILES['image']['name'];
    $object = $bucket->upload(
        file_get_contents($_FILES['image']['tmp_name']),
        [
            'name' => $profile,
            'predefinedAcl' => 'publicRead'
        ]
    );
    $publicUrl = "https://{$bucket->name()}.storage.googleapis.com/{$object->name()}";

    $userProperties = [
        
        'email' => $email,
        'phone' => '+63'.$phone,
        'password' =>  $password,
        'displayName' => $storename,
    ];
    
    $createdUser = $auth->createUser($userProperties);
    $ref_table = "merchant/";
    $postRef_result = $database->getReference($ref_table.$createdUser->uid)->set([
      //  'uid' => $createdUser->uid,
        'email' => $email,
        'phone' => '+63'.$phone,
        'ownerName' => $fullname,
        'storeName' =>$storename,
        'address' => $address,
        'businesspermit' => $publicUrl,
    ]
    );
    
    if($createdUser)
    {
        $_SESSION['status'] = "Successfully Registered!";
        header('Location: login.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "User Not Registered ";
        header('Location: register.html');
        exit();
    }
    
}
  
} catch (FirebaseException $e) {
    echo 'An error has occurred while working with the SDK: '.$e->getMessage;
} 

//Login
if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password']; 

    try {
        $user = $auth->getUserByEmail("$email");

        try {
            $signInResult = $auth->signInWithEmailAndPassword($email, $password);
            $idTokenString = $signInResult->idToken();

            try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->claims()->get('sub');

            $claims = $auth->getUser($uid)->customClaims;
            if(isset($claims['admin']) == true)
                {
                    $_SESSION['verified_admin'] = true;
                    $_SESSION['verified_user_id'] = $uid;
                    $_SESSION['idTokenString'] = $idTokenString;
                }
                elseif(isset($claims['merchant']) == true)
                {
                    $_SESSION['verified_merchant'] = true;
                    $_SESSION['verified_user_id'] = $uid;
                    $_SESSION['idTokenString'] = $idTokenString;
                }
                elseif($claims == null)
                {
                    $_SESSION['verified_user_id'] = $uid;
                    $_SESSION['idTokenString'] = $idTokenString;
                    $_SESSION['status'] ="Logged in Successfully";
                header('Location: merchant-index.php');
                exit();
                }
            $_SESSION['status'] ="Logged in Successfully";
            header('Location: admin-index.php');
            exit();

            } catch (InvalidToken $e) {
            echo 'The token is invalid: '.$e->getMessage();
            } catch (\InvalidArgumentException $e) {
            echo 'The token could not be parsed: '.$e->getMessage();
            }

        }
        catch(Exception $e)
        {
            $_SESSION['status'] ="Wrong Password";
            header('Location: login.php');
            exit();
        }

    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        //echo $e->getMessage();
        $_SESSION['status'] ="Invalid Email Address";
        header('Location: login.php');
        exit();
    }
}
else 
{
    $_SESSION['status'] ="Not Allowed";
    header('Location : login.php');
    exit();
}

?>