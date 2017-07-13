<?php

$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
}

?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Checkout with Kount Demo</title>
        <!--Including Bootstrap style files-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/header_footer.css">
        <link rel="shortcut icon" type="image/x-icon" href="./img/faviconKount.ico">
    </head>
    <body>
        <div class="header">
          <div class="headerImage">
            <img class="headerImg" src="img/kount-central-logo.jpg" width="177px" height="50px">
          </div>
          <div class="account">
            <form action="logout.php" method="POST">
              <button class="logBtn" id="logBtn"><?=isset($_SESSION['username']) ? $_SESSION['username'] . " (Logout)" : "Log In" ?> </button>
            </form>
          </div>
        </div>

        <div class="links">
          <div class="innerLinks">
            <span class="github">
            <a href="http://kount.github.io/" target="_blank">Github portal</a>
          </span>
            <span class="java">
            <a href="https://github.com/Kount/kount-ris-java-sdk/wiki" target="_blank">Java SDK</a>
          </span>
            <span class="php">
            <a href="https://github.com/Kount/kount-ris-php-sdk/wiki" target="_blank">PHP SDK</a>
          </span>
            <span class="net">
            <a href="https://github.com/Kount/kount-ris-dotnet-sdk" target="_blank">.NET SDK</a>
          </span>
            <span class="python">
            <a href="https://github.com/Kount/kount-ris-python-sdk" target="_blank">Python SDK</a>
          </span>
            <span class="awc">
            <a href="https://awc.test.kount.net/login.html" target="_blank">AWC</a>
          </span>
          </div>
        </div>

        <div class="well">
          <img class="hImage" src="img/kount-demo.png" width="343" height="80"/>
          <div>
            <p style="text-align:center"><span class="title">Beat Fraud and Boost Sales with Kount</span></p>
            <p style="text-align:center"><span class="subTitle">This quick demo will show how seamless it is to add Kount to your eCommerce experience: reduce fraud while ensuring </span></p>
            <p style="text-align: center"><span class="subTitle"> your customers have a  great online shopping experience</span></p>
          </div>
        </div>
    </body>
</html>

