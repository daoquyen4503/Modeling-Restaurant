<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


function function_alert() { 
      

    echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
    echo "<script>window.location.replace('your_orders.php');</script>"; 
} 

if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{

										  
												foreach ($_SESSION["cart_item"] as $item)
												{
											
												$item_total += ($item["price"]*$item["quantity"]);
												
													if($_POST['submit'])
													{
						
													$SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
						
														mysqli_query($db,$SQL);
														
                                                        
                                                        unset($_SESSION["cart_item"]);
                                                        unset($item["title"]);
                                                        unset($item["quantity"]);
                                                        unset($item["price"]);
														$success = "Thank you. Your order has been placed!";

                                                        function_alert();

														
														
													}
												}
                                                
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Checkout || Online Food Ordering System - Code Camp BD</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- js script -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function togglePaymentForm() {
            var selectedPaymentMethod = document.querySelector('input[name="mod"]:checked').value;
            var cardForm = document.getElementById('card-form');
            if (selectedPaymentMethod === 'card') {
                cardForm.style.display = 'block';
            } else {
                cardForm.style.display = 'none';
            }
        }
    </script>

    <style>
            .payment-form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .payment-form .form-group {
            margin-bottom: 15px;
        }

        .payment-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .payment-form .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }


    </style>
</head>

<body>
    <!--  Author Name: MH RONY.
                        GigHub Link: https://github.com/dev-mhrony
                        Facebook Link:https://www.facebook.com/dev.mhrony
                        Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
                        for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
                        Visit My Website : developerrony.com -->
    <div class="site-wrapper">
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" width="18%"> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

                            <?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
									
									
									echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>
                            <!--  Author Name: MH RONY.
                        GigHub Link: https://github.com/dev-mhrony
                        Facebook Link:https://www.facebook.com/dev.mhrony
                        Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
                        for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
                        Visit My Website : developerrony.com -->
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">

                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and Pay</a></li>
                    </ul>
                </div>
            </div>

            <div class="container">

                <span style="color:green;">
                    <?php echo $success; ?>
                </span>

            </div>


            <!--  Author Name: MH RONY.
                        GigHub Link: https://github.com/dev-mhrony
                        Facebook Link:https://www.facebook.com/dev.mhrony
                        Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
                        for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
                        Visit My Website : developerrony.com -->

            <div class="container m-t-30">
                <form action="" method="post">
                    <div class="widget clearfix">

                        <div class="widget-body">
                            <form method="post" action="#">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="cart-totals margin-b-20">
                                            <div class="cart-totals-title">
                                                <h4>Cart Summary</h4>
                                            </div>
                                            <div class="cart-totals-fields">

                                                <table class="table">
                                                    <tbody>

                                                        <!--  Author Name: MH RONY.
                        GigHub Link: https://github.com/dev-mhrony
                        Facebook Link:https://www.facebook.com/dev.mhrony
                        Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
                        for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
                        Visit My Website : developerrony.com -->

                                                        <tr>
                                                            <td>Cart Subtotal</td>
                                                            <td> <?php echo "$".$item_total; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Delivery Charges</td>
                                                            <td>Free</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-color"><strong>Total</strong></td>
                                                            <td class="text-color"><strong> <?php echo "$".$item_total; ?></strong></td>
                                                        </tr>
                                                    </tbody>

                                                    <!--  Author Name: MH RONY.
                        GigHub Link: https://github.com/dev-mhrony
                        Facebook Link:https://www.facebook.com/dev.mhrony
                        Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
                        for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
                        Visit My Website : developerrony.com -->


                                                </table>
                                            </div>
                                        </div>
                                        <div class="payment-option">
                                        <form id="payment-form" action="process_payment.php" method="POST">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <label class="custom-control custom-radio m-b-20">
                                                        <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input" onclick="togglePaymentForm()"> 
                                                        <span class="custom-control-indicator"></span> 
                                                        <span class="custom-control-description">Cash on Delivery</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-control custom-radio m-b-10">
                                                        <input name="mod" type="radio" value="card" class="custom-control-input" onclick="togglePaymentForm()"> 
                                                        <span class="custom-control-indicator"></span> 
                                                        <span class="custom-control-description">ATM/ Internet Banking</span> 
                                                    </label>
                                                </li>
                                            </ul>

                                            <div id="card-form" style="display: none;">
                                                <div class="form-group">
                                                    <label for="card-holder">Card Holder Name</label>
                                                    <input type="text" id="card-holder" style="text-transform: uppercase;" name="card_holder" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="card-number">Card Number</label>
                                                    <input type="text" id="card-number" name="card_number" maxlength="19" class="form-control" oninput="formatCardNumber(this)" placeholder="Enter card number">
                                                    <script>
                                                        function formatCardNumber(input) {
                                                            let cardNumber = input.value.replace(/\D/g, '');
                                                            cardNumber = cardNumber.replace(/(\d{4})(?=\d)/g, '$1 ');
                                                            input.value = cardNumber;
                                                        }
                                                    </script>
                                                </div>
                                                <div class="form-group">
                                                    <label for="expiry-date">Expiry Date</label>
                                                    <input type="month" id="expiry-date" name="expiry_date" class="form-control" placeholder="MM/YY">
                                                </div>
                                            </div>
                                        </form>
                                        <p class="text-xs-center">
                                            <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit" class="btn btn-success btn-block" value="Order Now">
                                        </p>

                                        <script>
                                            function togglePaymentForm() {
                                                const cardForm = document.getElementById('card-form');
                                                const isCardSelected = document.querySelector('input[name="mod"]:checked').value === 'card';
                                                
                                                if (isCardSelected) {
                                                    cardForm.style.display = 'block';
                                                    document.getElementById('card-holder').setAttribute('required', 'required');
                                                    document.getElementById('card-number').setAttribute('required', 'required');
                                                    document.getElementById('expiry-date').setAttribute('required', 'required');
                                                } else {
                                                    cardForm.style.display = 'none';
                                                    document.getElementById('card-holder').removeAttribute('required');
                                                    document.getElementById('card-number').removeAttribute('required');
                                                    document.getElementById('expiry-date').removeAttribute('required');
                                                }
                                            }

                                            // Gọi hàm togglePaymentForm() khi tải trang để đặt đúng trạng thái ban đầu
                                            window.onload = togglePaymentForm;
                                        </script>

                                        </div>

                                        <script>
                                            var stripe = Stripe('your_stripe_public_key'); // Khóa công khai từ Stripe
                                            var elements = stripe.elements();

                                            var style = {
                                                base: {
                                                    color: '#32325d',
                                                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                                                    fontSmoothing: 'antialiased',
                                                    fontSize: '16px',
                                                    '::placeholder': {
                                                        color: '#aab7c4'
                                                    }
                                                },
                                                invalid: {
                                                    color: '#fa755a',
                                                    iconColor: '#fa755a'
                                                }
                                            };

                                            var card = elements.create('card', {style: style});
                                            card.mount('#card-element');

                                            var form = document.getElementById('payment-form');

                                            form.addEventListener('submit', function(event) {
                                                var selectedPaymentMethod = document.querySelector('input[name="mod"]:checked').value;
                                                if (selectedPaymentMethod === 'card') {
                                                    event.preventDefault();

                                                    stripe.createToken(card).then(function(result) {
                                                        if (result.error) {
                                                            console.log(result.error.message);
                                                        } else {
                                                            var hiddenInput = document.createElement('input');
                                                            hiddenInput.setAttribute('type', 'hidden');
                                                            hiddenInput.setAttribute('name', 'stripeToken');
                                                            hiddenInput.setAttribute('value', result.token.id);
                                                            form.appendChild(hiddenInput);

                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            });

                                            togglePaymentForm(); // Đảm bảo form thanh toán thẻ ẩn khi tải trang
                                        </script>





                                        <!-- <div class="payment-option">
                                            <ul class=" list-unstyled">
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-20">
                                                        <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Cash on Delivery</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-10">
                                                        <input name="mod" type="radio" value="paypal" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Paypal <img src="images/paypal.jpg" alt="" width="90"></span> 
                                                    </label>
                                                </li>
                                            </ul>
                                            <p class="text-xs-center"> <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit" class="btn btn-success btn-block" value="Order Now"> </p>
                                        </div> -->
                            </form>
                        </div>
                    </div>

            </div>
        </div>
        </form>
    </div>
    <!--  Author Name: MH RONY.
                        GigHub Link: https://github.com/dev-mhrony
                        Facebook Link:https://www.facebook.com/dev.mhrony
                        Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
                        for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
                        Visit My Website : developerrony.com -->
    <?php include "include/footer.php" ?>
    </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
<!--  Author Name: MH RONY.
                        GigHub Link: https://github.com/dev-mhrony
                        Facebook Link:https://www.facebook.com/dev.mhrony
                        Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
                        for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
                        Visit My Website : developerrony.com -->
<?php
}
?>
<!--  Author Name: MH RONY.
GigHub Link: https://github.com/dev-mhrony
Facebook Link:https://www.facebook.com/dev.mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
Visit My Website : developerrony.com -->