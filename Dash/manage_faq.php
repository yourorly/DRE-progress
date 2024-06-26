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
    <br>
    <div class="container main">
    <h1>Admin Dashboard</h1>
    <div class="h-line"></div>
    <button class="btn btn-light btn-sm" style="padding: 15px;"><a href="../Dash/add_faq.php" style="text-decoration: none; color: black; font-weight: bold;">Add FAQ</a></button>
    <div class="h-line"></div>
    <div class="manage-category">

    <?php 
      if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }
      if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
      }
      if(isset($_SESSION['edit'])){
        echo $_SESSION['edit'];
        unset($_SESSION['edit']);
      }
      ?>

      <br><br>
      <p class="h2 title">
        Manage <span>FAQ</span>
      </p>
    <div class="container">
      <table>
        <tr>
          <th>S.N</th>
          <th>Category</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Action</th>
        </tr>
      
          <?php
          $sqlc = "SELECT * FROM drefaqdb";
          $resultc = mysqli_query($mysqli, $sqlc);
          $count = mysqli_num_rows($resultc);

          $sn = 1;
          if($count>0){
            while($row=mysqli_fetch_assoc($resultc)){
              $id = $row['id'];
              $category = $row['title'];
              $featured = $row['featured'];
              $active = $row['active'];
              ?>
              <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $category;?></td>
                <td><?php echo $featured;?></td>
                <td><?php echo $active;?></td>
                <td>
                  <a href="edit_faq.php?id=<?php echo $id;?>">Edit</a>
                  <a href="delete_faq.php?id=<?php echo $id;?>">Delete</a>
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