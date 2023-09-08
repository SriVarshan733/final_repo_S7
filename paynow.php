<?php include('admin/db_connect.php'); ?>
<link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=512&id=ME2aFAiY2j6h&format=png">
<title>Payment Page</title>
<style>
  /* If you like this, please check my blog at codedgar.com.ve */
@import url('https://fonts.googleapis.com/css?family=Work+Sans');
body{
font-family: 'Work Sans', sans-serif;
background: #00d2ff; 
background: -webkit-linear-gradient(to right, #3a7bd5, #00d2ff); 
background: linear-gradient(to right, #3a7bd5, #00d2ff); 
  /* Thanks to uigradients :) */
}

.cardpay{
  background:#16181a;  border-radius:14px; max-width: 300px; display:block; margin:auto;
  padding:60px; padding-left:20px; padding-right:20px;box-shadow: 2px 10px 40px black; z-index:99;
}

.logo-cardpay{max-width:50px; margin-bottom:15px; margin-top: -19px;}

label{display:flex; font-size:10px; color:white; opacity:.4;}

input{font-family: 'Work Sans', sans-serif;background:transparent; border:none; border-bottom:1px solid transparent; color:#dbdce0; transition: border-bottom .4s;}
input:focus{border-bottom:1px solid #1abc9c; outline:none;}

.cardnumberpay{display:block; font-size:20px; margin-bottom:8px; }

.name{display:block; font-size:15px; max-width: 200px; float:left; margin-bottom:15px;}

.toleft{float:left;}
.ccv{width:50px; margin-top:-5px; font-size:15px;}

.receipt{background: #dbdce0; border-radius:4px; padding:5%; padding-top:200px; max-width:600px; display:block; margin:auto; margin-top:-180px; z-index:-999; position:relative;}

.col{width:50%; float:left;}
.bought-item{background:#f5f5f5; padding:2px;}
.bought-items{margin-top:-3px;}

.cost{color:#3a7bd5;}
.seller{color: #3a7bd5;}
.description{font-size: 13px;}
.price{font-size:12px;}
.comprobe{text-align:center;}
.proceed{position:absolute; transform:translate(300px, 10px); width:50px; height:50px; border-radius:50%; background:#1abc9c; border:none;color:white; transition: box-shadow .2s, transform .4s; cursor:pointer;}
.proceed:active{outline:none; }
.proceed:focus{outline:none;box-shadow: inset 0px 0px 5px white;}
.sendicon{filter:invert(100%); padding-top:2px;}

@media (max-width: 600px){
  .proceed{transform:translate(250px, 10px);}
  .col{display:block; margin:auto; width:100%; text-align:center;}
}
</style>
<div class="containerpay">
<?php
session_start(); // Start the session

include('admin/db_connect.php');
// Rest of your code...

$sessionId = $_SESSION['login_id'];
$query = "SELECT * FROM bids WHERE user_id = '$sessionId'";
$result = $conn->query($query);
// Rest of your code...
?>

<?php
$sessionId = $_SESSION['login_id'];
$query = "SELECT * FROM bids WHERE user_id = '$sessionId'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
?>
<?php
 while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $product_id = $row['product_id'];
    $bit_amount = $row['bid_amount'];
    $status = $row['status'];
    $date_created = $row['date_created'];
    $queryForProdcut = "SELECT * FROM products WHERE id = '$product_id'";
    $resultForProduct = $conn->query($queryForProdcut);
    while($row1 = $resultForProduct->fetch_assoc()) {
        $contact = $row1['contact'];
        $address = $row1['address'];
        $name = $row1['name'];
        $description = $row1['description'];
        $regularPrice = $row1['regular_price'];
        $image = $row1['img_fname'];
        $endDate = $row1['bid_end_datetime'];

        $sellerMobile = $row1['contact'];
        $userName = $row1['username'];
        $address = $row1['address']; 
    }}}

            ?>
  <div class="cardpay">
  <input type="hidden" id="name_" name="name_" value="<?php echo $userName ?>">
  <input type="hidden" id="amt_"  name="amt_" value="<?php echo $bit_amount ?>">
    <button onclick="pay_now()" class="proceed"><svg class="sendicon" width="24" height="24" viewBox="0 0 24 24">
  <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
</svg></button>
   <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQng3UhWxxTtY-0fSBH_RVJB-iIhdCczkC7aQ&usqp=CAU" class="logo-cardpay">
 <label>Payment gateway:</label>
 <input id="user" type="text" class="input cardnumberpay"  placeholder="Razorpay Software PVT LTD">
 <label>Reciver:</label>
 <input class="input name"  placeholder="srivarshan.org">
 <label class="toleft">Platfrom:</label>
 <input class="input toleft ccv" placeholder="Bid.it">
  </div>
  <div class="receipt">
    <div class="col"><p>Cost:</p>
    <h2 class="cost">₹ <?php echo number_format($bit_amount) ?></h2><br>
    <p>Seller Name:</p>
    <h2 class="seller"><?php echo $userName ?></h2>
    </div>
    <div class="col">
      <p>Brand name:</p>
      <h3 class="bought-items">Bid.it</h3>
      <p class="bought-items description">Farmer Based Bidding website</p>
      <p class="bought-items price">100% Authentic Green products</p><br>
      <h3 class="bought-items">Payment</h3>
      <p class="bought-items description">Accepts All kind payment</p>
      <p class="bought-items price">Payment using Razorpay</p><br>
    </div>
    <p class="comprobe">This page under control of <a href='https://srivarshan.org/'>srivarshan.org</a> read <a href="about.php">Agreement policy</a> once.</p>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function pay_now(product_id) {
        var name = jQuery('#name_').val();
        var amt = jQuery('#amt_').val();

        jQuery.ajax({
            type: 'post',
            url: 'payment_process.php',
            data: "amt=" + amt + "&name=" + name,
            success: function (result) {
                var options = {
                    "key": "rzp_test_35KB49UYo7xAQa",
                    "amount": amt * 100,
                    "currency": "INR",
                    "name": "Bid.it",
                    "description": "Test Transaction",
                    "image": "https://img.icons8.com/?size=512&id=ME2aFAiY2j6h&format=png",
                    "handler": function (response) {
                        jQuery.ajax({
                            type: 'post',
                            url: 'payment_process.php',
                            data: "payment_id=" + response.razorpay_payment_id,
                            success: function (result) {
                                window.location.href = "index.php";
                            }
                        });
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }
        });
    }
</script>
