$(document).ready(function() {
  $.get("../includes/template/payments.php", function(data) {
    $(".content").html(data);
  });
});

var stage = 1;
var clicked = undefined;
var paymentmethod = undefined;

$("body").on("click", ".method", function() {
  $(".method").each(function() {
      $(this).removeClass("selected");
      $(this).find(".method-body").css("text-decoration", "none");
  });

  clicked = $(this);
  paymentmethod = $(this).attr("paymentmethod");

  $(this).addClass("selected");
  $(this).find(".method-body").css("text-decoration", "underline");
});

$("body").on("click", ".btn-back", function() {
  switch (stage) {
    case 1:
      location.href = $(this).attr("expiredpage");
      break;
    case 2:
      stage--;
      $.get("../includes/template/payments.php", function(data) {
        $(".content").html(data);
      });
      $(".btn-forward").removeClass("btn-success");
      $(".btn-forward").addClass("btn-primary");
      $(".btn-forward").html('Продължи <i class="fa fa-arrow-right" aria-hidden="true"></i>');
      $(".card-header .title").html('Изберете метод на плащане');
      break;
    default:
      location.href = $(this).attr("expiredpage");
  }
});

$("body").on("click", ".btn-forward", function() {
  if(stage == 1){
    if(paymentmethod != undefined){
      switch (paymentmethod) {
        case "sandbox":
          stage++;
          $.get("../includes/template/sandbox.php", function(data) {
            $(".content").html(data);
          });
          $(this).removeClass("btn-primary");
          $(this).addClass("btn-success");
          $(this).html('Потвърди <i class="fa fa-check" aria-hidden="true"></i>');
          $(".card-header .title").html('Потвърдете плащане <i class="fa fa-check" aria-hidden="true"></i>');
          break;
        case "bank":

          break;

        case "paypal":
          stage++;
          $.get("../includes/template/paypal.php", function(data) {
            $(".content").html(data);
          });
          break;

        case "creditcard":

          break;

        case "easypay":

          break;

        case "googlewallet":

          break;
      }
    }
  }else if(stage == 2){
    if(paymentmethod == "sandbox"){
      $.get("verify", function(data) {
        $(".content").html(data);
      });
    }
  }
});
