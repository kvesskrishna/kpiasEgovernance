<?php require 'checkLogin.php';
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL, API_PATH.'facilities?api_key=160e64f13691a2f59d34492dc238f98e&facility_id='.$_GET['id']);
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
  <title>Krishna Pradeep's IAS | E-Governance - Edit Facility </title>
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/web-fonts-with-css/css/fontawesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <!--ACTUAL PAGE CONTENT-->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Edit Facilty</h3>
            </div>


          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Edit Facility <small>modify facility</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a href="manageFacilities"><i class="fa fa-eye"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" method="post" action="webservices/formAction" novalidate>
                    <input type="hidden" name="action" value="editFacility">

                    <span class="section">Facility Info</span>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Code <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="500" data-validate-words="1" name="facility_code" value="<?php echo $result[0]->facility_code?>" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="500" data-validate-words="1" name="facility_name" value="<?php echo $result[0]->facility_name?>" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Hostel Availability <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="">
                          <label>
                            <input type="checkbox" name="facility_hostel_available" class="js-switch" <?php if($result[0]->facility_hostel_available==1) echo 'checked'?> /> </label>
                          </div></div>
                        </div>

                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address line 1 <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="textarea" required="required" name="facility_address1" class="form-control col-md-7 col-xs-12"><?php echo $result[0]->facility_address1?></textarea>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address line 2 
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="textarea" name="facility_address2" class="form-control col-md-7 col-xs-12"><?php echo $result[0]->facility_address2?></textarea>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Locality <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="500" data-validate-words="1" name="facility_locality" value="<?php echo $result[0]->facility_locality?>" required="required" type="text">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City/Town <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="500" data-validate-words="1" name="facility_city" value="<?php echo $result[0]->facility_city?>" required="required" type="text">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">State <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="500" data-validate-words="1" name="facility_state" value="<?php echo $result[0]->facility_state?>" required="required" type="text">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="">
                              <label>
                                <input type="checkbox" name="facility_status" class="js-switch" <?php if($result[0]->facility_status==1) echo 'checked'?> /> </label>
                              </div></div>
                            </div>
                            <input type="hidden" name="facility_id" value="<?php echo $result[0]->facility_id?>">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-success">Update Info</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="x_content">

                          <form class="form-horizontal form-label-left" method="post" action="webservices/formAction" novalidate>
                            <input type="hidden" name="action" value="editFacilityFee">
                            <input type="hidden" name="facility_id" value="<?php echo $result[0]->facility_id?>">
                            <span class="section">Facility Fee Particulars</span>
                            <table id="feeinfo">
                              <?php
                              if(!empty($result[0]->fees)){
                                foreach ($result[0]->fees as $course_fees) {
                                  ?>
                                  <tr>
                                    <td>
                                      <label for="courseid">Course <span class="required">*</span></label>
                                    </td>
                                    <td>
                                      <select name="course_id[]" class="form-control">
                                        <option value="<?php echo $course_fees->course_id?>"><?php echo $course_fees->course_name?></option>
                                      </select>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                      <label for="feeamount">Fee <span class="required">*</span></label>
                                    </td>
                                    <td>
                                      <input id="name" class="form-control" data-validate-length-range="500" data-validate-words="1" name="fee_amount[]" required="required" value="<?php echo $course_fees->fee_amount?>" type="text">
                                    </td>
                                    <?php if($result[0]->facility_hostel_available==1) { ?>
                                    <td>
                                      <label for="hostelfee">Hostel Fee <span class="required">*</span></label>
                                    </td>
                                    <td>
                                      <input id="hostelfee" class="form-control" value="<?php echo $course_fees->hostel_fee?>" name="hostel_fee[]" required="required" type="text">
                                    </td>                                
                                    <?php } ?>

                                    <td>
                                      <button class="btn btn-danger remcourse">Remove</button>
                                    </td>
                                  </tr>
                                  <?php
                                }
                              }
                              ?>
                              <tr id="field-temp" style="display: none;">
                                <td>
                                  <label for="courseid">Course <span class="required">*</span></label>
                                </td>
                                <td>
                                  <select name="course_id[]" class="form-control">
                                    <option value="">Select course</option>
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
                                </td>

                                <td>&nbsp;</td>
                                <td>
                                  <label for="coursefee">Course Fee <span class="required">*</span></label>
                                </td>
                                <td>
                                  <input id="coursefee" class="form-control" data-validate-length-range="500" data-validate-words="1" name="fee_amount[]" required="required" type="text">
                                </td>
                                <?php if($result[0]->facility_hostel_available==1) { ?>
                                <td>
                                  <label for="hostelfee">Hostel Fee <span class="required">*</span></label>
                                </td>
                                <td>
                                  <input id="hostelfee" class="form-control" data-validate-length-range="500" data-validate-words="1" name="hostel_fee[]" required="required" type="text">
                                </td>                                
                                <?php } ?>
                                <td>
                                  <button class="btn btn-danger remcourse">Remove</button>
                                </td>
                              </tr>
                            </table>                    
                            <div class="ln_solid"></div>
                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button id="addcourse" type="submit" class="btn btn-primary">Add Course</button>
                                <button id="send" type="submit" class="btn btn-success">Update Fee Structure</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="x_content">

                          <form class="form-horizontal form-label-left" method="post" action="webservices/formAction" novalidate>
                            <input type="hidden" name="action" value="editFacilityContacts">
                            <input type="hidden" name="facility_id" value="<?php echo $result[0]->facility_id?>">
                            <span class="section">Facility Contact Info</span>
                            <table id="contactinfo">
                              <?php
                              if(!empty($result[0]->contacts)){
                                foreach ($result[0]->contacts as $facility_contacts) {
                                  ?>
                                  <tr>
                                    <td>
                                      <label for="name">Contact Name <span class="required">*</span></label>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" name="contact_name[]" required="" value="<?php echo $facility_contacts->contact_name?>">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                      <label for="name">Contact Email <span class="required">*</span></label>
                                    </td>
                                    <td>
                                      <input type="email" name="contact_email[]" class="form-control" required="" value="<?php echo $facility_contacts->contact_email?>">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                      <label for="name">Contact Phone <span class="required">*</span></label>
                                    </td>
                                    <td>
                                      <input type="text" name="contact_phone[]" required="" class="form-control" value="<?php echo $facility_contacts->contact_phone?>">
                                    </td>
                                    <td>
                                      <button class="btn btn-danger remcontact">Remove</button>
                                    </td>
                                  </tr>
                                  <?php
                                }
                              }
                              ?>
                              <tr id="field-temp2" style="display: none;">
                                <td>
                                  <label for="name">Contact Name <span class="required">*</span></label>
                                </td>
                                <td>
                                  <input type="text" name="contact_name[]" required="" class="form-control">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                  <label for="name">Contact Email <span class="required">*</span></label>
                                </td>
                                <td>
                                  <input type="email" name="contact_email[]" required="" class="form-control">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                  <label for="name">Contact Phone <span class="required">*</span></label>
                                </td>
                                <td>
                                  <input type="text" name="contact_phone[]" required="" class="form-control">
                                </td>
                                <td>
                                  <button class="btn btn-danger remcontact">Remove</button>
                                </td>
                              </tr>
                            </table>                    
                            <div class="ln_solid"></div>
                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button id="addcontact" type="submit" class="btn btn-primary">Add Contact</button>
                                <button id="send" type="submit" class="btn btn-success">Update Contacts</button>
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
          <script src="../vendors/switchery/dist/switchery.min.js"></script>

          <!-- Custom Theme Scripts -->
          <script src="../build/js/custom.min.js"></script>
          <script type="text/javascript">
            $('#myDatepicker2').datetimepicker({
              format: 'YYYY-MM-DD'
            });
            $('#addcourse').click(function(event) {
              /* Act on the event */
              var fields=$('#field-temp').html();
              $('#feeinfo').append('<tr>'+fields+'</tr>');
            });
            $('#feeinfo').on('click','.remcourse',function(event) {
              /* Act on the event */
              $(this).parent().parent().remove();
            });
            $('#addcontact').click(function(event) {
              /* Act on the event */
              var cfields=$('#field-temp2').html();
              $('#contactinfo').append('<tr>'+cfields+'</tr>');
            });
            $('#contactinfo').on('click','.remcontact',function(event) {
              /* Act on the event */
              $(this).parent().parent().remove();
            });
          </script>
        </body>
        </html>