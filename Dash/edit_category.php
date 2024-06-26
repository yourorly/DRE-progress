<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DRE | Manage Category</title>
    <link rel="stylesheet" href="../Res/CSS/main.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php if (isset($user)): ?>
    <?php if ($user["access_level"] == "admin"): ?>
      <?php include ("../Res/preperals/nav_bar_Admin.php"); ?>
      <?php include("../Res/preperals/define.php");?>
    <div class="container-fluid manage-items main">
      <div class="glass-filter">
        <br><br>
      <p class="h1">Manage Menu | Edit Category</p>

      <?php 
      if(isset($_SESSION['edit'])){
        echo $_SESSION['edit'];
        unset($_SESSION['edit']);
      }?>

      <br><br>

      <?php
      if (isset($_GET['id'])){
        $id = $_GET['id'];
        $sqlt = "SELECT * FROM drecategorydb WHERE id = $id";
        $resulte = mysqli_query($mysqli, $sqlt);
        $count = mysqli_num_rows($resulte);
        if ($count==1){
          $row = mysqli_fetch_array($resulte);
          $id = $row['id'];
          $title = $row['title'];
          $featured = $row['featured'];
          $active = $row['active'];
        }else{
          $_SESSION['edit'] = "<div class='alert alert-danger'><strong>Error!</strong> Category Not Found :<.</div>";
          header('location:'.SITEURL.'manage_category.php');
        }
      }else{

      }
      ?>

      <form action="" method="post" enctype="multipart/form-data">
        <table>
          <tr>
            <td>Category Name : </td>
            <td><input type="text" name="CategoryName" id="pname" placeholder="Title" value="<?php echo $title;?>" required></td>

          </tr>
          <tr>
            <td>Featured : </td>
            <td>
              <input <?php if($featured=="Yes"){echo "Checked";}?> type="radio" name="featured" id="Yes" value="Yes">Yes
              <input <?php if($featured=="No"){echo "Checked";}?> type="radio" name="featured" id="No" value="No">No
            </td>
          </tr>
          <tr>
            <td>Active : </td>
            <td>
              <input <?php if($active=="Yes"){echo "Checked";}?> type="radio" name="active" id="Yes" value="Yes">Yes
              <input <?php if($active=="No"){echo "Checked";}?> type="radio" name="active" id="No" value="No">No
            </td>
          </tr>
          <tr>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="submit" name="submit" value="Apply Changes" class="btn-secondary">
            <td><button><a href="manage_category.php" class="btn-secondary">Cancel</a></button></td>
          </tr>
        </table>
      </form>
      </div>
    </div>

    <?php 

    if (isset($_POST['submit'])){
      $id = $_POST['id'];
      $title = $_POST['CategoryName'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      if (isset($_POST['featured'])){
        $featured = $_POST['featured'];
      }
      else{
        $featured = "No";
      }
      
      if (isset($_POST['active'])){
        $active = $_POST['active'];
      }
      else{
        $active = "No";
      }

      $sqll = "UPDATE drecategorydb SET
      title = '$title',
      featured = '$featured',
      active = '$active'
      WHERE id = $id
      ";

      $res2 = mysqli_query($mysqli, $sqll);
      if ($res2 == true){
        $_SESSION['add'] = "<div class='alert alert-success'><strong>Success!</strong> Category Updated.</div>";
        header('location:'.SITEURL.'manage_category.php');
      }else{
        $_SESSION['add'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to edit Category.</div>";
        header('location:'.SITEURL.'manage_category.php');
      }
    }
    ?>

    <?php else:?>
      <div class="main">
        <h1 style="color: white; margin: auto auto; display: block;">Why Are You Here?</h1>
        </div>
        <?php endif;?>
    <?php else:?>
      <div class="main">
        <h1 style="color: white; margin: auto auto; display: block;">Why Are You Here?</h1>
        </div>
    <?php endif;?>
</html>