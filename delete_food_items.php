<?php
include('session_m.php');

if (!isset($login_session)) {
  header('Location: managerlogin.php');
}

?>
<!DOCTYPE html>
<html>

<head>
  <title> Delete Food Items | FlavorWave </title>
</head>

<link rel="stylesheet" type="text/css" href="css/delete_food_items.css">
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
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
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

        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
          <li class="active"> <a href="managerlogin.php">MANAGER CONTROL PANEL</a></li>
          <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
        </ul>
      </div>

    </div>
  </nav>




  <div class="container">
    <div class="jumbotron">
      <div class="row content-fade">
        <div class="col-xs-8">
          <h2><span class="glyphicon glyphicon-user"></span> Hello Manager <?php echo $login_session; ?>!</h2>
          <p>Manage all your restaurant from here</p>
        </div>
        <div class="col-xs-4 text-right">
          <img src="images/LogoImage.png" alt="Flavor Wave Logo" style="max-width: 150px; max-height: 150px">
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="container">
      <div class="col">

      </div>
    </div>


    <div class="col-xs-3 content-fade" style="text-align: center;">

      <div class="list-group">
        <a href="myrestaurant.php" class="list-group-item ">My Restaurant</a>
        <a href="view_food_items.php" class="list-group-item ">View Food Items</a>
        <a href="add_food_items.php" class="list-group-item ">Add Food Items</a>
        <a href="edit_food_items.php" class="list-group-item ">Edit Food Items</a>
        <a href="delete_food_items.php" class="list-group-item active">Delete Food Items</a>
        <a href="view_order_details.php" class="list-group-item ">View Order Details</a>
      </div>
    </div>




    <div class="col-xs-9 content-fade">
      <div class="form-area content-fade2" style="padding: 0px 100px 100px 100px;">
        <form action="delete_food_items1.php" method="POST">
          <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> DELETE YOUR FOOD ITEMS FROM HERE </h3>


          <?php



          // Storing Session
          $user_check = $_SESSION['login_user1'];
          $sql = "SELECT * FROM food f WHERE f.options = 'ENABLE' AND f.R_ID IN (SELECT r.R_ID FROM RESTAURANTS r WHERE r.M_ID='$user_check') ORDER BY F_ID";
          $result = mysqli_query($conn, $sql);


          if (mysqli_num_rows($result) > 0) {

          ?>

            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th> # </th>
                  <th> Food ID </th>
                  <th> Food Name </th>
                  <th> Price </th>
                  <th> Description </th>
                  <th> Restaurant ID </th>
                </tr>
              </thead>

              <?PHP
              //OUTPUT DATA OF EACH ROW
              while ($row = mysqli_fetch_assoc($result)) {
              ?>

                <tbody>
                  <tr>
                    <td> <input name="checkbox[]" type="checkbox" value="<?php echo $row['F_ID']; ?>" /> </td>
                    <td><?php echo $row["F_ID"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><?php echo $row["R_ID"]; ?></td>
                  </tr>
                </tbody>

              <?php } ?>
            </table>
            <br>
            <div class="form-group content-fade3">
              <button type="submit" id="submit" name="delete" value="Delete" class="btn btn-danger pull-right"> DELETE</button>
            </div>

          <?php } else { ?>

            <h4>
              <center>0 RESULTS</center>
            </h4>

          <?php } ?>

        </form>


      </div>

    </div>
  </div>

</body>
<footer class="footer navbar-inverse navbar-fixed-bottom">
  <div class="container text-center">
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
    animation: fadeIn3 3s ease-in-out forwards;
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

  #myBtn span {
    color: white;
  }

  #myBtn:hover {
    background-color: blue;
  }

  #myBtn {
    background-color: gray;
    z-index: 9999 !important;
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