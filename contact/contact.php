<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRE | Contact</title>
    <link rel="stylesheet" href="contacts_style.css">
    <link rel="stylesheet" href="../Res/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Res/preperals/ActivatedNavContact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../Res/Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php include('../Res/preperals/nav_bar.php')?>

    <?php
    if(isset($_SESSION['status'])){
?>
    <div class="alert alert-info">
        <strong>Info!</strong> <?php echo $_SESSION['status'];?>
    </div><?php unset($_SESSION['status']);
      }?>

    <div class="contact_header">
        <h1>Contact Us</h1>
        <div>
            
        </div>
    </div>
    <div class="contact_content">
        <div class="info_content">
            <div class="contact_info">
                <div>
                    <h1>
                        <i class="fa-solid fa-phone icon"></i>
                    </h1>
                    <h4>Phone</h4>
                    <p>(046) 501 4730</p>
                </div>
                <div>
                    <h1>
                        <i class="fa-brands fa-facebook-f icon"></i>
                    </h1>
                    <h4>Facebook</h4>
                    <a href="https://www.facebook.com/drecavite">Dre</a>
                </div>
                <div>
                    <h1>
                        <i class="fa-solid fa-envelope icon"></i>
                    </h1>
                    <h4>Gmail</h4>
                    <p>Dre@gmail.com</p>
                </div> 
                <div>
                    <h1>
                        <i class="fa-solid fa-location-dot icon"></i>
                    </h1>
                    <h4>Location</h4>
                    <a href="https://maps.app.goo.gl/1p3bJkxp8iiTNSsw6">47 Tahimik St, 4103 <br>Imus, Philippines</a>
                </div>
            </div>
            <iframe class="map_frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3863.925112721914!2d120.93177627699126!3d14.431479186035174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d343e45251bd%3A0x496f6ce5e9d79a39!2sDRE!5e0!3m2!1sen!2sph!4v1714019910851!5m2!1sen!2sph" frameborder="0">
            </iframe>
        </div>

        <form action="sendemail.php" method="POST">
            <h1>Get In Touch</h1>
            <p class="sub_title"></p>
            <label for=""></label>
            <label for="contact_name" class="contact_titles">Name:</label>
            <input type="text" class="contact_input" name="contact_name">
            <label for="contact_email" class="contact_titles">Email:</label>
            <input type="email" name="contact_email" class="contact_input" required>
            <label for="contact_subject" class="contact_titles">Subject:</label>
            <select name="contact_subject" id="contact_subject" class="contact_input">
                <option value="feedback">Feedback</option>
                <option value="inquiry">Inquiry</option>
            </select>
            <label for="contact_message" class="contact_titles">Message:</label>
            <textarea name="contact_message" id="contact_message" rows="6"></textarea>
            <input type="submit" class="submit_button" name="SendContact">
        </form>
    </div>
    <?php include('../Res/preperals/footer_bar.php')?>
</body>
</html>