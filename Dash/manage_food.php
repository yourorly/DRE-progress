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
<html>
<head>
    <title>DRE | DashBoard</title>
    <link rel="stylesheet" href="../Res/CSS/main.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
    <style>
      tr > * + * {
        padding-left: 4em;
      }
    </style>
</head>
<body>
<?php if (isset($user)): ?>
    <?php if ($user["access_level"] == "admin"): ?>
      <?php include ("../Res/preperals/nav_bar_Admin.php"); ?>
      <?php include("../Res/preperals/define.php");?>
    <br>
    <div class="container main">
    <h1>Admin Dashboard</h1>
    <div class="h-line"></div>
    <button class="btn btn-light btn-sm" style="padding: 15px;"><a href="../Dash/add_food.php" style="text-decoration: none; color: black; font-weight: bold;">Add Food</a></button>
    <button class="btn btn-light btn-sm" style="padding: 15px;"><a href="../Dash/manage_category.php" style="text-decoration: none; color: black; font-weight: bold;">Manage Category</a></button>
    <div class="h-line"></div>
    <div class="manage-admin">
    <?php 
      if(isset($_SESSION['add-food'])){
        echo $_SESSION['add-food'];
        unset($_SESSION['add-food']);
      }
      if(isset($_SESSION['delete-food'])){
        echo $_SESSION['delete-food'];
        unset($_SESSION['delete-food']);
      }
      
      if(isset($_SESSION['edit-food'])){
        echo $_SESSION['edit-food'];
        unset($_SESSION['edit-food']);
      }
      if(isset($_SESSION['remove-file'])){
        echo $_SESSION['remove-file'];
        unset($_SESSION['remove-file']);
      }
      ?>
      <p class="h2 title">
        Manage <span>Food</span>
      </p>
      <div class="container">
      <table>
        <tr>
          <th>S.N</th>
          <th>Food</th>
          <th>Description</th>
          <th>Price</th>
          <th>Image</th>
          <th>Category</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Best Seller</th>
          <th>Action</th>
        </tr>
      
          <?php
          $sqlc = "SELECT * FROM drefooddb";
          $resultc = mysqli_query($mysqli, $sqlc);
          $count = mysqli_num_rows($resultc);

          $sn = 1;
          if($count>0){
            while($row=mysqli_fetch_assoc($resultc)){
              $id = $row['id'];
              $title = $row['title'];
              $description = $row['description'];
              $price = $row['price'];
              $imgname = $row['image_name'];
              $category = $row['category_id'];
              $featured = $row['featured'];
              $active = $row['active'];
              $bestseller = $row['bestseller'];
              ?>
              <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $title;?></td>
                <td><?php echo $description;?></td>
                <td>₱<?php echo $price;?></td>
                <td>
                  <?php 
                    if($imgname==""){
                      echo "<div> Image not Added.</div>";
                    }else{
                      ?>
                      <img src="../Res/uploads/menu/<?php echo $imgname; ?>" width="100" height="100">
                      <?php
                    }
                  ?>
                </td>
                <?php 
                        $sql1 = "SELECT * FROM drecategorydb WHERE id='$category'";
                        $result1 = mysqli_query($mysqli, $sql1);  
                        $count1 = mysqli_num_rows($result1);
                        while($row1=mysqli_fetch_assoc($result1)){
                          $category_title = $row1['title'];
                          ?>
                <td><?php echo $category_title;?></td>
                <?php } ?>
                <td><?php echo $featured;?></td>
                <td><?php echo $active;?></td>
                <td><?php echo $bestseller;?></td>
                <td>
                  <a href="edit_food.php?id=<?php echo $id;?>">Edit</a>
                  <a href="delete_food.php?id=<?php echo $id;?>&image_name=<?php echo $imgname;?>">Delete</a>

                </td>
              </tr>
              </tr>
              <?php

            }
          }else{
            
            ?>
            <tr>
              <td><p class="h4"> No Data Available :( </p></td>
            </tr>
            <?php
          }

          ?>
        </table>
      </div>
    </div>
    </div>
    </div>

    <?php else:?>
        <h1>Why Are You Here?</h1>
        <?php endif;?>
    <?php else:?>
        <h1>Why Are You Here?</h1>
    <?php endif;?>
</body>