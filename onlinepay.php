<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_user2']) || !isset($_SESSION['cart'])) {
  header("location: customerlogin.php");
}

?>

<html>

<head>
  <title> Online Payment | FlavorWave </title>
</head>

<link rel="stylesheet" type="text/css" href="css/COD.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<body>
  <button onclick="topFunction()" id="myBtn" title="Go to top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </button>

  <script type="text/javascript">
    window.onscroll = function() {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
      } else {
        document.getElementById("myBtn").style.display = "none";
      }
    }

    function topFunction() {
      // Smooth scrolling to the top
      $('html, body').animate({
        scrollTop: 0
      }, 'slow');
    }
  </script>

  <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">FlavorWave</a>
      </div>

      <div class="collapse navbar-collapse " id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="aboutus.php">About</a></li>
          <li><a href="contactus.php">Contact Us</a></li>

        </ul>

        <?php
        if (isset($_SESSION['login_user1'])) {

        ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="myrestaurant.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
        <?php
        } else if (isset($_SESSION['login_user2'])) {
        ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Food Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
                (<?php
                  if (isset($_SESSION["cart"])) {
                    $count = count($_SESSION["cart"]);
                    echo "$count";
                  } else
                    echo "0";
                  ?>)
              </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
        <?php
        } else {

        ?>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
              <ul class="dropdown-menu">
                <li> <a href="customersignup.php"> User Sign-up</a></li>
                <li> <a href="managersignup.php"> Manager Sign-up</a></li>
                <li> <a href="#"> Admin Sign-up</a></li>
              </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li> <a href="customerlogin.php"> User Login</a></li>
                <li> <a href="managerlogin.php"> Manager Login</a></li>
                <li> <a href="#"> Admin Login</a></li>
              </ul>
            </li>
          </ul>

        <?php
        }
        ?>
      </div>

    </div>
  </nav>

  <div class="logo-container text-center">
    <img class="content-fade" src="images/LogoImage.png" alt="Flavor Wave Logo" style="max-width: 400px; max-height: 400px">
    <h2 class="text-center">Online Payment</h2>
    <h3 class="text-center content-fade2">Enter your payment details below.</h3>
  </div>

  <div class="row" style="margin-top: 20px;">
    <div class="col-md-6 col-md-offset-3">
      <div class="credit-card-div">
        <div class="panel panel-default">
          <div class="panel-heading">

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h5 class="text-muted"> Credit Card Number</h5>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="text" class="form-control" placeholder="0000" required="" />
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="text" class="form-control" placeholder="0000" required="" />
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="text" class="form-control" placeholder="0000" required="" />
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="text" class="form-control" placeholder="0000" required="" />
              </div>
            </div>
            <br>
            <div class="row ">
              <div class="col-md-3 col-sm-3 col-xs-3">
                <span class="help-block text-muted small-font"> Expiry Month</span>
                <input type="text" class="form-control" placeholder="MM" required="" />
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <span class="help-block text-muted small-font"> Expiry Year</span>
                <input type="text" class="form-control" placeholder="YY" required="" />
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <span class="help-block text-muted small-font"> CCV</span>
                <input type="text" class="form-control" placeholder="CCV" required="" />
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3"><br>
                <img src="images/creditcard.png" class="img-rounded" required="" />
              </div>
            </div>
            <br>
            <div class="row ">
              <div class="col-md-12 pad-adjust">
                <input type="text" class="form-control" placeholder="Name On The Card" required="" />
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12 pad-adjust">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" checked class="text-muted" required=""> Save details for fast payments. <a href="#">Learn More</a>
                  </label>
                </div>
              </div>
            </div>
            <div class="row ">
              <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                <a href="payment.php"><input type="submit" class="btn btn-danger btn-block" value="CANCEL" required="" /></a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                <a href="COD.php"><input type="submit" class="btn btn-success btn-block" value="PAY NOW" required="" /></a>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
  </div>


</body>
<footer class="footer navbar-inverse navbar-fixed-bottom" style="margin-top: 20px;">
  <div class="container text-center">
    <p style="color:white;"></p>
    <p style="color: white;">&copy; 2023 FlavorWave. All rights reserved.</p>
  </div>
</footer>
<style>
  .content-fade {
    opacity: 0;
    /* Start with 0 opacity */
    animation: fadeIn 1s ease-in-out forwards;
    /* Apply fade-in animation */
  }

  /* Keyframes for the fade-in animation */
  @keyframes fadeIn {
    0% {
      opacity: 0;
      transform: translateY(20px);
      /* Optional: Add a slight vertical shift */
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .content-fade2 {
    opacity: 0;
    /* Start with 0 opacity */
    animation: fadeIn2 2s ease-in-out forwards;
    /* Apply slower fade-in animation */
  }

  /* Keyframes for the slower fade-in animation */
  @keyframes fadeIn2 {
    0% {
      opacity: 0;
      transform: translateY(20px);
      /* Optional: Add a slight vertical shift */
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .content-fade3 {
    opacity: 0;
    /* Start with 0 opacity */
    animation: fadeIn3 2.5s ease-in-out forwards;
    /* Apply slower fade-in animation */
  }

  /* Keyframes for the slower fade-in animation */
  @keyframes fadeIn3 {
    0% {
      opacity: 0;
      transform: translateY(20px);
      /* Optional: Add a slight vertical shift */
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .content-fade4 {
    opacity: 0;
    /* Start with 0 opacity */
    animation: fadeIn4 3s ease-in-out forwards;
    /* Apply slower fade-in animation */
  }

  /* Keyframes for the slower fade-in animation */
  @keyframes fadeIn4 {
    0% {
      opacity: 0;
      transform: translateY(20px);
      /* Optional: Add a slight vertical shift */
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  #myBtn {
    background-color: gray;
    /* z-index: 9999 !important; */
    /* Adjust this value as needed */
  }

  #myBtn span {
    color: white;
  }

  #myBtn:hover {
    background-color: blue;
  }


  .footer {
    padding: 20px 0;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>