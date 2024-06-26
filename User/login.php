<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: ../web/home.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>DRE | LOGIN</title>
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid" id="back">
    <div class="container">
      <div class="center">
      <a href="../web/home.php">< Back</a>
          <h1>Login</h1>
          <?php if ($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>
          <form method="POST">
              <div class="txt_field">
                  <input type="text" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"required>
                  <span></span>
                  <label>Email</label>
              </div>
              <div class="txt_field">
                  <input type="password" id="password" name="password" required>
                  <span></span>
                  <label>Password</label>
              </div>
              <input name="submit" type="Submit" value="Login">
          </form>
      </div>
    </div>
</div>
</body>
</html>