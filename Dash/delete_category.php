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

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql="DELETE FROM drecategorydb WHERE id=$id";
        $res=mysqli_query($mysqli, $sql);
        if($res==true){
            $_SESSION['delete']="<div class='alert alert-success'><strong>Success!</strong> Category Deleted.</div>";
            header('location:'.SITEURL.'manage_category.php');
        }else{
            $_SESSION['delete']="<div class='alert alert-danger'><strong>Error!</strong> Failed to delete Category.</div>";
            header('location:'.SITEURL.'manage_category.php');
        }
    }else{
        header('Location:'.SITEURL.'manage_category.php');
    }
}
}
?>