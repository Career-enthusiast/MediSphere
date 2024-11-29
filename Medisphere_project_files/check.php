<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Address Form</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="address-container">
            <h1>1. Delivery Address</h1>
            <label for="address">Enter your address:</label>
            <textarea id="address" rows="6" placeholder="Type your full address here..."></textarea>
            <button class="use-address-button">Use this address</button>
        </div>

        <div class="payment-container">
            <h1>2. Payment method</h1>
            <div class="payment-option">
                <input type="radio" id="credit-card" name="payment" checked>
                <label for="credit-card">Credit or debit card</label>
                <div class="card-icons">
                    <img src="visa.png" alt="Visa">
                    <img src="mastercard.png" alt="MasterCard">
                    <img src="amex.png" alt="Amex">
                    <img src="maestro.png" alt="Maestro">
                </div>
                <input type="text" placeholder="Enter your card number">
            </div>
            <div class="payment-option">
                <input type="radio" id="cash" name="payment">
                <label for="cash">Cash on Delivery/Pay on Delivery</label>
                <p>Scan and pay at delivery with our Medisphere and win rewards up to Rs.100.</p>
            </div>
            <button class="use-payment-button">Use this payment method</button>
        </div>

        <button class="confirm-button">CONFIRM</button>
    </div>
</body>
</html>
