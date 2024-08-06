<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="css/signup.css" rel="stylesheet">
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form name="signupForm" method="post" action="signupdata.php" onsubmit="validateForm(event)">
            <div class="form-group">
                <input type="text" name="name" placeholder="Name" required>
                <div id="nameError" class="error-message">Name can only contain alphabetic characters and spaces.</div>
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="Address" required>
                <div id="addressError" class="error-message">Address is required.</div>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
                <div id="emailError" class="error-message">Invalid email format.</div>
            </div>
            <div class="form-group">
                <input type="text" name="contact" placeholder="Contact" required>
                <div id="contactError" class="error-message">Contact must be 10 digits.</div>
            </div>
            <div class="form-group">
                <input type="password" name="Password" placeholder="Password" required>
                <div id="passwordError" class="error-message">Password must be 8-15 characters long, and include at least one letter, one number, and one special character.</div>
            </div>
            <button type="submit">Sign Up</button>
            <p class="sub-text">Already have an account? <a href="nlogin.php">Log In</a></p>
        </form>
    </div>
    <script>
        function validateForm(event) {
            let isValid = true;
            document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
            const form = document.forms['signupForm'];
            const name = form['name'];
            const address = form['address'];
            const email = form['email'];
            const contact = form['contact'];
            const password = form['Password'];
            const nameRegex = /^[A-Za-z\s]+$/;
            if (name.value.trim() === '') {
                isValid = false;
                document.getElementById('nameError').innerText = 'Name is required.';
                document.getElementById('nameError').style.display = 'block';
            } else if (!nameRegex.test(name.value.trim())) {
                isValid = false;
                document.getElementById('nameError').innerText = 'Name can only contain alphabetic characters and spaces.';
                document.getElementById('nameError').style.display = 'block';
            }
            if (address.value.trim() === '') {
                isValid = false;
                document.getElementById('addressError').innerText = 'Address is required.';
                document.getElementById('addressError').style.display = 'block';
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() === '') {
                isValid = false;
                document.getElementById('emailError').innerText = 'Email is required.';
                document.getElementById('emailError').style.display = 'block';
            } else if (!emailRegex.test(email.value.trim())) {
                isValid = false;
                document.getElementById('emailError').innerText = 'Invalid email format.';
                document.getElementById('emailError').style.display = 'block';
            }
            const contactPattern = /^\d{10}$/;
            if (!contactPattern.test(contact.value.trim())) {
                isValid = false;
                document.getElementById('contactError').innerText = 'Contact must be 10 digits.';
                document.getElementById('contactError').style.display = 'block';
            }
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/;
            if (password.value.trim() === '') {
                isValid = false;
                document.getElementById('passwordError').innerText = 'Password is required.';
                document.getElementById('passwordError').style.display = 'block';
            } else if (!passwordPattern.test(password.value.trim())) {
                isValid = false;
                document.getElementById('passwordError').innerText = 'Password must be 8-15 characters long, and include at least one letter, one number, and one special character.';
                document.getElementById('passwordError').style.display = 'block';
            }

            if (!isValid) {
                event.preventDefault(); 
            }
        }
    </script>
</body>
</html>
