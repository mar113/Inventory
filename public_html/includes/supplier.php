<?php
// Include the database configuration file
include_once("../database/constants.php");
include_once("../database/db.php");
$db = new Database();
$statusMsg = '';
// File upload path
$targetDir = "../uploads/";
$file = $_FILES['fichier']['name'];
$fileName = basename($file);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(!empty($_FILES["fichier"]["name"])){
    $name = $_POST["sup_name"];
    $mail = $_POST["sup_mail"];
    $phone = $_POST["sup_phone"];
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["fichier"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $pre_stmt = $db->connect()->prepare("INSERT INTO `fournisseur`(`nom`, `email`, `tel`, `filename`, `uploaded_on`) VALUES (?,?,?,?,?)");
            $time= new DateTime();
            $date = $time->format('Y-m-d H:i:s');
            $pre_stmt->bind_param("ssiss",$name,$mail,$phone,$fileName,$date);
            $result = $pre_stmt->execute() or die($this->cnx->error);
            if($result){
                $statusMsg = "All the data has been uploaded.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>