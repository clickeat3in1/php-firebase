<?php
session_start();
include('dbcon.php');

//Add Product
if(isset($_POST['save_btn']))
{
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $objectName = $_FILES['image']['name'];
    $object = $bucket->upload(
        file_get_contents($_FILES['image']['tmp_name']),
        [
            'name' => $objectName,
            'predefinedAcl' => 'publicRead'
        ]
    );
    $publicUrl = "https://{$bucket->name()}.storage.googleapis.com/{$object->name()}";
    $uid = $_SESSION['verified_user_id'];
    $user = $auth->getUser($uid);
    
    $postData = [
        'storename' => $user->displayName,
        'merchantid' => $user->uid,
        'category'=>$category,
        'name'=>$name,
        'description'=>$description,
        'price'=>$price,
        'image'=>$publicUrl,
    ];
    $ref = "item/";
    $post_result = $database->getReference($ref)->push($postData);

    if($post_result)
    {
        $_SESSION['status'] = "Product Added Successfully";
        header('Location: merhant-products.php');
    }
    else
    {
        $_SESSION['status'] = "Product Not Added ";
        header('Location: merchant-products.php');
    }
}

//Update Product
if(isset ($_POST['updated_btn']))
{
    $key = $_POST['key'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $updateData = [
        'category'=>$category,
        'name'=>$name,
        'description'=>$description,
        'price'=>$price,
    ];
    $ref_table ='item/'.$key;
    $updatequery_result = $database->getReference($ref_table)->update($updateData);

    if($updatequery_result)
    {
        $_SESSION['status'] = "Product Updated Successfully";
        header('Location: merchant-products.php');
    }
    else
    {
        $_SESSION['status'] = "Product Not Updated ";
        header('Location: merchant-products.php');
    }
}

//Merchant Delete Product 
if(isset($_POST['delete_btn']))
{
    $del_id = $_POST['delete_btn'];

    $reftable = 'item/'.$del_id;
    $deletequeryresult = $database->getReference($reftable)->remove();

    if($deletequery_result)
    {
        $_SESSION['status'] = "Product Deleted Successfully";
        header('Location: merchant-products.php');
    } 
    else
    {
        $_SESSION['status'] = "Product Not Deleted ";
        header('Location: merchant-products.php');
    }
}


//Admin Delete Product 
if(isset($_POST['delete_btn']))
{
    $del_id = $_POST['delete_btn'];

    $reftable = 'item/'.$del_id;
    $deletequeryresult = $database->getReference($reftable)->remove();

    if($deletequery_result)
    {
        $_SESSION['status'] = "Product Deleted Successfully";
        header('Location: admin-products.php');
    } 
    else
    {
        $_SESSION['status'] = "Product Not Deleted ";
        header('Location: admin-products.php');
    }
}

//Admin Profile
if(isset($_POST['updated_user_profile']))
{
    $display_name = $_POST['displayName'];
    $phone = $_POST['phone'];
    $profile = $_FILES['profile']['name'];
    $random_no = rand(1111,9999);
    $object = $bucket->upload(
        file_get_contents($_FILES['profile']['tmp_name']),
        [
            'name' => $profile,
            'predefinedAcl' => 'publicRead'
        ]
    );
    $publicUrl = "https://{$bucket->name()}.storage.googleapis.com/{$object->name()}";

    $uid = $_SESSION['verified_user_id'];
    $user = $auth->getUser($uid);

    $properties = [
        'displayName' => $display_name,
        'phone' => $phone,
        'photoUrl' => $publicUrl,
    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if($updatedUser)
    {
        $_SESSION['status'] = "User Profile Updated";
        header("Location: admin-profile.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "User Profile Not Updated";
        header("Location: admin-profile.php");
        exit(0);
    }
}

//Merchant Profile
if(isset($_POST['update_user_profile']))
{
    $display_name = $_POST['displayName'];
    $phone = $_POST['phone'];
    $profile = $_FILES['profile']['name'];
    $random_no = rand(1111,9999);
    $object = $bucket->upload(
        file_get_contents($_FILES['profile']['tmp_name']),
        [
            'name' => $profile,
            'predefinedAcl' => 'publicRead'
        ]
    );
    $publicUrl = "https://{$bucket->name()}.storage.googleapis.com/{$object->name()}";

    $uid = $_SESSION['verified_user_id'];
    $user = $auth->getUser($uid);

    $properties = [
        'displayName' => $display_name,
        'phone' => $phone,
        'photoUrl' => $publicUrl,
    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if($updatedUser)
    {
        $_SESSION['status'] = "User Profile Updated";
        header("Location: merchant-profile.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "User Profile Not Updated";
        header("Location: merchant-profile.php");
        exit(0);
    }
}


// //Pending - Transporting - Completed Status
// if(isset($_POST['status']))
// {
//     $status_id = $_POST['status_id'];
//     $status = $_POST['status'];
//     $updateData = [
//         'status'=> $status,
//     ];
//     $ref_table ='orders/'.$status_id;
//     $update_status = $database->getReference($ref_table)->update($updateData);

//     if($update_status)
//     {
     
//         $_SESSION['status'] = "Product Updated Successfully";
//         header('Location: admin-order.php');
//     }
 
//     elseif($update_status)
//     {
       
//     } 
// }


// Change Password
if(isset($_POST['change_password_btn']))
{
    $new_password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];

    $uid = $_POST['change_pwd_user_id'];

    if($new_password == $retype_password)
    {
        $updatedUser = $auth->changeUserPassword($uid, $new_password);
        if($updatedUser)
        {
            $_SESSION['status'] = "Password Updated";
            header('Location: user-list.php');
            exit();
        }
        else
        {
            $_SESSION['status'] = "Password not Updated";
            header('Location: user-list.php');
            exit();
        }
    }
    else
    {
        $_SESSION['status'] = "New Password does not match";
        header("Location: user-edit.php?id=$uid");
        exit();
    }
}


//Delete Merchant
if(isset($_POST['merchant_delete_btn']))
{
    $del_id = $_POST['merchant_delete_btn'];

  $reftable = 'merchant/'.$del_id;
    $deletequeryresult = $database->getReference($reftable)->remove();
    $auth->deleteUser($del_id);

    if($deletequery_result)
    {
        $_SESSION['status'] = "Merchant Deleted Successfully";
        header('Location: admin-products.php');
    } else if($deletequeryresult)
    {
        $_SESSION['status'] = "Merchant Deleted Successfully";
        header('Location: admin-products.php');
    }
    else
    {
        $_SESSION['status'] = "Merchant Not Deleted ";
        header('Location: admin-products.php');
    }

}

//Delete Userapp
if(isset($_POST['userapp_delete_btn']))
{
    $del_id = $_POST['userapp_delete_btn'];

  $reftable = 'user/'.$del_id;
    $deletequeryresult = $database->getReference($reftable)->remove();
    $auth->deleteUser($del_id);

    if($deletequery_result)
    {
        $_SESSION['status'] = "User Deleted Successfully";
        header('Location: admin-user-app.php');
    } else if($deletequeryresult)
    {
        $_SESSION['status'] = "User Deleted Successfully";
        header('Location: admin-user-app.php');
    }
    else
    {
        $_SESSION['status'] = "User Not Deleted ";
        header('Location: admin-user-app.php');
    }

}

//Delete User Account
if(isset($_POST['reg_user_delete_btn']))
{
        $uid = $_POST['reg_user_delete_btn'];
    
        try{
            $auth->deleteUser($uid);
    
            $_SESSION['status'] = "User Delete Successfully";
            header('Location: user-list.php');
            exit();
    
        }catch(Exemption $e){
            $_SESSION['status'] = "No Id Found  ";
            header('Location: user-list.php');
            exit();
        }   
}



// Update User Account
if(isset($_POST['update_acc']))
{
    $disable_enable = $_POST['select_enable_disable'];
    $uid = $_POST['ena_dis_user_id'];
    $displayname = $_POST["display_name"];
    $phone = $_POST["phone"];
    $uid_id = $_POST['user_id'];
    $claims_user_uid = $_POST['claims_user_id'];
    $roles = $_POST['role_as'];
    $properties = [
            'displayName' => $displayname,
            'phoneNumber' => $phone,
        ];
    
    $updateUser = $auth->updateUser($uid, $properties);
   
    if($roles == 'admin')
    {
        $auth->setCustomUserClaims($claims_user_uid, ['admin' => true,]);
        $msg = "User role as Admin ";
    }
    elseif($roles == 'merchant')
    {
        $auth->setCustomUserClaims($claims_user_uid, ['merchant' => true,]);
        $msg = "User role as Merchant ";
    }
    elseif($roles == 'norole')
    {
        $auth->setCustomUserClaims($claims_user_uid, null);
        $msg = "User role is Removed";
    }

    if($disable_enable == "disable")
    {
        $updatedUser = $auth->disableUser($uid_id);
       
    }
    else
    {
        $updatedUser = $auth->enableUser($uid_id);
       
    }
    
    if($updatedUser && $updateUser)
    {
        $_SESSION['status'] = "Updated Successfully";
        header('Location: user-list.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "Something went wrong";
        header('Location: user-list.php');
        exit();
    }
}


?>