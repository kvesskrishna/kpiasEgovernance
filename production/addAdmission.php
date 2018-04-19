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
  <title>Krishna Pradeep's IAS | E-Governance - Add Admission </title>
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
              <h3>New Admission</h3>
            </div>


          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Admission <small>create new admission</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a href="manageAdmissions"><i class="fa fa-eye"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" method="post" action="webservices/formAction" novalidate>
                    <input type="hidden" name="action" value="addAdmission">

                    <span class="section">Admission Info</span>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Facility/Campus <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" id="stufacility" name="facility_id" required>
                          <option value="" selected>Select Campus/Facility</option>
                          <?php 
                          $ch = curl_init();  
                          curl_setopt($ch,CURLOPT_URL, API_PATH.'facilities?api_key=160e64f13691a2f59d34492dc238f98e');
                          curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                          $response=curl_exec($ch);
                          curl_close($ch);
                          $result = json_decode($response);
                          foreach ($result as $facility) {
                            ?>
                            <option value="<?php echo $facility->facility_id?>"><?php echo $facility->facility_name?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" id="stucourse" name="course_id" required>
                          <option value="" selected>Select Campus/Facility</option>
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course Fee <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="stufees" class="form-control col-md-7 col-xs-12" name="actual_course_fee" placeholder="Actual Course Fee Payable" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course Fee Concession (%) <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="feeconc" class="form-control col-md-7 col-xs-12" name="course_fee_concession" placeholder="Fee Concession (%)" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Total Course Fee <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="actfees" class="form-control col-md-7 col-xs-12" name="total_course_fee" placeholder="Total Fee Payable" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Avail Hostel? <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="radio">
                          <label><input type="radio" name="hostel" class="avhos" value="1">Yes</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" name="hostel" class="avhos" value="0">No</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Admission Date <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" name="admission_date" />
                            <span class="input-group-addon">
                             <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Notes
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea id="textarea" name="admission_notes" class="form-control col-md-7 col-xs-12"></textarea>
                    </div>
                  </div>
                  <span class="section">Student Info</span>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" name="student_firstname" type="text" required>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Middle Name 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" name="student_middlename" type="text" >
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="name" class="form-control col-md-7 col-xs-12" name="student_lastname" type="text" required>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control col-md-7 col-xs-12" name="student_gender" required>
                        <option value="" selected>Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Date of birth <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <div class='input-group date' id='myDatepicker3'>
                          <input type='text' class="form-control" name="student_dob" />
                          <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                         </span>
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father Name <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_father" type="text" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mother Name <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_mother" type="text" required>
                  </div>
                </div>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_email" type="mail" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_phone" type="text" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address Line 1 <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_address1" type="text" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address Line 2 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_address2" type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Locality <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_locality" type="text" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City/Town <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_city" type="text" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">State <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" name="student_state" type="text" required>
                  </div>
                </div>






                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" class="btn btn-success">Create Admission</button>
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
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script type="text/javascript">
  $('#myDatepicker2').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  $('#myDatepicker3').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  $('#stufacility').change(function(event) {
    $.ajax({
      url: 'getCourses.php',
      type: 'GET',
      data: {facility_id : $(this).val()},
      success: function(data) {
       // alert(data);
       $('#stucourse').html(data); 
     }
   });
  });
  $('#stucourse').on('change',function(event) {
    $.ajax({
      url: 'getFees.php',
      type: 'GET',
      data: {course_id : $(this).val(),facility_id:$('#stufacility').val()},
      success: function(data) {
//        alert(data);
$('#stufees').val(data); 
$('#stufees').attr('readonly',''); 
}
});
  });
  $('#feeconc').keyup(function(event) {
    var conc=$(this).val();
    var stufee=$('#stufees').val();
    var actfee=Math.round(stufee - (stufee*(conc/100)));
    $('#actfees').val(actfee);
    $('#actfees').attr('readonly',''); 
  });
</script>
</body>
</html>