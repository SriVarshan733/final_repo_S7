<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=512&id=ME2aFAiY2j6h&format=png">
<?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');

	
    ?>

<style>
#main-field {
    margin-top: 5rem !important;
}
</style>

<body id="page-top">
    <!-- Navigation-->
    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
    </div>
    <!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Bid.it</title>
    <link rel="stylesheet" href="stylehome.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus icon"></i>
        <div class="logo_name"><?php echo $_SESSION['system']['name'] ?></div>
        <i class="bx bx-menu" id="btn"></i>
      </div>
      <ul class="nav-list">
        <li>
          <i class="bx bx-search"></i>
          <input type="text" placeholder="Search..." />
          <span class="tooltip">Search</span>
        </li>
        <li>
          <a href="index.php?page=home">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <?php if(isset($_SESSION['login_id'])): ?>
        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span class="links_name " href=""><?php echo $_SESSION['login_name'] ?></span>
          </a>
          <span class="tooltip"><?php echo $_SESSION['login_name'] ?></span>
        </li>
        <li>
          <a href="auction_log.php">
            <i class="bx bx-folder"></i>
            <span class="links_name">Post Auction</span>
          </a>
          <span class="tooltip">Post Auction</span>
        </li>
        <?php else: ?>
            <li>
          <a href="">
            <i class="bx bx-user"></i>
            <span class="links_name " href="">Login</span>
          </a>
          <span class="tooltip">Please login</span>
        </li>
        <?php endif; ?>
        <li>
          <a href="index.php?page=market">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Analytics</span>
          </a>
          <span class="tooltip">Analytics</span>
        </li>
        <li>
          <a href="index.php?page=market">
            <i class="bx bx-card"></i>
            <span class="links_name">Category</span>
          </a>
          <span class="tooltip">Category</span>
        </li>
        <li>
          <a href="index.php?page=cart">
            <i class="bx bx-cart-alt"></i>
            <span class="links_name">Cart</span>
          </a>
          <span class="tooltip">Cart</span>
        </li>
        <li>
          <a href="index.php?page=about">
            <i class="bx bx-book"></i>
            <span class="links_name">Policy</span>
          </a>
          <span class="tooltip">Policy</span>
        </li>
        <li>
          <a href="mailto:hello@srivarshan.org">
            <i class="bx bx-phone"></i>
            <span class="links_name">Contact</span>
          </a>
          <span class="tooltip">Contact</span>
        </li>
        <?php if(isset($_SESSION['login_id'])): ?>
        <li class="profile">
          <div class="profile-details">
          <i class="bx bx-user"></i>
            <div class="name_job">
              <div class="name"><?php echo $_SESSION['login_name'] ?></div>
              <div class="job">User</div>
            </div>
          </div>
          <a href="admin/ajax.php?action=logout2"><i class="bx bx-log-out" id="log_out"></i></a>
        </li>
        <?php else: ?>
        <li class="profile">
          <div class="profile-details">
          <i class="bx bx-user"></i>
            <div class="name_job">
              <div class="name">login</div>
              <div class="job">Please login</div>
            </div>
          </div>
          <a href="javascript:void(0)" id="login_now"><i class="bx bx-log-in" id="log_out"></i></a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
    <section class="home-section">
      <main id="main-field">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';
        ?>

    </main>
    </section>

    <script src="scripthome.js"></script>
  </body>
</html>
    <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='submit'
                        onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog modal-full-height  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-arrow-right"></span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                <img src="" alt="">
            </div>
        </div>
    </div>
    <div id="preloader"></div>
    <footer class=" py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0 text-white"><b>Contact us</b></h2>
                    <hr class="divider my-4" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-mobile fa-3x mb-3 text-muted"></i>
                    <a class="d-block"
                        href="call:<?php echo $_SESSION['system']['contact'] ?>"><?php echo $_SESSION['system']['contact'] ?></a>
                </div>
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-users fa-3x mb-3 text-muted"></i>
                    <a class="d-block"
                        href="call:<?php echo $_SESSION['system']['contact'] ?>"><?php echo "Customer support" ?></a>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                    <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                    <a class="d-block"
                        href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="small text-center text-muted">Copyright © 2023 - <a
                    href="https://srivarshan.org/">Srivarshan.org</a> | <?php echo $_SESSION['system']['name'] ?> &
                Terms and conditions applied <a href="index.php?page=about">Agreement policy</a> </div>
        </div>
    </footer>

    <?php include('footer.php') ?>
</body>
<script type="text/javascript">
$('#login').click(function() {
    uni_modal("Login", 'login.php')
})
$('.datetimepicker').datetimepicker({
    format: 'Y-m-d H:i',
})
$('#find-car').submit(function(e) {
    e.preventDefault()
    location.href = 'index.php?page=search&' + $(this).serialize()
})
</script>
<?php $conn->close() ?>

</html>
