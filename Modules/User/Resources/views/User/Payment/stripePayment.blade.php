


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet"   href="{{ asset('assets/user/css/checkout.css') }}" >
</head>
<body>
<!-- Display a payment form -->
<form id="payment-form">
    <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
    </div>
    <button id="checkout-button" type="button">Proceed to Checkout</button>

    <div id="payment-message" class="hidden"></div>
</form>


</body>
</html>
