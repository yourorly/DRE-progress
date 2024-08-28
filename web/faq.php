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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRE | FAQ</title>
    <link rel="stylesheet" href="faqcss.css">
    <link rel="stylesheet" href="../Res/CSS/main.css">
    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Res/preperals/ActivatedNavFAQ.css">
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php include('../Res/preperals/nav_bar.php')?>
<br>
<br><br><br><br><br>
 <section class="faq-section">
  <h1>Frequently Asked Questions</h1>
  <?php if (isset($user)): ?>
    <?php if ($user["access_level"] == "admin"): ?>
        <a href="../Dash/manage_faq.php"><button><i class="fa-solid fa-pen-to-square fa-xl"></i></button></a>
    <?php endif?>
    <?php endif?>
   <ul class="faq-list">
   <?php 
            $sql1 = "SELECT * FROM drefaqdb WHERE active='Yes' AND featured='Yes'";
            $result1 = mysqli_query($mysqli, $sql1);  
            $count1 = mysqli_num_rows($result1);
            while($row1=mysqli_fetch_assoc($result1)){
            $id = $row1['id'];
            $title = $row1['title'];
            $answer = $row1['answer'];
        ?>
     <li>
    <button class="faq-question"><?php echo $title ?></button>
       <div class="faq-answer">
         <p><?php echo $answer ?></p>
       </div>
     </li>
     <?php } ?>
   </ul>
 
  <h2>Didn't find your answer?</h2>
  <a href="../contact/contact.php"><button class="contact-us">Contact Us</button></a>
  
  <div class="faq-answer">
    <p>PLACEHOLDER PLACEHOLDER PLACEHOLDER  </p>
  </div>
  </section>
 <script>
  const faqQuestions = document.querySelectorAll('.faq-question');

  faqQuestions.forEach((question) => {
    question.addEventListener('click', () => {
      const answer = question.nextElementSibling;
      answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
    });
  });
 </script>
 <?php include('../Res/preperals/footer_bar.php')?>
</body>