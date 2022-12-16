<?php
  require "../../config.php";
?>
<div class="row d-flex justify-content-center">
  <div class="method col-auto" paymentmethod="sandbox">
    <div class="method-icon">
      <i class="fa fa-fast-forward" aria-hidden="true"></i>
    </div>
    <div class="method-body">
      Sandbox
    </div>
  </div>
  <div class="method col-auto" paymentmethod="bank">
    <div class="method-icon">
      <i class="fa fa-university" aria-hidden="true"></i>
    </div>
    <div class="method-body">
      Банков превод
    </div>
  </div>
  <div class="method col-auto" paymentmethod="paypal">
    <div class="method-icon">
      <i class="fa fa-paypal" aria-hidden="true"></i>
    </div>
    <div class="method-body">
      Paypal
    </div>
  </div>
  <div class="method col-auto" paymentmethod="creditcard">
    <div class="method-icon">
      <i class="fa fa-credit-card" aria-hidden="true"></i>
    </div>
    <div class="method-body">
      Кредитна карта
    </div>
  </div>
  <div class="method col-auto" paymentmethod="easypay">
    <div class="method-icon">
      <img src="<?php echo ROOT_URL; ?>includes/img/easypayicon.png" alt="easypay">
    </div>
    <div class="method-body">
      Easypay
    </div>
  </div>
  <div class="method col-auto" paymentmethod="googlewallet">
    <div class="method-icon">
      <i class="fa fa-google-wallet" aria-hidden="true"></i>
    </div>
    <div class="method-body">
      Google Wallet
    </div>
  </div>
</div>
