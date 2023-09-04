<?php include('admin/db_connect.php');?>

<div class="container-fluid">
	
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
					<div class="card-header">
						<b>List of Products</b>
						<span class="float:right"><a class="button-18 float-right" href="index.php?page=post_auction" id="new_product">New Entry</a></span>
				        <span class="float:right"><a class="button-18 float-right" href="index.php?page=notification" id="new_product">Notification</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">S.no</th>
									<th class="">Img</th>
									<th class="">Category</th>
									<th class="">Product</th>
									<th class="">Other Info</th>
									<th class="text-center">Action</th>
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
                                $conns = new mysqli('localhost', 'root', '', 'kk') or die("Could not connect to mysql" . mysqli_error($con));
								$products = $conn->query("SELECT * FROM products where seller_authId = '$sessionId' order by name asc ");
								while($row=$products->fetch_assoc()):
									$get = $conn->query("SELECT * FROM bids where product_id = {$row['id']} order by bid_amount desc limit 1 ");
									$bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
									$tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
								?>
								<tr data-id= '<?php echo $row['id'] ?>'>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <div class="row justify-content-center">
										 	<img class="userimg" src="<?php echo 'admin/assets/uploads/'.$row['img_fname'] ?>" alt="">
										 </div>
									</td>
									<td>
										 <p> <b><?php echo ucwords($cat[$row['category_id']]) ?></b></p>
									</td>
									<td class="">
										 <p>Name: <b><?php echo ucwords($row['name']) ?></b></p>
										 <p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
									</td>
									<td>
										 <p><small>Regular Price: <b><?php echo number_format($row['regular_price'],2) ?></b></small></p>
										 <p><small>Start Price: <b><?php echo number_format($row['start_bid'],2) ?></b></small></p>
										 <p><small>End Date/Time: <b><?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></b></small></p>
										 <p><small>Highest Bid: <b class="highest_bid"><?php echo number_format($bid,2) ?></b></small></p>
										 <p><small>Total Bids: <b class="total_bid"><?php echo $tbid ?> user/s</b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_product" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_product" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
	table td img{
		max-width:100px;
		max-height: 150px;
	}
	.userimg{
		max-width:100px;
		max-height: 150px;
	}
	.notification {
    position: static;
    margin-left: 970px;
  }

  /* CSS */
.button-18 {
  align-items: center;
  background-color: #0A66C2;
  border: 0;
  border-radius: 100px;
  box-sizing: border-box;
  color: #ffffff;
  cursor: pointer;
  display: inline-flex;
  font-family: -apple-system, system-ui, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Fira Sans", Ubuntu, Oxygen, "Oxygen Sans", Cantarell, "Droid Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Lucida Grande", Helvetica, Arial, sans-serif;
  font-size: 16px;
  font-weight: 600;
  justify-content: center;
  line-height: 20px;
  max-width: 480px;
  min-height: 40px;
  min-width: 0px;
  overflow: hidden;
  padding: 0px;
  padding-left: 20px;
  padding-right: 20px;
  text-align: center;
  touch-action: manipulation;
  transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
  user-select: none;
  -webkit-user-select: none;
  vertical-align: middle;
}

.button-18:hover,
.button-18:focus { 
  background-color: #16437E;
  color: #ffffff;
}

.button-18:active {
  background: #09223b;
  color: rgb(255, 255, 255, .7);
}

.button-18:disabled { 
  cursor: not-allowed;
  background: rgba(0, 0, 0, .08);
  color: rgba(0, 0, 0, .3);
}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('.view_product').click(function(){
		uni_modal("product Details","view_product.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.edit_product').click(function(){
		location.href ="index.php?page=post_auction&id="+$(this).attr('data-id')
		
	})
	$('.delete_product').click(function(){
		_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
	
	function delete_product($id){
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=delete_product',
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