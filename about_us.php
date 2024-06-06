<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us</title>

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
    }

    html {
      box-sizing: border-box;
    }

    *, *:before, *:after {
      box-sizing: inherit;
    }

    .column {
      float: left;
      width: 33.3%;
      margin-bottom: 16px;
      padding: 0 8px;
    }

    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      margin: 8px;
    }

    .about-section {
      padding: 50px;
      text-align: center;
      background-color: #ca1a5e;
      color: white;
    }

    .container {
      padding: 0 16px;
    }

    .container::after, .row::after {
      content: "";
      clear: both;
      display: table;
    }

    .title {
      color: grey;
    }

    .button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: #ca1a5e;
      text-align: center;
      cursor: pointer;
      width: 100%;
    }

    .button:hover {
      background-color: #555;
    }
    
    .navbar {
            background-color: #ca1a5e;
            display: flex;
            justify-content: center;
            padding: 10px;
            width: 100%;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin 20px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #555;
        }


    /* Footer styling */
    footer {
      background-color: #ca1a5e;
      color: white;
      text-align: center;
      padding: 10px 0;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
    </div>


<div class="about-section">
  <h1>About Us Page</h1>
  <p>Kindly Reach us if you have any enquiry.</p>
</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="include/team3.jpg" alt="Puan Mira " style="width:100%">
      <div class="container">
        <h2>Puan Mira </h2>
        <p class="title">HUMAN RESOURCE</p>
        <p>mira.resource@yahoo.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column"> 
    <div class="card">
      <img src="include/main.jpg" alt="Miss Aina" style="width:100%">
        <div class="container">
        <h2>Puan Azfan</h2>
        <p class="title">CEO & Founder</p>
        <p>taska2023@yahoo.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="include/team2.jpg" alt="John" style="width:100%">
      <div class="container">
        <h2>Puan Elle</h2>
        <p class="title">FINANCE</p>
        <p>elle.finance@yahoo.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
&copy; 2023 Taska Sinar Mesra.
</footer>

</body>
</html>
