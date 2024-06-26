<?php
ob_start();

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
    <title>DRE | Manage Food</title>
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
          if(isset($_SESSION['remove-file'])){
            echo $_SESSION['remove-file'];
            unset($_SESSION['remove-file']);
          }
          ?>
        <?php 
        if(isset($_GET['id'])){
          $item_id = $_GET['id'];
          $sqlla = "SELECT * FROM drefooddb WHERE id=$item_id";
          $resultla = mysqli_query($mysqli, $sqlla);  
          $count2 = mysqli_fetch_assoc($resultla);
          
          $current_title = $count2['title'];
          $current_description = $count2['description'];
          $current_price = $count2['price'];
          $current_img = $count2['image_name'];
          $current_category = $count2['category_id'];
          $current_featured = $count2['featured'];
          $current_active = $count2['active'];
        }
        ?>
      <p class="h1">Manage Menu | Edit Picture</p>
      <form action="" method="post" enctype="multipart/form-data">
        <table>
          <tr>Title
            <td> : </td>
            <td><input type="text" name="picturetitle" id="pname" placeholder="Title" value="<?php echo $current_title;?>" required></td>

          </tr>

          <tr>
            <td>Description : </td>
            <td><textarea name="description" id="description" cols="30" rows="5"><?php echo $current_description; ?></textarea></td>
          </tr>

          <tr>
            <td>Price : </td>
            <td><input type="number" name="price" id="price" placeholder="Price" value="<?php echo $current_price; ?>"></td>
          </tr>

          <tr>
            <td>Current Image : </td>
            <td>
              <?php 
                if($current_img==""){
                  echo "<div>Image Not Available.</div>";
                }else{
                  ?>
                  <img src="../Res/uploads/menu/<?php echo $current_img; ?>" width="100" height="100">
                  <?php
                }
              ?>
            </td>
          </tr>

          <tr>
            
            <td>New Image : </td>
            <td><input type="file" name="image" id="image"></td>
            
          </tr>
          <tr>
            <td>Category</td>
            <td>
              <select name="category" id="category">
                <?php
                  $sql1 = "SELECT * FROM drecategorydb WHERE active='Yes'";
                  $result1 = mysqli_query($mysqli, $sql1);  
                  $count1 = mysqli_num_rows($result1);
                  if ($count1>0){
                    while ($row = mysqli_fetch_assoc($result1)){
                      $category_id = $row['id'];
                      $category_title = $row['title'];
                      ?>
                        <option <?php if($current_category == $category_id){echo "selected";} ?>value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                      <?php
                    }
                  }else{
                    ?>
                    <option value='0'>No Category</option>
                    <?php
                  }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>Featured : </td>
            <td>
              <input <?php if($current_featured=="Yes"){echo "Checked";}?> type="radio" name="featured" id="Yes" value="Yes">Yes
              <input <?php if($current_featured=="No"){echo "Checked";}?> type="radio" name="featured" id="No" value="No">No
            </td>
          </tr>
          <tr>
            <td>Active : </td>
            <td>
              <input <?php if($current_active=="Yes"){echo "Checked"; }?> type="radio" name="active" id="Yes" value="Yes">Yes
              <input <?php if($current_active=="No"){echo "Checked"; }?> type="radio" name="active" id="No" value="No">No
            </td>
          </tr>

          <tr>
            <input type="hidden" name="id" value="<?php 
            echo $item_id;
            ?>">
            <input type="hidden" name="curr_image" value="<?php echo  $current_img;?>">


            <td><input type="submit" name="submit" value="Apply Changes" class="btn-secondary"></td>
            <td><button><a href="manage_picture.php" class="btn-secondary">Cancel</a></button></td>
          </tr>
        </table>
      </form>

        <?php
        if(isset($_POST['submit']))
        {
          $id = $_POST['id'];
          $title = $_POST['picturetitle'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $currt_image = $_POST['curr_image'];
          $category = $_POST['category'];
          $featured = $_POST['featured'];
          $active = $_POST['active'];

          if(isset($_FILES['image']['name']))
          {
            $image_name = $_FILES['image']['name'];
            if($image_name!="")
            {
              $ext = end(explode('.', $image_name));
              $image_name = "Food-Name-".rand(0000,9999).".".$ext;
              $src_path = $_FILES['image']['tmp_name'];
              $dest_path = "../Res/uploads/menu/".$image_name;

              $upload = move_uploaded_file($src_path, $dest_path);

              if($upload==false){
                $_SESSION['upload'] = $_SESSION['upload'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to Upload.</div>";
                header('location:'.SITEURL.'manage_food.php');
                die();
              }

              if($currt_image!="")
              {
                $remove_path = "../Res/uploads/menu/".$currt_image;
                $remove = unlink($remove_path);
                if($remove==false){
                  $_SESSION['remove-file'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to Remove.</div>";
                  header('location:'.SITEURL.'manage_food.php');
                  die();
                }
              }
            }
          }else{
            $image_name = $currt_image;
          }

          $sql3 = "UPDATE drefooddb SET title='$title', description='$description', price='$price', image_name='$image_name', category_id='$category', featured='$featured', active='$active' WHERE id=$id";
          $res3 = mysqli_query($mysqli, $sql3);
          if($res3==true){
            $_SESSION['update-food'] = "<div class='alert alert-success'><strong>Success!</strong> Item Updated.</div>";
                header('location:'.SITEURL.'manage_food.php');
              }else{
                $_SESSION['update-food'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to update Item.</div>";
                header('location:'.SITEURL.'manage_food.php');
                die();
            }
        }
        ob_end_flush();
        ?>
      </div>
    </div>

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