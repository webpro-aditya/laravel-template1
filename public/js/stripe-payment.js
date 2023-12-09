
var stripeElements = function(publicKey, customerId, userEmail, paymentIntent) {
    var stripe = Stripe(publicKey);
    const options = {
      layout: "tabs",
    };
    var elements = stripe.elements({ 
      'clientSecret': paymentIntent.client_secret 
    });

  const linkAuthenticationElement = elements.create("linkAuthentication");
  linkAuthenticationElement.mount("#link-authentication-element");

  const paymentElementOptions = {
    layout: "tabs",
  };

  const paymentElement = elements.create("payment", paymentElementOptions);
  paymentElement.mount("#payment-element");
  
    // Element focus ring
    paymentElement.on("focus", function() {
      var el = document.getElementById("payment-element");
      el.classList.add("focused");
    });
  
    paymentElement.on("blur", function() {
      var el = document.getElementById("payment-element");
      el.classList.remove("focused");
    });
  
    // Handle payment submission when user clicks the pay button.
    var button = document.getElementById("submit");
    button.addEventListener("click", async function(event) {
      
      event.preventDefault();
      changeLoadingState(true);
  
      const {error: submitError} = await elements.submit(); 
  
      clientSecret = paymentIntent.client_secret;
  
      stripe.confirmPayment({
        elements,
        confirmParams: {
          // Make sure to change this to your payment completion page
          return_url: "http://127.0.0.1:8000/",
          receipt_email: userEmail,
        },
         // Uncomment below if you only want redirect for redirect-based payments
        redirect: "if_required",
      }).then(function(response){
          if(response.error){
            changeLoadingState(false);
            var displayError = document.getElementById("card-errors");
            displayError.textContent = response.error.message;
            return false;
          } else {
            update_customer_payment_method(response.paymentIntent.payment_method, customerId);
          }
        });
    });
  };
  
  

  
function update_customer_payment_method(payment_method_id, customerId) {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let data = {};
    data["payment_method_id"] = payment_method_id;
    data["customer_id"] = customerId;
    $.ajax({
      method: "POST",
      url: update_url_payment_url,
      data: data,
      dataType: "json",
      beforeSend: function () {},
      success: function (response) {
        location.assign(base_url+"/thanks");
      },
    });
  }
  
  
  // Show a spinner on payment submission
  var changeLoadingState = function(isLoading) {
    if (isLoading) {
      document.querySelector("button").disabled = true;
      document.querySelector("#spinner").classList.remove("hidden");
      document.querySelector("#button-text").classList.add("hidden");
    } else {
      document.querySelector("button").disabled = false;
      document.querySelector("#spinner").classList.add("hidden");
      document.querySelector("#button-text").classList.remove("hidden");
    }
  };
  
  
  
  