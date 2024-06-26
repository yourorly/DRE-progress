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
        <title>DRE | Gallery</title>
        <link rel="stylesheet" href="../Res/CSS/main.css">
        <link rel="stylesheet" href="../Res/preperals/ActivatedNavGallery.css">
        <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
        <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="gallery-style.css">
    </head>
    <body>

  <?php include('../Res/preperals/nav_bar.php')?>
  <br>
        <div class="title-container">
            <h1 class="title">
                Collection
            </h1>
        </div>

        <?php if (isset($user)): ?>
        <?php if ($user["access_level"] == "admin"): ?>
            <a href="../Dash/manage_picture.php"><button><i class="fa-solid fa-pen-to-square fa-xl"></i></button></a>
        <?php endif?>
        <?php endif?>

        <div class="container-fluid main">
          <div class="image-grid">
            <?php
                $sqlc = "SELECT * FROM dregallerydb WHERE active='Yes'";
                $resultc = mysqli_query($mysqli, $sqlc);
                $count = mysqli_num_rows($resultc);
                
                if($count>0){
                    while($row=mysqli_fetch_assoc($resultc)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $imgname = $row['image_name'];
                    $active = $row['active'];
                ?>
              <a href="../Res/uploads/gallery/<?php echo $imgname; ?>" target="_blank">
              <?php
                if($imgname==""){
                    echo "<div> Image not Added.</div>";
                }else{
                    ?>
                  <img class="gallery-image" src="../Res/uploads/gallery/<?php echo $imgname; ?>" alt="error">
                  <?php
                }
            }
        }
                  ?>
              </a>
    </div>
  </div>
  <?php include('../Res/preperals/footer_bar.php')?>
    </body>
</html>