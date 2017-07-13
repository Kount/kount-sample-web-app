<?php

$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
}

include('header.php');
require __DIR__ . '/./vendor/autoload.php';

$merchantId = 999666;
$url = "https://risk.beta.kount.net";
$apiKey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI5OTk2NjYiLCJhdWQiOiJLb3VudC4xIiwiaWF0IjoxNDk0NTM0Nzk5LCJzY3AiOnsia2EiOm51bGwsImtjIjpudWxsLCJhcGkiOmZhbHNlLCJyaXMiOnRydWV9fQ.eMmumYFpIF-d1up_mfxA5_VXBI41NSrNVe9CyhBUGck";

$name = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['recipient_name'] : '';
$email = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['recipient_email'] : '';
$city = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['city'] : '';
$state = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['state'] : '';
$postalCode = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['postal_code'] : '';
$address1 = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['line1'] : '';
$address2 = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['line2'] : '';

$type = $_POST['type'] ? $_POST['type'] : '1';
$item = $_POST['item'] ? $_POST['item'] : 'Title';
$desc = $_POST['desc'] ? $_POST['desc'] : 'Description';
$quantity = $_POST['item_quantity'] ? $_POST['item_quantity'] : 1;
$price = $_POST['price'] ? $_POST['price'] : 995;
$amount = $_POST['amount'] ? $_POST['amount'] : 5;
$total = $amount * 4000;
$risKeys = array(
  'AUTO', 'KAPT', 'VERS', 'MODE', 'MERC', 'SCOR', 'SESS', 'TRAN'
);

$approveMessage = "Thank you for your order.  Please check your email for order confirmation and shipping information.";
$reviewMessage = "We are processing your order now!  We will send a confirmation to the email address you provided.";
$declineMessage = "We apologize, but this order was declined.  Please contact our customer service team for further help and information at 1-800-555-1212.";

const IPAD = '131.206.45.21';
const AUTH = 'A';
const AVSZ = 'M';
const AVST = 'M';
const CVVR = 'M';

//Shipping Address - Name of Recipient
const S2NM = 'SdkShipToFN SdkShipToLN';
//Shipping Address - Email address of Recipient
const S2EM = 'sdkTestShipToEmail@kountsdktestdomain.com';
//Shipping Address Recipient address - Line 1
const S2A1 = '567 West S2A1 Court North';
//Shipping Address Recipient address - Line 2
const S2A2 = '';
//Shipping Address Recipient - City
const S2CI = 'Gnome';
//Shipping Address Recipient - State/Province
const S2ST = 'AK';
//Shipping Address Recipient - Counry Code
const S2CC = 'US';
//Shipping Address Recipient - Postal Code
const S2PC = '99762';
//Shipping Address Recipient - Phone Number
const S2PN = '555-777-1212';

const TOTL = 123456;
const CASH = 4444;

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
  $request = new Kount_Ris_Request_Inquiry();
  $request->setName($name);
  $request->setEmail($email);
  $request->setSessionId($session);
  $request->setMerchantId($merchantId);
  $request->setUrl($url);
  $request->setApiKey($apiKey);
  $request->setMack('Y');
  $request->setMode('Q');
  $request->setPaymentMasked('0007380568572514');
  $request->setTotal($total);
  $request->setWebsite('DEFAULT');
  $request->setIpAddress(IPAD);
  $request->setGender("M");
  $request->setAuth(AUTH);
  $request->setAvst(AVST);
  $request->setAvsz(AVSZ);
  $request->setCvvr(CVVR);
  $request->setShippingAddress(S2A1, S2A2, S2CI, S2ST, S2PC, S2CC);
  $request->setBillingAddress($address1, $address2, $city, $state, $postalCode, 'US');
  $request->setCash(CASH);

  $cart = new Kount_Ris_Data_CartItem($type, $item, $desc, $quantity, $price); //add 1 item for $9.95
  $request->setCart(array($cart));
  $response = $request->getResponse();
  $status = $response->getErrorCode();
  $score = $response->getScore();

  $_SESSION['responseArray'] = $response->getResponseAsDict();

}
?>
<style>

  .responsePricingForm tr {
    line-height: 30px;
  }

  .responsePricingForm td {
    padding: 5px;
  }

</style>

<div class="row">
  <div class="col-md-6 checkout">
    <div class="col-md-4">

    </div>
    <div class="col-md-8">
      <?php
      if ($response->getAuto() === 'A') {
        echo '<h2 style="font-weight: 700">' . "Transaction Successful" . '</h2>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<h4 style="max-width: 500px;">' . $approveMessage . '</h4>';
      } else if ($response->getAuto() === 'R') {
        echo '<h2 style="font-weight: 700">' . "Transaction Processing" . '</h2>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<h4 style="max-width: 500px;">' . $reviewMessage . '</h4>';
        echo '<br/>';
        echo '<h4 style="max-width: 500px;">' . "Thank you for your order" . '</h4>';
      } else if ($response->getAuto() === 'D') {
        echo '<h2 style="font-weight: 700">' . "Transaction Declined" . '</h2>';
        echo '<br/>';
        echo '<br/>';
        echo '<h4 style="max-width: 500px;">' . "Error code K-12345" . '</h4>';
        echo '<br/>';
        echo '<h4 style="max-width: 500px;">' . $declineMessage . '</h4>';
      }
      ?>

      <div class="bottomDiv">
        <div class="leftRes">
          <button id="back" class="btn btn-primary shipping" role="button">Back to Checkout</button>
        </div>
        <div class="rightRes">
          <button id="shopAgain" type="button" role="button" class="btn btn-primary shipping">
            Shop Again
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 explanationCol" style="border-left: 1px solid #646464;">
    <h4>Fields Received from RIS</h4>
    <span class="explSpan">Here's a list of some of the most used fields from the Kount RIS Response. Those include information of the request status, merchant credentials, and merchant-defined rules that were triggered by the request parameter values.</span>
    <input class="inputExpand" id="toggle" type="checkbox">
    <label id="popUpAnchor" class="labelExpand" for="toggle">View list of RIS response fields</label>
    <form class="responsePricingForm" method="POST">
      <table>
        <?php foreach ($response->getResponseAsDict() as $key => $res) {
          if ((array_search($key, $risKeys)) !== false) {
            echo '<tr>';
            echo '<td><label class="formLabel" for="">' . $key . '</label></td>';
            echo "<td><input class='form-control' type='text' name='name' value='$res' readonly> </input></td>";
            echo '</tr>';
          }
        }
        ?>
      </table>
    </form>
    <h4 class="other" style="margin-top: 25px;"> Other Information </h4>
    <span class="infoSpan">As you can notice, the <tt>AUTO</tt> value is changing between the different requests, created by the demo. A value of <tt>A</tt> means that the customer purchase can be automatically <tt>Approved</tt>, because the Kount RIS algorithms determined that it's most possible not a fraud. <tt>AUTO = R</tt> would mean that the customer purchase should undergo a <tt>Review</tt> by the merchant because mismatches were found or merchant-defined rules were triggered. A value of <tt>AUTO = D</tt> means that this customer purchase is most likely a fraud and it should be automatically <tt>Decline</tt>d but the merchant needs to log it for further investigation if the customer performs any consequent actions for that purchase.</span>
  </div>
</div>
<script>
  var btn = document.getElementById("back");
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    document.location.href = 'shipping.php';
  });
  var btn2 = document.getElementById('shopAgain');
  btn2.addEventListener('click', function (e) {
    e.preventDefault();
    document.location.href = 'home.php';
  });
  var link = document.getElementById('popUpAnchor');
    link.addEventListener('click', function (e) {
    e.preventDefault();
    window.open('fullResponse.php', '_blank', 'width=1000px, height=700px, left=450px, top=180px, menubar=no, status=no, titlebar=no, resizable=no, scrollbars=yes');
  });
</script>

<?php
include('footer.php');
?>
