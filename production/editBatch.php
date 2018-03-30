<?php require 'checkLogin.php';
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL, API_PATH.'batches?api_key=160e64f13691a2f59d34492dc238f98e&batch_id='.$_GET['id']);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$response=curl_exec($ch);
curl_close($ch);
$result = json_decode($response);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
  <title>Krishna Pradeep's IAS | E-Governance - Edit Batch </title>
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
  <!-- Switchery -->
  <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">


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
      <!--ACTUAL PAGE CONTENT-->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>New Batch</h3>
            </div>


          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Edit Batch <small>edit batch</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a href="manageCourses"><i class="fa fa-eye"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" method="post" action="webservices/formAction" novalidate>
                    <input type="hidden" name="action" value="editBatch">

                    <span class="section">Batch Info</span>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="500" data-validate-words="1" name="batch_name" required="required" type="text" value="<?php echo $result[0]->batch_name?>">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="textarea" required="required" name="batch_description" class="form-control col-md-7 col-xs-12"><?php echo $result[0]->batch_description?></textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="course_id" class="form-control">
                          <option selected value="<?php echo $result[0]->course_id?>"><?php echo $result[0]->course_name?></option>
                          <?php
                          $chc = curl_init();  
                          curl_setopt($chc,CURLOPT_URL, API_PATH.'courses?api_key=160e64f13691a2f59d34492dc238f98e');
                          curl_setopt($chc,CURLOPT_RETURNTRANSFER,true);
                          $responsec=curl_exec($chc);
                          curl_close($chc);
                          $resultc = json_decode($responsec);
                          foreach ($resultc as $itemc) {
                            ?>
                            <option value="<?php echo $itemc->course_id?>"><?php echo $itemc->course_name?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Start Date <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" name="batch_start" value="<?php echo $result[0]->batch_start?>" />
                            <span class="input-group-addon">
                             <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                         </div>
                       </div>
                     </div>
                   </div>

                   <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="">
                        <label>
                          <input type="checkbox" name="batch_status" class="js-switch" <?php if($result[0]->batch_status==1) echo 'checked';?> /> </label>
                        </div></div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <input type="hidden" name="batch_id" value="<?php echo $result[0]->batch_id?>">
                          <button id="send" type="submit" class="btn btn-success">Edit Batch</button>
                        </div>
                      </div>
                    </form>
                  </div>
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
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
    <script type="text/javascript">
      $('#myDatepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
      });

    </script>

  </body>
  </html>