<div id="paypal-button"></div>
<script>
  var details;
    paypal.Button.render({
      env: 'sandbox', // Or 'production',

      client: {
        sandbox: 'AZ9NTT2wd35FokACDkfmdyb-ncmhhANuEom6AqXfiwJCBUIRYJlw9WtMaEjULRHcroDw0StFUWTT7-iM',
        production: 'none'
      },

      commit: true, // Show a 'Pay Now' button

      style: {
        color: 'gold',
        size: 'small'
      },

      payment: function(data, actions) {
        return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '10.00', currency: 'EUR', custom: 'username_of_buyer_on_spanel'}
                        }
                    ]
                }
            });
      },

      onAuthorize: function(data, actions) {
        actions.payment.get().then(function(paymentDetails) {
          details = paymentDetails;
          console.log(details);
        });
      },

      onCancel: function(data, actions) {
        return data;
      },

      onError: function(err) {
        return err;
      }
    }, '#paypal-button');
  </script>
