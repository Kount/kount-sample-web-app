<?php


$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
}
include('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $type = isset($_POST['type']) ? $_POST['type'] : '1';
  $item = isset($_POST['item']) ? $_POST['item'] : 'Title';
  $desc = isset($_POST['desc']) ? $_POST['desc'] : 'Description';
  $quantity = isset($_POST['item_quantity']) ? $_POST['item_quantity'] : 1;
  $price = isset($_POST['price']) ? $_POST['price'] : 995;
}

$type = isset($type) ? $type : '1';
$item = isset($item) ? $item : 'Title';
$desc = isset($desc) ? $desc : 'Description';
$quantity = isset($quantity) ? $quantity : 1;
$price = isset($price) ? $price : 995;

?>
<style>

  .pricingForm tr {
    line-height: 30px;
  }

  .pricingForm td {
    padding: 5px;
  }

</style>

<div class="row">
  <div class="col-md-6 checkout">
    <div class="col-md-4">
    </div>
    <div class="col-md-8">
      <h2 style="font-weight: 700; margin-bottom: 40px; padding-left: 15px;">Checkout</h2>

      <form class="checkoutForm" action="response.php" method="POST">
        <div class="col-md-6" style="margin-bottom: 30px">
          <table>
            <tr>
              <td width="30%">Full Name</td>
              <td><input class="form-control" type="text" name="recipient_name" value="Jane Doe" readonly></input></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><input class="form-control" type="text" name="line1" value="55 East 52nd Street" readonly></input>
              </td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td>City</td>
              <td><input class="form-control" type="text" name="city" value="New York" readonly></input></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td>Card Number</td>
              <td><input class="form-control" type="text" name="card" value="**** **** **** 1234" readonly></input></td>
            </tr>
          </table>
        </div>
        <div class="col-md-6" style="margin-bottom: 30px">
          <table>
            <tr>
              <td width="30%">Email</td>
              <td><input class="form-control" type="email" name="recipient_email"
                         value="janedoe@example.com" readonly></input></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td>Address 1</td>
              <td><input class="form-control" type="text" name="line2" value="21st Floor" readonly></input></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td>State</td>
              <td><input class="form-control" type="text" name="state" value="NY" readonly></input></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td>Postal Code</td>
              <td><input class="form-control" type="text" name="postal_code" value="10022" readonly></input></td>
            </tr>
            <tr>
              <td><br/></td>
            </tr>
            <tr>
              <td>Security Code</td>
              <td><input class="form-control" type="text" name="security_code" value="552" readonly></input></td>
            </tr>
          </table>


        </div>
        <input type="text" name="markFlow" value="true" hidden></input>
        <input type="text" name="type" hidden value=<?php echo $type; ?>>
        <input type="text" name="item" hidden value=<?php echo $item; ?>>
        <input type="text" name="desc" hidden value=<?php echo $desc; ?>>
        <input type="text" name="item_quantity" hidden value=<?php echo $quantity ?>>
        <input type="text" name="price" hidden value=<?php echo $price ?>>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="line">

        </div>
        <div class="reviewSpan">
          <span> In this section you can review your purchased items. You can also alter the amount of purchased items which will influence the total amount and also the RIS response. You can do so by clicking each of the radio buttons bellow.</span>
        </div>
        <div style="width: 100%; height: 150px; margin-top: 40px;">
          <div class="left">
            <div class="leftInfo">
              <span class="productInfo"> Kount Hat: 6 Pack</span>
              <span class="leftSpanPrice"> $39.99 </span>
            </div>

            <div class="radioButtons">
              <div class="approve" title="Show a successful transaction.">
                <input id="approve" type="radio" name="alterInput" checked="checked">
                <img src="./img/approve.png" alt="" height="27px" width="25px">
              </div>
              <div class="review" title="Show a transaction in review.">
                <input id="review" type="radio" name="alterInput">
                <img src="./img/review.png" alt="" height="27px" width="25px">
              </div>
              <div class="decline" title="Show a declined transaction.">
                <input id="decline" type="radio" name="alterInput">
                <img src="./img/decline.png" alt="" height="27px" width="25px">
              </div>
            </div>
            <button id="back" class="btn btn-primary shipping" role="button">Back to Shop</button>
          </div>
          <div class="right">
            <div class="amountDiv">
              <input id="amountInput" name="amount" class="amount" type="number" value="5" readonly>
              <label class="labelQuantity" for=""> Quantity: </label>
            </div>
            <div class="totalDiv">
              <input id="totalInput" class="inputTotal" type="number" name="total" value="20000" readonly>
              <label class="labelTotal" for="">Total: </label>
            </div>
            <button id="purchase" type="submit" value="submit" class="btn btn-primary shipping">
              Process Order
            </button>
          </div>
        </div>
      </form>
      <br/>
    </div>
  </div>
  <div class="col-md-6 explanationCol" style="border-left: 1px solid #646464;">
    <h4 class="explanation"> Explanation </h4>
    <span class="explSpan">Here are the RIS request parameters related to user information. Those include user details such as customer name, age, address, shipping address, specific geo-details. The request can also include important information gathered by the Kount Data Collector tool based on the customer browser and internet session.</span>
    <form class="pricingForm">
      <input type="text" name="csrf" value="-->-<?php //echo($session['csrf']);?><!--" hidden readonly/>
      <table>
        <h4>Fields Passed</h4>
        <tr>
          <td><label class="formLabel" for="">NAME</label></td>
          <td><input class="form-control" type="text" name="name" value="Jane Doe" readonly></input></td>
        </tr>
        <tr>
          <td><label class="formLabel" for="">EMAIL</label></td>
          <td><input class="form-control" type="email" name="email" value="janedoe@example.com" readonly></input></td>
        </tr>
        <tr>
          <td><label class="formLabel" for="">B2A1</label></td>
          <td><input class="form-control" type="text" name="b2a1" value="123 Main Street " readonly></input></td>
        </tr>
        <tr>
          <td><label class="formLabel" for="">B2CC</label></td>
          <td><input class="form-control" type="text" name="b2cc" value="Boise" readonly></input></td>
        </tr>
        <tr>
          <td><label class="formLabel" for="">B2ST</label></td>
          <td><input class="form-control" type="text" name="b2st" value="Idaho"></input></td>
        </tr>
        <tr>
          <td><label class="formLabel" for="">B2PC</label></td>
          <td><input class="form-control" type="text" name="b2pc" value="83646" readonly></input></td>
        </tr>
        <tr>
          <td><label class="formLabel" for="">LAST4</label></td>
          <td><input class="form-control" type="text" name="lastFour" value="1234" readonly></input></td>
        </tr>
        <tr>
          <td><label class="formLabel" for="">TOTL</label></td>
          <td><input id="totlInput" class="form-control" type="text" name="total" value="20000" readonly></input></td>
        </tr>
      </table>
      <br/>
      <br/><br/>
    </form>
    <h4 class="other" style="margin-top: 120px;"> Other Information </h4>
    <span class="infoSpan">Depending on merchant-specific reqiurements, the request can be tuned with several other switches determining the behavior if any mismatch is noticed in the customer details or the purchase cart details. Those parameters are not shown here, but they are technically described in Kount SDK wikis. <br/>Also, all sensitive information like credit card numbers and any possible payment tokens is internally encrypted with a Kount-developed algorithm to defend both customers and merchants from possible man-in-the-middle attacks. Encrypted data may be used for cross-merchant analysis when detecting possible frauds.</span>
  </div>
</div>

<script>
  var btn = document.getElementById("back");
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    document.location.href = 'index.php';
  });
  var approve = document.getElementById("approve");
  approve.addEventListener('click', function (e) {
    $('#amountInput').val(5);
    $('#totalInput, #totlInput').val(5 * 4000);
  });
  var review = document.getElementById("review");
  review.addEventListener('click', function (e) {
    $('#amountInput').val(100);
    $('#totalInput, #totlInput').val(100 * 4000);
  });
  var decline = document.getElementById("decline");
  decline.addEventListener('click', function (e) {
    $('#amountInput').val(100000);
    $('#totalInput, #totlInput').val(100000 * 4000);
  });
</script>
<?php
include('footer.php');
?>
