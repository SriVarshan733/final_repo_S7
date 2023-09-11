<?php include('admin/db_connect.php');?>
<style>
.cardpro{
	background-color: #fff;
	width: 280px;
	border-radius: 33px;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	padding: 2rem !important;
}
.top-container{
	display: flex;
	align-items: center;
}
.profile-image{
	width: 55px;
	height: 55px;
	border-radius: 10px;
	border: 2px solid #5957f9;
}
.name{
	font-size: 15px;
	font-weight: bold;
	color: #272727;
	position: relative;
	top: 8px;
}
.mail{
	font-size: 14px;
	color: grey;
	position: relative;
	top: 2px;
}
.middle-container{
	background-color: #eee;
	border-radius: 12px;

}
.middle-container:hover {
	border: 1px solid #5957f9;
}
.dollar-div{
	background-color: #5957f9;
	padding: 12px;
	border-radius: 10px;
}
.round-div{
	border-radius: 50%;
	width: 35px;
	height: 35px;
	background-color: #fff;
	display: flex;
	justify-content: center;
	align-items: center;
	text-align: center;
}
.dollar{
	font-size: 16px !important;
	color: #5957f9 !important;
	font-weight: bold !important;
}


.current-balance{
	font-size: 15px;
	color: #272727;
	font-weight: bold;
}
.amount{
	color: #5957f9;
	font-size: 16px;
	font-weight: bold;
}
.dollar-sign{
	font-size: 16px;
	color: #272727;
	font-weight: bold;
}

.recent-border{
	border-left: 2px solid #5957f9;
	display: flex;
	align-items: center;

}
.recent-border:hover {
	border-bottom: 1px solid #dee2e6!important;
}

.recent-orders{
	font-size: 16px;
	font-weight: 700;
	color: #5957f9;
	margin-left: 2px;
}

.wishlist{
	font-size: 16px;
	font-weight: 700;
	color: #272727;

}
.wishlist-border:hover{
	border-bottom: 1px solid #dee2e6!important;
}
.fashion-studio{
	font-size: 16px;
	font-weight: 700;
	color: #272727;
}
.fashion-studio-border:hover {
	border-bottom: 1px solid #dee2e6!important;
}
</style>
<div class="container-fluid">
<div class="container d-flex justify-content-center mt-5">

<div class="cardpro">
	
	<div class="top-container">
		
		<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK0MVH3rn8WKA0jyr2jxtWbGMQqNLnHfGg976rgrQzHeEyYAr06wDJstjpchR3H7doodI&usqp=CAU" class="img-fluid profile-image" width="70">
		<div class="ml-3">
			<h5 class="name"><?php echo $_SESSION['login_name'] ?></h5>
			<h6 class="name">User number : <span class="amount"><?php echo $_SESSION['login_id'] ?></span></h6>
		</div>
	</div>


	<div class="middle-container d-flex justify-content-between align-items-center mt-3 p-2">
			<div class="dollar-div px-3">
				
				<div class="round-div"><i class='bx bx-credit-card'></i></div>

			</div>
			<?php
                $host = "database-1.cwa1v3hdvy5b.us-east-1.rds.amazonaws.com";
                $dbname = "kk";
                $username = "admin";
                $password = "admin123";
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
                $sessionId = $_SESSION['login_id'];
                // Query to calculate the total amount of success bids for the logged-in user
                $sql = "SELECT SUM(bid_amount) AS total_success_bids FROM bids WHERE user_id = :user_id AND status = 2";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_id', $sessionId, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $totalSuccessBids = $result['total_success_bids'];
                // Output the HTML
                echo '<div class="d-flex flex-column text-right mr-2">';
                echo '    <span class="current-balance">Total Debits</span>';
            if ($totalSuccessBids !== null) {
                echo '    <span class="amount"><span class="dollar-sign">₹ </span>' . $totalSuccessBids . '</span>';
            } else {
                // Display ₹ 0 if there are no successful bids
                echo '    <span class="amount"><span class="dollar-sign">₹ </span>0</span>';
            }
                echo '</div>';
            ?>
	</div>
	<div class="recent-border mt-4">
		<span class="recent-orders">User Activity</span>
	</div>
	<?php
        $sessionId = $_SESSION['login_id'];
        $sql = "SELECT COUNT(*) AS bid_count FROM bids WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $sessionId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && isset($result['bid_count'])) {
        $bidCount = $result['bid_count'];
        // Output the HTML
        echo '<div class="wishlist-border pt-2">';
        echo '    <span class="wishlist">Bids Done : <span class="amount">' . $bidCount . '</span></span>';
        echo '</div>';
        } else {
        // Handle the case where no bids were found
        echo '<div class="wishlist-border pt-2">';
        echo '    <span class="wishlist">Bids Done : <span class="amount">0</span></span>';
        echo '</div>';
       }
       ?>
    <?php
    $sessionId = $_SESSION['login_id'];
    $sql = "SELECT COUNT(*) AS success_count FROM bids WHERE user_id = :user_id AND status = 2";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $sessionId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && isset($result['success_count'])) {
    $successCount = $result['success_count'];
    // Output the HTML
        echo '<div class="fashion-studio-border pt-2">';
        echo '    <span class="fashion-studio">Success : <span class="amount">' . $successCount . '</span></span>';
        echo '</div>';
    } else {
    // Handle the case where no successful bids were found
        echo '<div class="fashion-studio-border pt-2">';
        echo '    <span class="fashion-studio">Success : <span class="amount">0</span></span>';
        echo '</div>';
    }
    ?>
	<?php
       $sessionId = $_SESSION['login_id'];
       $sql = "SELECT COUNT(*) AS product_count FROM products WHERE seller_authId = :seller_authId";
       $stmt = $pdo->prepare($sql);
       $stmt->bindParam(':seller_authId', $sessionId, PDO::PARAM_INT);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);
       if ($result && isset($result['product_count'])) {
       $productCount = $result['product_count'];
    // Output the HTML
        echo '<div class="fashion-studio-border pt-2">';
        echo '    <span class="fashion-studio">Products : <span class="amount">' . $productCount . '</span></span>';
        echo '</div>';
    } else {
    // Handle the case where no products were found
        echo '<div class="fashion-studio-border pt-2">';
        echo '    <span class="fashion-studio">Products : <span class="amount">0</span></span>';
        echo '</div>';
    }
    ?>
</div>

</div>
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->
			<!-- Table Panel -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header" style="color:#6c757d;">
            <b style="color:black;"><i class='bx bx-receipt'></i> List of Bids</b>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">S.no</th>
                        <th class="">Product Name</th>
                        <th class="">Amount</th>
                        <th class="">Status</th>
                        <th class="">Date</th>
                        <th class="">Time</th>
                    </tr>
                </thead>
                <tbody>	
                    <?php 
                    $i = 1;
                    $cat = array();
                    $cat[] = '';
                    $qry = $conn->query("SELECT * FROM categories ");
                    while($row = $qry->fetch_assoc()){
                        $cat[$row['id']] = $row['name'];
                    }
                    $sessionId = $_SESSION['login_id'];
                    $books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id where user_id = $sessionId ");
                    while($row=$books->fetch_assoc()):
                        $sessionId = $_SESSION['login_id'];
                        $get = $conn->query("SELECT * FROM bids where product_id = {$row['product_id']} order by bid_amount desc limit 1 ");
                        $uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0 ;
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++ ?>.</td>
                        <td class="">
                            <p> <b><?php echo ucwords($row['name']) ?></b></p>
                        </td>
                        <td class="text-right">
                            <center><p> <b>₹ <?php echo number_format($row['bid_amount'],2) ?></b></p></center>
                        </td>
                        <td class="text-center">
                            <?php if($row['status'] == 1): ?>
                            <?php if(strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])): ?>
                            <span class="badge badge-secondary">Bidding Stage</span>
                            <?php else: ?>
                            <?php if($uid == $row['user_id']): ?>
                            <span class="badge badge-success">Wins in Bidding</span>
                            <?php else: ?>
                            <span class="badge badge-secondary">Loose</span>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php elseif($row['status'] == 2): ?>
                            <span class="badge badge-primary">Confirmed</span>
                            <?php else: ?>
                            <span class="badge badge-danger">Canceled</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <p> <b><?php echo date('Y-m-d', strtotime($row['date_created'])) ?></b></p>
                        </td>
                        <td>
                            <p> <b><?php echo date('g:i A', strtotime($row['date_created'])) ?></b></p>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('.view_user').click(function(){
		uni_modal("<i class'fa fa-card-id'></i> Buyer Details","view_udet.php?id="+$(this).attr('data-id'))
		
	})
	$('#new_book').click(function(){
		uni_modal("New Book","manage_booking.php","mid-large")
		
	})
	$('.edit_book').click(function(){
		uni_modal("Manage Book Details","manage_booking.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_book').click(function(){
		_conf("Are you sure to delete this book?","delete_book",[$(this).attr('data-id')])
	})
	
	function delete_book($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_book',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>