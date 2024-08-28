<!-- This is for checking connection and connecting on database -->
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
<html lang="en">
<head>
    <title>DRE | Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=l.0">
    <link rel="stylesheet" href="menu_style.css">
    <link rel="stylesheet" href="../Res/preperals/ActivatedNavMenu.css">
    <link rel="stylesheet" href="../Res/CSS/main.css">
    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include('../Res/preperals/nav_bar.php')?>
    <div class="menu_header">
        <div class="menu_header_title">
            <h1>
                "Once you try it, you will love it"        
            </h1>
            <p>
                "A Burger and Chicken Wings Fixes Everything"
            </p>
        </div>    
    </div>

    <div class="tag_displays">
    <?php if (isset($user)): ?>
    <?php if ($user["access_level"] == "admin"): ?>
        <a href="../Dash/manage_category.php"><button><i class="fa-solid fa-pen-to-square fa-xl"></i></button></a>
    <?php endif?>
    <?php endif?>
        <button>
        <a href="menu.php">
        All
        </a>
        <!-- this filter cathegory by cathegory -->
        </button>
    <?php 
            $sql1 = "SELECT * FROM drecategorydb WHERE active='Yes' AND featured='Yes'";
            $result1 = mysqli_query($mysqli, $sql1);  
            $count1 = mysqli_num_rows($result1);
            while($row1=mysqli_fetch_assoc($result1)){
            $categoryid = $row1['id'];
            $category_title = $row1['title'];
        ?>
        <button>
        <a href="menu.php?filter=<?php echo $categoryid;?>">
        <?php echo  $category_title;?>
        </a>
        </button>
        <?php } ?>
    </div>


            
    <div class="menu_contents container-fluid row">
        <!-- Displaying all cathegory or filtered cathegory -->
    <?php
    if(isset($_GET['filter'])){
        $filteredcategory = $_GET['filter'];
        $sqlc = "SELECT * FROM drefooddb WHERE active='Yes' AND featured='Yes' AND category_id='$filteredcategory'";
        
    }else{
        $sqlc = "SELECT * FROM drefooddb WHERE active='Yes' AND featured='Yes'";
    }
    // this display all items in selected cathegory
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
        <div class="menu_items col-sm-3">
        <?php
                if($imgname==""){
                    echo "<div> Image not Added.</div>";
                }else{
                    ?>
                    <img src="../Res/uploads/menu/<?php echo $imgname; ?>" width="300" height="280" class="img-center-crop" >
                    <?php
                }
            ?>
            <div class="additional_text">
            <h3 class="name"><?php echo $title; ?></h3>
            <p class="price">₱<?php echo $price;?></p>
            </div>
            <div class="item_description">
                <?php  echo $description; ?>
            </div>
        </div>
        <?php 
            }
                }else{
                    ?>
                    <p class="h4"> No Data Available :( </p>
                    <?php
                    }
                    ?>
    </div>
    <?php include('../Res/preperals/footer_bar.php')?>
</body>
</html>