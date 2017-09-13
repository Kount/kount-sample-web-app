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

require __DIR__ . './vendor/autoload.php';

$ini = parse_ini_file('config.ini');

$merchantId = $ini["MERCHANT_ID"];

$accessKeys = array(
        'country', 'region', 'ipAddress', 'decision'
);

const version = "0210";
const merchantId = 999666;
const host = merchantId . ".kountaccess.com";
const accessUrl = "https://" . host . "/access";
const apiKey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI5OTk2NjYiLCJhdWQiOiJLb3VudC4xIiwiaWF0IjoxNDk5ODcwNDgwLCJzY3AiOnsia2EiOnRydWUsImtjIjp0cnVlLCJhcGkiOnRydWUsInJpcyI6dHJ1ZX19.yFan6moxBonnG8Vk9C_qRpF-eTF00_MRBwgqMdNdy8U";
const serverUrl = "api-sandbox01.kountaccess.com";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$password = isset($_SESSION['password']) ? $_SESSION['password'] : null;

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  try {
    $kount_access = new Kount_Access_Service(merchantId, apiKey, serverUrl, version);
    $response = $kount_access->get_decision($session, $username, $password);
    $_SESSION['accessResponse'] = $response;
  } catch (Kount_Access_Exception $ae) {
  	throw new Exception($ae->getMessage());
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
          <a href="home.php"><h4 style="max-width: 200px;"> Continue shopping! </h4></a>
        </div>
      </div>
    </div>

    <div class="col-md-6 explanation" style="min-height: 460px">
      <h4 class="explanation"> Explanation </h4>
      <span class="explSpan">The most important fields after a successful call to the Kount Access API and response are listed below. These particular parameters are taken from the device output and a option to view the full list of the returned response. </span>
      <input class="inputExpand" id="toggle" type="checkbox">
      <label id="popUpAnchor" class="labelExpand" for="toggle">View list of Kount Access response fields</label>
      <form class="pricingForm" style="margin-top:30px" action="shipping.php" method="POST">
        <input type="text" name="csrf" value="-->-<?php //echo($session['csrf']);?><!--" hidden readonly/>
        <table>
          <?php
              foreach ($response['device'] as $key => $res) {
                if ((array_search($key, $accessKeys)) !== false) {
                  echo '<tr>';
                  echo '<td><label class="formLabel" for="">' . strtoupper($key) . '</label></td>';
                  echo "<td><input class='form-control' type='text' name='name' value='$res' readonly> </input></td>";
                  echo '</tr>';
                }
              }
              foreach ($response['decision']['reply']['ruleEvents'] as $key => $res) {
                if ($key == "decision") {
                  echo '<tr>';
                  echo '<td><label class="formLabel" for="">' . strtoupper($key) . '</label></td>';
                  echo "<td><input class='form-control' type='text' name='name' value='$res' readonly> </input></td>";
                  echo '</tr>';
                }
              }
          ?>
        </table>
        <br/>
        <br/>
        <br/>
      </form>
      <h4 class="other"> Other Information </h4>
      <span class="infoSpan">The above parameters are retrieved by the /decision call which includes device information and velocity data in addition to the decision information. The decision value can be either <strong>"A"</strong> - Approve, or <strong>"D"</strong> - Decline.  </span>
    </div>
  </div>
  <br/><br/>
</div>
<script>
    var link = document.getElementById('popUpAnchor');
    link.addEventListener('click', function (e) {
        e.preventDefault();
        window.open('accessResponse.php', '_blank', 'width=1000px, height=700px, left=450px, top=180px, menubar=no, status=no, titlebar=no, resizable=no, scrollbars=yes');
    });
</script>

<?php
include('footer.php');
?>
