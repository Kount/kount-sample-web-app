<?php

/*
    * Home Page - has login functionality
*/

$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
}

require __DIR__ . '/./vendor/autoload.php';

$ini = parse_ini_file('config.ini');

$merchantId     = $ini["MERCHANT_ID"];
$apiKey         = $ini["API_KEY"];
const version   = "0210";
const serverUrl = "api-sandbox01.kountaccess.com";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	performAccessCall($session, $merchantId, version, $apiKey, serverUrl);
  authenticateUser();
}

//TODO implement this

//if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//	if (!empty($_SESSION['password']) && !empty($_SESSION['username'])) {
//		header("Location: home.php");
//	}
//}

$userHash     = isset($_SESSION['username']) ? hash('md2', $_SESSION['username']) : '';
$passwordHash = isset($_SESSION['password']) ? hash('md2', $_SESSION['password']) : '';

$goodPasswords = array('2fa', 'kount');

function performAccessCall($session, $merchant, $version, $apiKey, $serverUrl) {
	if(!empty($_POST['password']) && !empty($_POST['username'])) {
		$username = isset($_POST['username']) ? $_POST['username'] : null;
		$password = isset($_POST['password']) ? $_POST['password'] : null;

		try {
			$kount_access = new Kount_Access_Service($merchant, $apiKey, $serverUrl, $version);
			$response = $kount_access->get_decision($session, $username, $password);
			$_SESSION['accessResponse'] = $response;

		} catch (Kount_Access_Exception $ae) {
			throw new Exception($ae->getMessage());
		}
	}
}

function authenticateUser() {
  $goodPasswords = array('2fa', 'kount');
  if(!empty($_POST['password']) && !empty($_POST['username'])) {
    if($_POST['password'] == 'kount') {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];
      header("Location: success.php");

    } else if($_POST['password'] == '2fa') {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];
      header("Location: index.php");

    } else if(!in_array($_POST['password'], $goodPasswords)) {
      $_SESSION['password'] = $_POST['password'];
      unset($_POST['username']);
    }
  }
}

include('header.php');
?>
<style>
  tr {
    line-height: 30px;
  }

  td {
    padding: 5px;
  }

</style>

<div class="row">
  <div class="col-md-12 cart">

    <div class="col-md-6 product" style="top: 45px;">
      <div class="col-xs-12" style="min-height: 462px; border-right: 1px solid #646464;">
        <?php
        if(isset($_SESSION['password'])) {
          if ($_SESSION['password'] == "2fa") {
            echo '<div class="col-md-2" ></div >';
            echo '<div class="col-md-10 login" style="min-height: 460px">';
            echo '<div style="margin-top: 100px;">';
            echo '<p><span style="font-weight: 700; padding-left:10px">' . "  For your added account protection, we have sent a verification code to" . '</span></p>';
            echo '<p><span style="font-weight: 700">' . "your registered email address.  Please enter it below to continue logging in." . '</span> </p>';
            echo '</div>';
            echo '<br/>';
            echo '<br/>';
            echo '<input class="form-control" name="verification" style="margin-bottom: 30px; width: 300px; margin-left: 70px;" placeholder="Verification code" type="text">';
            echo '<div class="submitLogin" style="margin-bottom: 30px; width: 300px; margin-left: 70px">';
            echo '<a href="success.php"><button id="submitVer" class="btn btn-primary login" role="button">Submit </button></a>';
            echo '</div>';
            echo '<a href="home.php" style="margin-left: 70px"><span class="guestSpan" style="max-width: 200px; margin-top: 20px">' . "or, Shop as a Guest" . '</span></a>';
            echo '</div>';
          } else if(!in_array($_SESSION['password'], $goodPasswords)) {
            echo '<div class="col-md-2" ></div >';
            echo '<div class="col-md-10 login" style="min-height: 460px">';
            echo '<div style="margin-top: 100px;">';
            echo '<p><span style="font-weight: 700; padding-left:10px">' . "  The login information was invalid. Please try again. If you continue" . '</span></p>';
            echo '<p><span style="font-weight: 700">' . "to have problems logging in, please contact our customer service team!" . '</span> </p>';
            echo '</div>';
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            echo '<p style="margin: 10px 0 10px 200px; font-size: 17px"><a href="logout.php"><span id="guestSpan">Go to login </span></a></p>';
            echo '<p style="margin: 50px 0 10px 60px"><a href="home.php" style="margin-left: 70px"><span class="guestSpan" style="max-width: 200px; margin-top: 20px">' . "Shop as a Guest" . '</span></a></p>';
            echo '</div>';
          }
        } else {
          echo '<div class="col-md-4" ></div >';
          echo '<div class="col-md-8 login" >';
          echo '<form class="loginForm" action = "index.php" method = "POST" >';
          echo '<div class="passTooltip" >';
          echo '<img src = "./img/image.png" alt = "" title = "">';
          echo '<span class="questionMark" >?</span >';
          echo '<span class="tooltipText" > <br />' .  'Successful Login Password = kount'  .  "<br />" . "<br />" .   'Two Factor Authentication Login = 2fa' . "<br />" . '</span >';
          echo '</div >';
          echo '<input id="user" class="form-control userInput"  name="username" style="margin-bottom: 30px" placeholder="Enter username" type="text" required>';
          echo '<input class="form-control" name = "password" placeholder = "Enter password" type = "password" required>';
          echo '<div class="submitLogin" >';
          echo '<button id = "login" class="btn btn-primary login" role = "button" > Submit </button >';
          echo '</div >';
          echo '</form >';
          echo '<a href = "home.php" ><span class="guestSpan" >or, Shop as a Guest!</span ></a >';
          echo '</div>';
        }
        ?>
      </div>
    </div>

    <div class="col-md-6 explanation" style="min-height: 460px">
      <h4 class="explanation"> Explanation </h4>
      <span class="explSpan">Some of the required fields for kount access processes are presented below. The requests use hashed versions of the user's password and username used for login and the sessionId is a value used by Kount's Data Collector service.</span>
      <form class="pricingForm" action="shipping.php" method="POST">
        <input type="text" name="csrf" value="-->-<?php //echo($session['csrf']);?><!--" hidden readonly/>
        <table>
          <h4>Fields Passed</h4>
          <tr>
            <td><label class="formLabel" for="">sessionId</label></td>
            <td><input class="form-control" type="text" name="session"
                       value=<?=$session?>
                       readonly></input></td>
          </tr>
          <tr>
            <td><label class="formLabel" for="">userHash</label></td>
            <td><input class="form-control" type="text" name="user" placeholder="Hashed value of the username." value="<?=$userHash?>" readonly></input></td>
          </tr>
          <tr>
            <td><label class="formLabel" for="">passwordHash</label></td>
            <td><input class="form-control" type="text" name="password" placeholder="Hashed value of the password." value="<?=$passwordHash?>" readonly></input></td>
          </tr>
        </table>
        <br/>
        <br/><br/>
      </form>
      <h4 class="other"> Other Information </h4>
      <span class="infoSpan">In order to use the API service to evaluate your transaction, you will need to have the Data Collector already setup and installed in your login page. Once this has been done, and you have access to the information on the login page you can make API service calls via the Kount_Access library to evaluate the login attempt. </span>
    </div>
  </div>
  <br/><br/>

  <script type="text/javascript" src='https://sandbox01.kaxsdc.com/collect/sdk?m=<?=$merchantId?>&s=<?=$session?>'>
  </script>
  <img width="1" height="1" src='https://sandbox01.kaxsdc.com/logo.gif?m=<?=$merchantId?>&s=<?=$session?>'/>

</div>
<?php
include('footer.php');
?>
