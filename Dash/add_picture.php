<?php
ob_start();

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = ?"; 
    $stmt = $mysqli->prepare($sql);
    $id = $_SESSION["user_id"];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DRE | Manage Gallery</title>
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
        <?php 
          if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }
        ?>
      <p class="h1">Manage Gallery | Add Picture</p>
      <form action="" method="post" enctype="multipart/form-data">
        <table>
          <tr>
            <td>Title : </td>
            <td><input type="text" name="picturetitle" id="pname" placeholder="Title" required></td>
          </tr>

          <tr>
            <td>Description : </td>
            <td><textarea name="description" id="description" cols="30" rows="5"></textarea></td>
          </tr>

          <tr>
            <td>Image : </td>
            <td><input type="file" name="image" id="image"></td>
          </tr>

          <tr>
            <td>Active : </td>
            <td>
              <input type="radio" name="active" id="Yes" value="Yes">Yes
              <input type="radio" name="active" id="No" value="No">No
            </td>
          </tr>

          <tr>
            <td><input type="submit" name="submit" value="Add Picture" class="btn-secondary"></td>
            <td><button><a href="manage_picture.php" class="btn-secondary">Cancel</a></button></td>
          </tr>
        </table>
      </form>
      </div>
    </div>
    
    <?php
      if(isset($_POST['submit'])){
        $title = $_POST['picturetitle'];
        $description = $_POST['description'];
        if(isset($_POST['active'])){
            $active = $_POST['active'];
        } else {
            $active = "No";
        }
        
        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = end(explode('.', $image_name));
        $image_name = "Picture-Name-".rand(0000,9999).".".$ext;
        $dst = "../Res/uploads/gallery/".$image_name;
        $upload = move_uploaded_file($tmp_name, $dst);
        
        if($upload==false){
            $_SESSION['upload'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to Upload.</div>";
        } else {
            $_SESSION['upload'] = "<div class='alert alert-success'><strong>Success!</strong> Upload Successfully.</div>";
        }
        
        $sql2 = "INSERT INTO dregallerydb SET title=?, description=?, image_name=?, active=?";
        $stmt2 = $mysqli->prepare($sql2);
        
        // Bind variables to the prepared statement
        $stmt2->bind_param("ssss", $title, $description, $image_name, $active);
        
        $stmt2->execute();
        
        if($stmt2->affected_rows > 0){
            $_SESSION['add-picture'] = "<div class='alert alert-success'><strong>Success!</strong> Picture Added.</div>";
            header('Location: manage_picture.php');
            exit;
        } else {
            $_SESSION['add-picture'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to add Picture.</div>";
            header('Location: manage_picture.php');
            exit;
        }
    }
      ob_end_flush(); // End output buffering
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