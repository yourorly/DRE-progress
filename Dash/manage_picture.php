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
    <button class="btn btn-light btn-sm" style="padding: 15px;"><a href="../Dash/add_picture.php" style="text-decoration: none; color: black; font-weight: bold;">Add Picture</button>
    <div class="h-line"></div>
    <div class="manage-admin">
    <?php 
      if(isset($_SESSION['add-picture'])){
        echo $_SESSION['add-picture'];
        unset($_SESSION['add-picture']);
      }
      if(isset($_SESSION['delete-picture'])){
        echo $_SESSION['delete-picture'];
        unset($_SESSION['delete-picture']);
      }
      
      if(isset($_SESSION['edit-picture'])){
        echo $_SESSION['edit-picture'];
        unset($_SESSION['edit-picture']);
      }
      if(isset($_SESSION['remove-file'])){
        echo $_SESSION['remove-file'];
        unset($_SESSION['remove-file']);
      }
      ?>
      <p class="h2 title">
        Manage <span>Gallery</span>
      </p>
      <div class="container">
      <table>
        <tr>
          <th>S.N</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th>Active</th>
          <th>Action</th>
        </tr>
      
          <?php
          $sqlc = "SELECT * FROM dregallerydb";
          $resultc = mysqli_query($mysqli, $sqlc);
          $count = mysqli_num_rows($resultc);

          $sn = 1;
          if($count>0){
            while($row=mysqli_fetch_assoc($resultc)){
              $id = $row['id'];
              $title = $row['title'];
              $description = $row['description'];
              $imgname = $row['image_name'];
              $active = $row['active'];
              ?>
              <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $title;?></td>
                <td><?php echo $description;?></td>
                <td>
                  <?php 
                    if($imgname==""){
                      echo "<div> Image not Added.</div>";
                    }else{
                      ?>
                      <img src="../Res/uploads/gallery/<?php echo $imgname; ?>" width="100" height="100">
                      <?php
                    }
                  ?>
                <td><?php echo $active;?></td>
                <td>
                  <a href="edit_picture.php?id=<?php echo $id;?>">Edit</a>
                  <a href="delete_picture.php?id=<?php echo $id;?>&image_name=<?php echo $imgname;?>">Delete</a>

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