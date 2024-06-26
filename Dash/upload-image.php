<?php
include_once 'database.php';
    
$statusMsg = '';
$status = 'danger';

$targetDir = 'uploads/'

if (isset($_POST['submit'])) {
    if (isset($_FILES["file"]["name"])){
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'gif', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $insert = $db->query("INSERT INTO dremenuimgs (file_name,uploaded_on) VALUES ('".$fileName.", NOW()')");
            if($insert){
                $statusMsg = .$fileName." Uploaded Successfully";
                $status ='success';
            }
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }else{
        $statusMsg = "Please select a file to upload.";
    }
}
?>