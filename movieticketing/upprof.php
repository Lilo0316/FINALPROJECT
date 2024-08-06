<?php

include('connection.php');

// Check if user is logged in
if(isset($_SESSION['uemail'])) {
    $email = $_SESSION['uemail'];

    // Fetch current user details
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Initialize variables
        $name = $row['name'];
        $address = $row['address'];
        $contact = $row['contact'];

        // Handle form submission
        if(isset($_POST['submit'])) {
            // Retrieve form data
            $new_name = $_POST['name'];
            $new_address = $_POST['address'];
            $new_email = $_POST['email']; // New email address
            $new_contact = $_POST['contact'];

            // Check if email needs to be updated and ensure it's unique
            if ($new_email != $email) {
                $check_email_query = "SELECT * FROM user WHERE email='$new_email'";
                $check_email_result = mysqli_query($conn, $check_email_query);
                if (mysqli_num_rows($check_email_result) > 0) {
                    echo '<script>alert("Email address already exists. Please choose a different one.")</script>';
                } else {
                    $update_email_query = "UPDATE user SET email='$new_email' WHERE email='$email'";
                    mysqli_query($conn, $update_email_query);
                    $_SESSION['uemail'] = $new_email; // Update session email if changed
                }
            }

            // Update profile information except email and password
            $update_profile_query = "UPDATE user SET name='$new_name', address='$new_address', contact='$new_contact' WHERE email='$email'";
            mysqli_query($conn, $update_profile_query);
            echo '<script>alert("Profile updated successfully");</script>';

            // Update the current form values after submission
            $name = $new_name;
            $address = $new_address;
            $contact = $new_contact;
            // You can also update $email if it changes, but typically it's best to handle email updates separately due to validation concerns.
        }
    } else {
        echo "User not found.";
    }
} else {
    header("Location: nlogin.php"); // Redirect if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Profile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #0D0E30;
        margin: 0;
        padding: 20px;
        color: white;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    form {
        background-color: rgba(255, 255, 255, 0.2);
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }
    input[type="text"], input[type="password"], input[type="email"] {
        width: calc(100% - 22px); /* Adjust the width */
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    input[type="submit"] {
        width: 100%;
        padding: 10px 0;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    .sub-text {
        color: #ccc;
        text-align: center;
        margin-top: 10px;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Update Profile</h2>
    <form action="" method="post">
        <p>Name<br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </p>
        <p>Address<br>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
        </p>
        <p>Email<br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </p>
        <p>Contact<br>
            <input type="text" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required>
        </p>
        <input type="submit" name="submit" value="Save Changes">
    </form>
</div>
</body>
</html>
