<?php
//this will only upload files in designated folder 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowed_types = ["image/png", "image/jpeg", "image/gif"];
        $file_type = $_FILES["file"]["type"];
        $file_size = $_FILES["file"]["size"];
        
        if (!in_array($file_type, $allowed_types) || $file_size > 2 * 1024 * 1024) {
            echo "Only PNG, JPEG, or GIF files under 2 MB are allowed.";
        } else {
            $upload_dir = "uploads/";
            $file_name = uniqid() . "_" . $_FILES["file"]["name"];
            
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $file_name)) {
                echo "File uploaded successfully!";
            } else {
                echo "Error while uploading the file.";
            }
        }
    } else {
        echo "No file uploaded or an upload error occurred.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>
    <h2>Upload an Image</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept="image/png, image/jpeg, image/gif">
        <input type="submit" value="Upload">
    </form>
</body>
</html>
