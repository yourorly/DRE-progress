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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRE | Home</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="homestyle.css">
    <link rel="stylesheet" href="../Res/CSS/main.css">
    <link rel="stylesheet" href="../Res/preperals/ActivatedNavHome.css">
    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- this calls the preferals or resorces for navbar to save space and to edit it easily -->
<?php include('../Res/preperals/nav_bar.php')?>
    <div class="addmenu">
    <body> 
        <div class="menu_header">
          <h1>Serving you comfort food that warms your soul</h1>
          <p class="h1">Savor every bite and leave your taste buds craving for more!</p>
        </div>
          <div class="imageburgercontainer">
            <div class="imageburger"></div>
          </div>
        <a href="../Main/menu.php"><button class="go-menu">Go to Menu</button></a>
    
    </body>
    </div>
    <div class="main container-fluid" style="margin: 0%; padding: 0%;">
    <div class="intro-img" style="margin: 0%; padding: 0%;"><div class="container-fluid" style="margin: 0%; padding: 0%;">
    <div id="pictures" class="carousel slide" data-bs-ride="carousel" style="margin: 0%; padding: 0%;">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#pictures" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#pictures" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#pictures" data-bs-slide-to="2"></button>
      <button type="button" data-bs-target="#pictures" data-bs-slide-to="3"></button>
      <button type="button" data-bs-target="#pictures" data-bs-slide-to="4"></button>
      <button type="button" data-bs-target="#pictures" data-bs-slide-to="5"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../Res/img/Background.png" alt="" class="d-block w-100" >
      </div>
      <div class="carousel-item">
        <img src="../Res/img/Pics/eat.gif" alt="" class="d-block w-100" >
      </div>
      <div class="carousel-item">
        <img src="../Res/img/Pics/Berber.png" alt="" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="../Res/img/Pics/Juicy.png" alt="" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="../Res/img/Pics/Yum.png" alt="" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="../Res/img/Pics/YumBurger.png" alt="" class="d-block w-100">
      </div>
      
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#pictures" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#pictures" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
    </div>
    </div></div>
    </div>

    <div class="popular_picks">
              <h1 class="popular_header_title">Best Sellers</h1>
              <!-- this filter the allowed elements to display to front end -->
              <?php 
                $sqlc = "SELECT * FROM drefooddb WHERE active='Yes' AND featured='Yes' AND bestseller='Yes' LIMIT 3";
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
                    <!-- this makes the preset for the popular menu -->
              <div class="popular_menu_item">
                  <div class="popular_img">
                    <?php
                    if($imgname==""){
                      echo "<div> Image not Added.</div>";
                    }else{
                      ?>
                      <img src="../Res/uploads/menu/<?php echo $imgname; ?>" alt="" >
                      <?php
                        }
                    ?>
                    </div>
                  <div class="popular_text_description">
                      <h2>
                      <?php echo $title; ?>
                      </h2>
                      <p>
                      <?php  echo $description; ?>
                      </p>
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
          </div>
    <br>
    <div class="PromotionBK container-fluid">
    <p class="h1">Flavor Unleashed: Where Every Bite Tells A Delicious Story</p>
    
      <div class="image-container">
          <img src="1.jpg" alt="Image 1">
          <img src="2.jpg" alt="Image 2">
        </div>
        <a href="../Main/menu.php"><button class="go-menu">Go to Menu</button></a>
      
    </div>
    

<?php include('../Res/preperals/footer_bar.php')?>
</body>
</html>