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
        ?>
      <p class="h1">Manage Menu | Add Food</p>
      <form action="" method="post" enctype="multipart/form-data">
        <table>
          <tr>
            <td>Food Name : </td>
            <td><input type="text" name="productname" id="pname" placeholder="Name Of The Item" required></td>
          </tr>

          <tr>
            <td>Description : </td>
            <td><textarea name="description" id="description" cols="30" rows="5"></textarea></td>
          </tr>

          <tr>
            <td>Price : </td>
            <td><input type="number" name="price" id="price" placeholder="Price"></td>
          </tr>

          <tr>
            <td>Image : </td>
            <td><input type="file" name="image" id="image"></td>
          </tr>
          <tr>
            <td>Category</td>
            <td>
              <select name="category" id="Category">
                <?php
                  $sql1 = "SELECT * FROM drecategorydb WHERE active='Yes'";
                  $result1 = mysqli_query($mysqli, $sql1);  
                  $count = mysqli_num_rows($result1);
                  if ($count>0){
                    while ($row = mysqli_fetch_assoc($result1)){
                      $id = $row['id'];
                      $category = $row['title'];
                      ?>
                        <option value="<?php echo $id;?>"><?php echo $category;?></option>
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
            <td>Best Seller : </td>
            <td>
              <input type="radio" name="bestsell" id="Yes" value="Yes">Yes
              <input type="radio" name="bestsell" id="No" value="No">No
            </td>
          </tr>

          <tr>
            <td><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
            <td><button><a href="manage_food.php" class="btn-secondary">Cancel</a></button></td>
          </tr>
        </table>
      </form>
      </div>
    </div>
    
    <?php
      if(isset($_POST['submit'])){
          $title = $_POST['productname'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];
          $bestseller = $_POST['bestsell'];
          
          if(isset($_POST['featured'])){
              $featured = $_POST['featured'];
          } else {
              $featured = "No";
          }
          
          if(isset($_POST['active'])){
              $active = $_POST['active'];
          } else {
              $active = "No";
          }

          if(isset($_POST['bestsell'])){
            $bestseller = $_POST['bestsell'];
        } else {
            $bestseller = "No";
        }
          
          $image_name = $_FILES['image']['name'];
          $tmp_name = $_FILES['image']['tmp_name'];
          $ext = end(explode('.', $image_name));
          $image_name = "Food-Name-".rand(0000,9999).".".$ext;
          $dst = "../Res/uploads/menu/".$image_name;
          $upload = move_uploaded_file($tmp_name, $dst);
          
          if($upload==false){
              $_SESSION['upload'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to Upload.</div>";
          } else {
              $_SESSION['upload'] = "<div class='alert alert-success'><strong>Success!</strong> Upload Successfully.</div>";
          }
          
          $sql2 = "INSERT INTO drefooddb SET title=?, description=?, price=?, image_name=?, category_id=?, featured=?, bestseller=?, active=?";
          $stmt2 = $mysqli->prepare($sql2);
          
          // Create variables for binding
          $title_bind = $title;
          $description_bind = $description;
          $price_bind = $price;
          $image_name_bind = $image_name;
          $category_bind = $category;
          $featured_bind = $featured;
          $bestseller_bind = $bestseller;
          $active_bind = $active;
          
          // Bind variables
          $stmt2->bind_param("ssssssss", 
                            $title_bind, 
                            $description_bind, 
                            $price_bind, 
                            $image_name_bind, 
                            $category_bind, 
                            $featured_bind, 
                            $bestseller_bind, 
                            $active_bind);
          
          $stmt2->execute();
          
          if($stmt2->affected_rows > 0){
              $_SESSION['add-food'] = "<div class='alert alert-success'><strong>Success!</strong> Item Added.</div>";
              header('Location: manage_food.php');
              exit;
          } else {
              $_SESSION['add-food'] = "<div class='alert alert-danger'><strong>Error!</strong> Failed to add Item.</div>";
              header('Location: manage_food.php');
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