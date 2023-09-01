<?php 
include 'admin/db_connect.php'; 
?>
<style>
    #cat-list li{
        cursor: pointer;
    }
       #cat-list li:hover {
        color: white;
        background: #007bff8f;
    }
    .prod-item p{
        margin: unset;
    }
    .bid-tag {
    position: absolute;
    right: .5em;
}
</style>
<?php 
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
?>
<?php
$stmt = $conn->prepare("SELECT * FROM categories ORDER BY name ASC");
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()):
$cat_arr[$row['id']] = $row['name'];
?>
<?php endwhile; ?>
<div class="contain-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php
                                $where = "";
                                if($cid > 0){
                                    $where  = " AND category_id = ?";
                                }
                                $stmt = $conn->prepare("SELECT * FROM products WHERE unix_timestamp(bid_end_datetime) >= ? $where ORDER BY name ASC");
                                $current_time = strtotime(date("Y-m-d H:i"));
                                if($cid > 0) {
                                    $stmt->bind_param("ii", $current_time, $cid);
                                } else {
                                    $stmt->bind_param("i", $current_time);
                                }
                                
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if($result->num_rows <= 0){
                                    echo "<center><h4><i>No Available Product.</i></h4></center>";
                                } 
                                while($row = $result->fetch_assoc()):
                             ?>
                             <?php
                               $where = "";
                               if ($cid > 0) {
                               $where = " AND category_id = ?";
                               }
                               $stmt = $conn->prepare("SELECT p.*, MAX(b.bid_amount) AS highest_bid FROM products p LEFT JOIN bids b ON p.id = b.product_id WHERE unix_timestamp(p.bid_end_datetime) >= ? $where GROUP BY p.id ORDER BY p.name ASC");
                               $current_time = strtotime(date("Y-m-d H:i"));
                               if ($cid > 0) {
                               $stmt->bind_param("ii", $current_time, $cid);
                               } else {
                               $stmt->bind_param("i", $current_time);
                               }
                               $stmt->execute();
                               $result = $stmt->get_result();
                               if ($result->num_rows <= 0) {
                               echo "<center><h4><i>No Available Product.</i></h4></center>";
                               }
                               while ($row = $result->fetch_assoc()):
                             ?>
                             <div class="col-sm-4">
                                 <div class="card" style="height: 13cm; width: 7cm;">
                                    <div class="float-right align-top bid-tag">
                                         <span class="badge badge-pill badge-primary text-white"><i class="fa fa-tag"></i> <?php echo number_format($row['start_bid']) ?></span>
                                     </div>
                                     <img class="card-img-top" src="admin/assets/uploads/<?php echo $row['img_fname'] ?>" alt="Card image cap">
                                      <div class="float-right align-top d-flex">
                                         <span style="width: 5.5cm;" class="badge badge-pill badge-warning text-white"><i class="fa fa-hourglass-half"></i> End : <?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></span>
                                     </div>
                                     <div class="card-body prod-item">
                                         <p><center><b><?php echo $row['name'] ?></b></center></p>
                                         <p><center>Category: <?php echo $cat_arr[$row['category_id']] ?></center></p>
                                         <p><center>Current Bid: <b>₹<?php echo $row['highest_bid'] ?></center></b></p>
                                        <center><button class="btn btn-primary btn-sm view_prod" type="button" data-id="<?php echo $row['id'] ?>">Bid Now !</button></center>
                                     </div>
                                 </div>
                             </div>
                             <?php endwhile; ?>
                            <?php endwhile; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     
<script>
    $('#cat-list li').click(function(){
        location.href = $(this).attr('data-href')
    })
     $('#cat-list li').each(function(){
        var id = '<?php echo $cid > 0 ? $cid : 'all' ?>';
        if(id == $(this).attr('data-id')){
            $(this).addClass('active')
        }
    })
     $('.view_prod').click(function(){
        uni_modal_right('View Product','view_prod.php?id='+$(this).attr('data-id'))
     })
</script>
