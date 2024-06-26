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
      <p class="h1">Manage Menu | Add FAQ</p>
      <?php 
      if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }?>

      <br><br>

      <form action="" method="post" enctype="multipart/form-data">
        <table>
          <tr>
            <td>FAQ Title : </td>
            <td><input type="text" name="title" id="pname" placeholder="Title" require></td>
          </tr>
          <tr>
            <td>FAQ Answer : </td>
            <td><input type="text" name="answer" id="pname" placeholder="Answer" require></td>
          </tr>
          <tr>
            <td>Featured : </td>
            <td>
              <input type="radio" name="featured" id="Yes" value="Yes">Yes
              <input type="radio" name="featured" id="No" value="No">No
            </td>
          </tr>
          <tr>
            <td>Active : </td>
            <td>
              <input type="radio" name="active" id="Yes" value="Yes">Yes
              <input type="radio" name="active" id="No" value="No">No
            </td>
          </tr>
          <tr>
            <td><input type="submit" name="submit" value="Add FAQ" class="btn-secondary"></td>
            <td><button><a href="manage_category.php" class="btn-secondary">Cancel</a></button></td>
          </tr>
        </table>
      </form>
      </div>
    </div>
    

    <?php 

    if (isset($_POST['submit'])){
      $title = $_POST['title'];
      $answer = $_POST['answer'];

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
    

    $sqll = "INSERT INTO drefaqdb SET
    title = '$title',
    answer = '$answer',
    featured = '$featured',
    active = '$active'
    ";

    $resl = mysqli_query($mysqli, $sqll);
    
    if ($resl == true){
      $_SESSION['add'] = "<div class='alert alert-success'><strong>Success!</strong> FAQ Added.</div>";
      header('location:'.SITEURL.'manage_faq.php');
    }else{
      $_SESSION['add'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to add FAQ.</div>";
      header('location:'.SITEURL.'manage_faq.php');
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