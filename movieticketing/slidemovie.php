<?php
include('connection.php');
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $synopsis = $_POST['synopsis'];
    if (isset($_FILES['image_url'])) {
        $file = $_FILES['image_url'];
        $file_name = basename($file['name']);
        $file_tmp = $file['tmp_name'];
        $upload_directory = "image/";
        $upload_path = $upload_directory . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $query = "INSERT INTO slideshow (title, image_url, synopsis) VALUES ('$title', '$upload_path', '$synopsis')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header('Location: admin.php');
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script> alert('File upload failed.') </script>";
        }
    } else {
        echo "<script> alert('Image file not found.') </script>";
    }
} else {
    echo "<script> alert('Form not submitted.') </script>";
}
?>
