<html>
    <head>
<style>
       body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

      header {
    font-family: Arial, sans-serif;
    background-color: #0b0b3e;
    backdrop-filter: blur(4px);
    margin: 0px;
    top: 1px;
    border: 2px solid white;
    left: 0px;
    height: 60px;
    width: 100%;
}

header ul {
    list-style-type: none;
    padding: 0 20px; /* Adjust the padding to make the navigation links closer */
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header ul li {
    margin-left: 20px;
}

header ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px; /* Reduce the font size if necessary */
}

header ul li a:hover {
    text-decoration: underline;
}

header ul li#logout {
    position: relative;
}

header ul li#logout b {
    color: white;
    font-weight: bold;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 5px;
    background-color: #717882;
}

header ul li#logout b:hover {
    color: black;
}

.logo img {
    width: 80px; /* Adjust the logo size as needed */
    height: auto;
}
        </style>
        </head>
        <body>
        <header>
    <ul>
      <li class="logo"><img src="LOGOO.png"  alt="Logo">   
    

    </li>
        <li><a href="admin.php">Home</a></li>
        <li><a href="nowshowingform.php">Movies</a></li>
        <li><a href="show.php">Bookings</a></li>
        <li><a href="shu.php">Manage User</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    </header>

    </body>
    </html>