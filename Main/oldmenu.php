<?php

session_start();
$mysqli = require __DIR__ . "/database.php";
if (isset($_SESSION["user_id"])) {
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=l.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Res/preperals/ActivatedNavMenu.css">
    <link rel="stylesheet" href="../Res/CSS/main.css">
    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
    <script src="Filter.js"></script>
</head>
<body>
<body>
<?php include('../Res/preperals/nav_bar.php')?>

    <div class="container-fluid main">
<div class="glass-filter">
<?php if (isset($user)): ?>
<?php if ($user["access_level"] == "admin"): ?>
    <button class="btn btn-light btn-sm" style="padding: 15px;"><a href="../Dash/manage_category.php" style="text-decoration: none; color: black; font-weight: bold;">Manage Category</a></button>
    <button class="btn btn-light btn-sm" style="padding: 15px;"><a href="../Dash/manage_food.php" style="text-decoration: none; color: black; font-weight: bold;">Manage Food</a></button>
<?php endif; ?>
<?php endif; ?>
        <section class="filters">
              <div class="row" style="margin-bottom: 20px;">
                <div class="col"><button class="filter-btn" data-filter="all">All</button></div>
                <div class="col"><button class="filter-btn" data-filter="burger">Burger</button></div>
                <div class="col"><button class="filter-btn" data-filter="fries">Fries</button></div>
                <div class="col"><button class="filter-btn" data-filter="wings">Wings</button></div>
                <div class="col"><button class="filter-btn" data-filter="drinks">Drinks</button></div>
              </div>
          </section>
    
    <div class="menu">

    <table>
    <?php
          $sqlc = "SELECT * FROM drefooddb";
          $resultc = mysqli_query($mysqli, $sqlc);
          $count = mysqli_num_rows($resultc);
          
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
              ?>
        <tr>
            <td>
            <div class="items" data-category="<?php echo $category_title; ?>">
            <?php
                if($imgname==""){
                      echo "<div> Image not Added.</div>";
                    }else{
                      ?>
                      <img src="../Res/uploads/menu/<?php echo $imgname; ?>" width="100" height="100">
                      <?php
                    }
                    ?>
                    <div class="details">
                        <div class="details-sub">
                            <h5><?php echo $title; ?></h5>
                            <h5 class="price"><?php echo $price;?> ₱</h5>
                        </div>
                        <p><?php  echo $description; ?></p>
                        <?php 
                        $sql1 = "SELECT * FROM drecategorydb WHERE id='$category'";
                        $result1 = mysqli_query($mysqli, $sql1);  
                        $count1 = mysqli_num_rows($result1);
                        while($row1=mysqli_fetch_assoc($result1)){
                          $category_title = $row1['title'];
                          ?>
                        <p><?php echo  $category_title;?></p>
                        <?php } ?>

                            </div>
                        </div>
                    </td>
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
</body>
</html>