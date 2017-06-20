<?php
/*
    * Home Page - has Sample Buyer credentials, Camera (Product) Details and Instructions for using the code sample
*/
$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
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

      <div class="col-md-6 product">
        <div class="col-xs-12" style="top: 45px;">
          <div class="col-md-6">
            <span class="productName">Kount Hats: Six Pack</span>
          </div>
          <div class="col-md-6">
            <span class="productPrice">$39.99</span>
          </div>
        </div>

        <div class="col-xs-12" style="top:100px">
          <div class="col-md-6">
            <div class="photo-gallery">
              <img src="img/hats.png" width="228" height="300">
            </div>
          </div>
          <div class="col-md-6">
            <span class="productDesc">Discerning taste, boosting sales and beating fraud - now that is quite a hat!</span>
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
                <td><label class="formLabel" for="">PROD_DESC[]</label></td>
                <td><input class="form-control" type="text" name="desc"
                           value="Discerning taste, boosting sales  and beating fraud - now that is quite a hat!"
                           readonly></input></td>
              </tr>
              <tr>
                <td><label class="formLabel" for="">PROD_ITEM[]</label></td>
                <td><input class="form-control" type="text" name="item" value="HAT16599 " readonly></input></td>
              </tr>
              <tr>
                <td><label class="formLabel" for="">PROD_PRICE[]</label></td>
                <td><input class="form-control" type="text" name="price" value="3999" readonly></input></td>
              </tr>
              <tr>
                <td><label class="formLabel" for="">PROD_QUANT[]</label></td>
                <td><input class="form-control" type="text" name="item_quantity" value="1" readonly></input></td>
              </tr>
              <tr>
                <td><label class="formLabel" for="">PROD_TYPE[]</label></td>
                <td><input class="form-control" type="text" name="type" value="Hat" readonly></input></td>
              </tr>
            </table>
            <br/>
            <br/><br/>
            <div class="checkoutBtn">
              <button id="proceed" class="btn btn-primary" formaction="shipping.php" role="button">Proceed to Checkout</button>
            </div>
          </form>
          <h4 class="other"> Other Information </h4>

          <span class="infoSpan">The above parameters are usually set in a group representing the whole customer cart. The values are then merged into single strings for each parameter type to keep the request shorter in length. Kount is internally parsing those values to provide the ability to operate over them.</span>


        </div>
      </div>
      <br/><br/>
    </div>
<?php
include('footer.php');
?>
