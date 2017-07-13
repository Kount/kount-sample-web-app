<?php

/*
    * Success Page
*/

include('header.php');

$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
}



require_once('./kount-access-php-sdk/lib/kount_access_service.php');
require_once('./kount-access-php-sdk/lib/kount_access_curl_service.php');
require_once('./kount-access-php-sdk/lib/kount_access_exception.php');

$ini = parse_ini_file('config.ini');

$merchantId = $ini["MERCHANT_ID"];


const version     = "0210";
const merchantId  = 999666;
const host        = merchantId . ".kountaccess.com";
const accessUrl   = "https://" . host . "/access";
const apiKey      = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI5OTk2NjYiLCJhdWQiOiJLb3VudC4xIiwiaWF0IjoxNDk5ODcwNDgwLCJzY3AiOnsia2EiOnRydWUsImtjIjp0cnVlLCJhcGkiOnRydWUsInJpcyI6dHJ1ZX19.yFan6moxBonnG8Vk9C_qRpF-eTF00_MRBwgqMdNdy8U";
const serverUrl   = "api-sandbox01.kountaccess.com";
const serverUrl2  = "api-sandbox02.kountaccess.com";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$password = isset($_SESSION['password']) ? $_SESSION['password'] : null;


if($_SERVER['REQUEST_METHOD'] == "GET") {
  try {
    $kount_access = new Kount_Access_Service(merchantId, apiKey, serverUrl, version);
    $response = $kount_access->get_decision($session, $username, $password);
    var_dump($response);
    //$response = $kount_access->get_device($session);
  } catch(Kount_Access_Exception $ae) {
    //var_dump($ae->getMessage());
    //print_r("Error Code: " . $ae->getCode());
    //var_dump($ae->getAccessErrorType());
  }
}
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

    <div class="col-md-6 product">
      <div class="col-xs-12" style="top: 45px; border-right: 1px solid #646464;">
        <div class="col-md-4"></div>
        <div class="col-md-8 login">
          <h2 style="font-weight: 700"> Thanks for logging
            In, <?= isset($_SESSION['username']) ? $_SESSION['username'] : "" ?></h2>
          <br/>
          <br/>
          <br/>
          <a href="home.php"><h4 style="max-width: 200px;"> Continue shopping!  </h4></a>
        </div>
      </div>
    </div>

      <div class="col-md-6 explanation" style="min-height: 460px">
        <h4 class="explanation"> Explanation </h4>
        <span class="explSpan">Several of the product purchase related parameters are presented below. Those include item identifier, description, price, and quantity. The values for those product specifications can be used by Kount services to provide better insight and control of customer purchases using predefined rules, operating over those parameters.</span>
        <form class="pricingForm" action="shipping.php" method="POST">
          <input type="text" name="csrf" value="-->-<?php //echo($session['csrf']);?><!--" hidden readonly/>
          <table>
            <h4>Fields Passed</h4>
            <tr>
              <td><label class="formLabel" for="">Country</label></td>
              <td><input class="form-control" type="text" name="item" value="BG" readonly></input></td>
            </tr>
            <tr>
              <td><label class="formLabel" for="">Region</label></td>
              <td><input class="form-control" type="text" name="price" value="JP_07" readonly></input></td>
            </tr>
            <tr>
              <td><label class="formLabel" for="">Ip Address</label></td>
              <td><input class="form-control" type="text" name="item_quantity" value="87.126.19.213" readonly></input></td>
            </tr>
            <tr>
              <td><label class="formLabel" for="">decision</label></td>
              <td><input class="form-control" type="text" name="type" value="test info....." readonly></input></td>
            </tr>
          </table>
          <br/>
          <br/><br/>
        </form>
        <h4 class="other"> Other Information </h4>

        <span class="infoSpan">The above parameters are usually set in a group representing the whole customer cart. The values are then merged into single strings for each parameter type to keep the request shorter in length. Kount is internally parsing those values to provide the ability to operate over them.</span>
      </div>
    </div>
    <br/><br/>
  </div>
</div>


<?php
include('footer.php');
?>
