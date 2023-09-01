<!DOCTYPE html>
<html lang="en">

<head>
<title>cart</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
    .button {
        width: 100%;
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .button:hover {
        background-color: #0056b3;
    }


    .wrapper {
  height: 420px;
  width: 654px;
  margin: 50px auto;
  border-radius: 7px 7px 7px 7px;
  /* VIA CSS MATIC https://goo.gl/cIbnS */
  -webkit-box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
}

.product-img {
  float: left;
  height: 420px;
  width: 327px;
}

.product-img img {
  border-radius: 7px 0 0 7px;
}

.product-info {
  float: left;
  height: 420px;
  width: 327px;
  border-radius: 0 7px 10px 7px;
  background-color: #ffffff;
}

.product-text {
  height: 300px;
  width: 327px;
}

.product-text h1 {
  margin: 0 0 0 38px;
  padding-top: 52px;
  font-size: 34px;
  color: #474747;
}

.product-text h1,
.product-price-btn p {
  font-family: 'Bentham', serif;
}

.product-text h2 {
  margin: 0 0 47px 38px;
  font-size: 13px;
  font-family: 'Raleway', sans-serif;
  font-weight: 400;
  text-transform: uppercase;
  color: #d2d2d2;
  letter-spacing: 0.2em;
}

.product-text p {
  height: 125px;
  margin: 0 0 0 38px;
  font-family: 'Playfair Display', serif;
  color: #8d8d8d;
  line-height: 1.7em;
  font-size: 15px;
  font-weight: lighter;
  overflow: hidden;
}

.product-price-btn {
  height: 103px;
  width: 327px;
  margin-top: 17px;
  position: relative;
}

.product-price-btn p {
  display: inline-block;
  position: absolute;
  top: -13px;
  height: 50px;
  font-family: 'Trocchi', serif;
  margin: 0 0 0 38px;
  font-size: 28px;
  font-weight: lighter;
  color: #474747;
}

.product-price-btn button {
  float: right;
  display: inline-block;
  height: 50px;
  width: 176px;
  margin: 0 40px 0 16px;
  box-sizing: border-box;
  border: transparent;
  border-radius: 60px;
  font-family: 'Raleway', sans-serif;
  font-size: 14px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.2em;
  color: #ffffff;
  background-color: #9cebd5;
  cursor: pointer;
  outline: none;
}

.product-price-btn button:hover {
  background-color: #79b0a1;
}

    </style>
</head>

<body>
    <?php
    // Check if 'login_id' is defined in the session
    if (isset($_SESSION['login_id'])) {
        $sessionId = $_SESSION['login_id'];
        $conns = new mysqli('localhost', 'root', '', 'kk') or die("Could not connect to mysql" . mysqli_error($con));
        $query = "SELECT * FROM bids WHERE user_id = '$sessionId'";
        $result = $conns->query($query);

        if ($result->num_rows > 0) {
    ?>
            <div class="col-md-12">
                <table>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $product_id = $row['product_id'];
                        $bit_amount = $row['bid_amount'];
                        $status = $row['status'];
                        $date_created = $row['date_created'];
                        $queryForProduct = "SELECT * FROM products WHERE id = '$product_id'";
                        $resultForProduct = $conns->query($queryForProduct);

                        while ($row1 = $resultForProduct->fetch_assoc()) {
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

                            $today = new DateTime();
                            $targetDate = new DateTime($endDate);

                            $statusText = ($status == 2) ? "Confirmed" : "Pending";
                    ?>
                            <th>
                            <div class="wrapper">
                            <div class="product-img">
                            <img src="admin/assets/uploads/<?php echo $image ?>" height="420" width="327">
                            </div>
                            <div class="product-info">
                            <div class="product-text">
                            <h1>Product: <?php echo $name ?></h1>
                            <h2>seller name :<?php echo $userName ?></h2>
                            <p>Address : <?php echo $address ?><br>Number : <?php echo $contact ?><br>Date & time : <?php echo $endDate ?><br>Status : <?php echo $statusText ?><br>Description : <?php echo $description ?></p>
                            </div>
                            <div class="product-price-btn">
                            <p><span>₹</span><?php echo number_format($bit_amount) ?></p>
                            <a href="paynow.php"><button type="button">Pay now</button></a>
                            </div>
                            </div>
                            </div>
                            </th>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
    <?php
        } else {
            echo "YOUR CART IS EMPTY.";
        }

        $conns->close();
    } else {
        // 'login_id' is not set in the session, display a message
        echo "Please first login.";
    }
    ?>
    <script>
        var payButtons = document.querySelectorAll('.pay-button');
        payButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var targetUrl = button.getAttribute('data-target');
                window.open(targetUrl, '_blank');
            });
        });
    </script>
    
</body>

</html>
