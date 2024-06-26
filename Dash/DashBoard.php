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
</head>
<body>
<?php if (isset($user)): ?>
    <?php if ($user["access_level"] == "admin"): ?>
      <?php include('../Res/preperals/nav_bar.php')?>
    <br>
    <div class="container main">
    <h1>Admin Dashboard</h1>
    <div class="h-line"></div>
    <div class="manage-admin">
      <p class="h2 title">
        Manage <span>Clients</span>
      </p>
    <div class="container">
      <form method="post">
        <input type="text" placeholder="Name" name="search">
        <button class="btn btn-dark btn-sm" name=submit>Search</button>
      </form>
      <div class="container">
        <table class="member-table">
          <?php 
          if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $sqlsearch = "SELECT * FROM `user` WHERE id='$search' or name='$search' or email='$search'";
            $result =mysqli_query($mysqli, $sqlsearch);
            if($result){
              if(mysqli_num_rows($result)>0){
                echo '<tread>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Access Level</th>
                </tr>
                </tread>
                ';
              }
              while($row=mysqli_fetch_assoc($result)){
                echo '<tbody>
                <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['access_level'].'</td>
                </tr>
                </tbody>
                ';
              }
            } else {
              echo '<p class="h4"> No Data Available :( </p>';
            }
          } else {
            echo '<p class="h4"> No Data Available :( </p>';
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