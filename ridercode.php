<?php
session_start();
include('dbcon.php');

//Register rider
use Kreait\Firebase\Exception\FirebaseException;
try {
if(isset($_POST['rider_register_btn']))
{
    $ridername = $_POST['ridername'];
    $phonenumber= $_POST['phonenumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $objectName = $_FILES['image']['name'];
    $object = $bucket->upload(
        file_get_contents($_FILES['image']['tmp_name']),
        [
            'name' => $objectName,
            'predefinedAcl' => 'publicRead'
        ]
    );
    $publicUrl = "https://{$bucket->name()}.storage.googleapis.com/{$object->name()}";

    $userProperties = [
        'email' => $email,
      // 'emailVerified' => false,
        'phoneNumber' => '+63'.$phonenumber,
        'password' =>  $password,
        'displayName' => $ridername,
    ];
    
    $createdUser = $auth->createUser($userProperties);
    $ref_table = "rider/";
    $postRef_result = $database->getReference($ref_table.$createdUser->uid)->set([
        'email' => $email,
        'phonenumber' => $phonenumber,
        'ridername' => $ridername,
        'address' => $address,
        'image'=>$publicUrl,
    ]
    );

    if($postRef_result)
    {
        $_SESSION['status'] = "Rider Successfully Registered!";
        header('Location: register-rider.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "User Not Registered ";
        header('Location: register-rider.php');
        exit();
    }
    
}

  
} catch (FirebaseException $e) {
    echo 'An error has occurred while working with the SDK: '.$e->getMessage;
} 

//rider update btn//
if(isset ($_POST['rider_update_btn']))
{
  $key = $_POST['key'];
  $ridername = $_POST['ridername'];
  $phonenumber= $_POST['phonenumber'];
  $address = $_POST['address'];
  $email = $_POST['email'];

    $updateData = [
        'email' => $email,
      // 'emailVerified' => false,
        'phonenumber' => $phonenumber,
        'address' =>  $address,
        'ridername' => $ridername,
    ];
    $ref_table ='rider/'.$key;
    $updatequery_result = $database->getReference($ref_table)->update($updateData);
    

    if($updatequery_result)
    {
        $_SESSION['status'] = "Rider Updated Successfully";
        header('Location: register-rider.php');
    }
    else
    {
        $_SESSION['status'] = "Rider Not Updated ";
        header('Location: register-rider.php');
    }

}


//Delete rider
if(isset($_POST['rider_delete_btn']))
{
    $del_id = $_POST['rider_delete_btn'];

  $reftable = 'rider/'.$del_id;
    $deletequeryresult = $database->getReference($reftable)->remove();
    $auth->deleteUser($del_id);

    if($deletequery_result)
    {
        $_SESSION['status'] = "Rider Deleted Successfully";
        header('Location: register-rider.php');
    } else if($deletequeryresult)
    {
        $_SESSION['status'] = "Rider Deleted Successfully";
        header('Location: register-rider.php');
    }
    else
    {
        $_SESSION['status'] = "Rider Not Deleted ";
        header('Location: register-rider.php');
    }

}

?>