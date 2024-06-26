<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
if (isset($user)){
    if ($user["access_level"] == "admin"){
    include("../Res/preperals/define.php");

    if(isset($_GET['id'])&& isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != ""){
            $path = "../Res/uploads/gallery/".$image_name;
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['delete-food']="<div class='alert alert-danger'><strong>Error!</strong> Failed to Delete Image.</div>";
                header('location:'.SITEURL.'manage_picture.php');
                die();
            }
        }

        $sql="DELETE FROM dregallerydb WHERE id=$id";
        $res=mysqli_query($mysqli, $sql);
        if($res==true){
            $_SESSION['delete-picture']="<div class='alert alert-success'><strong>Success!</strong> Picture Deleted.</div>";
            header('location:'.SITEURL.'manage_picture.php');
        }else{
            $_SESSION['delete-picture']="<div class='alert alert-danger'><strong>Error!</strong> Failed to Picture.</div>";
            header('location:'.SITEURL.'manage_picture.php');
        }
    }else{
        $_SESSION['delete-picture']="<div class='alert alert-danger'><strong>Error!</strong> Unauthorize Action</div>";
        header('Location:'.SITEURL.'manage_picture.php');
    }
}
}
?>