<?php require 'checkLogin.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
  <title>Krishna Pradeep's IAS | E-Governance - Manage Facilities </title>
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="home.php" class="site_title"> <span>Krishna Pradeep's IAS | E-Governance</span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $_SESSION['user']['username']?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <?php require 'sidenav.php';?>
        </div>
      </div>
      <!-- top navigation -->
      <?php require 'topnav.php';?>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Facilities <small>Manage</small><br>
                <?php 
                if (isset($_SESSION['action_message'])) {                  
                  ?>
                  <span style="color: orange"><?php echo $_SESSION['action_message']?></span>
                  <?php
                  unset($_SESSION['action_message']);
                }

                ?>

              </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a href="addFacility"><i class="fa fa-plus"></i></a>

                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Hostel</th>
                    <th>Address</th>
                    <th>Added Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ch = curl_init();  
                  curl_setopt($ch,CURLOPT_URL, API_PATH.'facilities?api_key=160e64f13691a2f59d34492dc238f98e');
                  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                  $response=curl_exec($ch);
                  curl_close($ch);
                  $result = json_decode($response);
                  foreach ($result as $item) {

                    ?>
                    <tr>
                      <td><?php echo $item->facility_code?></td>
                      <td><?php echo $item->facility_name?></td>
                      <td><input type="checkbox" class="js-switch" <?php if($item->facility_hostel_available==1) echo 'checked';?> readonly=""></td>
                      <td><?php echo $item->facility_address1.','.$item->facility_address2.','.$item->facility_locality.','.$item->facility_city.','.$item->facility_state?></td>
                      <td><?php echo $item->facility_created?></td>
                      <td><input type="checkbox" class="js-switch" <?php if($item->facility_status==1) echo 'checked';?> readonly=""></td>
                      <td>
                        <a href="editFacility?id=<?php echo $item->facility_id?>"><i class="fa fa-pencil text-primary"></i></a>
                        &nbsp;&nbsp;
                        <a href="webservices/formAction?action=deleteFacility&facility_id=<?php echo $item->facility_id?>"><i class="fa fa-times text-danger"></i></a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->
    <!-- footer content -->
    <?php require 'footer.php';?>
    <!-- /footer content -->
  </div>
</div>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="../vendors/switchery/dist/switchery.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>