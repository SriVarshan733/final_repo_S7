<?php
// Replace these with your database connection details
$host = "localhost";
$user = "root";
$password = "";
$database = "kk";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to update status in the "bids" table
    function updateStatus($conn) {
        $stmt = $conn->prepare("UPDATE bids AS b
                                INNER JOIN (
                                    SELECT product_id, MAX(bid_amount) AS max_bid
                                    FROM bids
                                    GROUP BY product_id
                                ) AS max_bids
                                ON b.product_id = max_bids.product_id
                                SET b.status = 2
                                WHERE b.bid_amount = max_bids.max_bid
                                AND NOW() >= (
                                    SELECT bid_end_datetime FROM products WHERE id = b.product_id
                                )");
        $stmt->execute();
    }

    // Function to update buyer_id and bid_amt in the "products" table
    function updateProducts($conn) {
        $stmt = $conn->prepare("UPDATE products AS p
                                INNER JOIN (
                                    SELECT b.product_id, b.user_id AS buyer_id, b.bid_amount
                                    FROM bids AS b
                                    INNER JOIN (
                                        SELECT product_id, MAX(bid_amount) AS max_bid
                                        FROM bids
                                        GROUP BY product_id
                                    ) AS max_bids
                                    ON b.product_id = max_bids.product_id
                                    WHERE b.bid_amount = max_bids.max_bid
                                    AND NOW() >= (
                                        SELECT bid_end_datetime FROM products WHERE id = b.product_id
                                    )
                                ) AS max_bids
                                ON p.id = max_bids.product_id
                                SET p.buyer_id = max_bids.buyer_id, p.bid_amt = max_bids.bid_amount
                                WHERE NOW() >= p.bid_end_datetime");
        $stmt->execute();
    }

    updateStatus($conn);
    updateProducts($conn);

    echo "Data Updated Successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
