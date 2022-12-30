<?php
include('config.php');
if ($connect == null)
{
  echo "Create a database with a name 'cms' then reload this page.";
  return;
}
else 
{
  if (isset($_SESSION['user_type']))
  {
    header("location:dashboard.php");
  }
}
$_SESSION['brgy'] = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Content Management System</title>
  <link rel="icon" href="./assets/muntinlupa-logo.png" type="image/ico">

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
  <!-- daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  
  <style type="text/css">
    .hidden
    {
        display:none;
    }
    .muntinlupa-logo
    {
      width: auto;
      height: 80px;
      margin-left: 10px; 
      margin-top: 20px; 
      top: 0; 
      left: 0;
      position: absolute;
      cursor: pointer;
    }
    @media (max-width: 500px) 
    {
      .muntinlupa-logo
      {
        height: 60px;
      }
    }
    body 
    {
      display: flex;
      background: url("assets/bg.png") center repeat ;
      height: 100vh;
      background-size: cover;
      background-attachment: fixed;
      background-color: #f1f1f1;
    }
  </style>

<body >

    <div id="home" class="home col-12"  >
      <div class="col-12 row m-0 p-0  " style="height: 100%;"> 
        <div class="col-12 col-lg-4 col-md-6  " >
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <div class="col-12">
            <div class="card" style="border-radius: 25px">
              <div class="card-body bg-success elevation-3" style="border-radius: 25px">
                <h3 class="text-light"><i class="fa fa-low-vision"></i> Vision</h3>
                    <p>We envision Muntinlupa City as one of the leading investment hubs in the country, with educated, healthy and God-loving people living peacefully and securely in a climate change-adaptive and disaster-resilient community, under the rule of transparent, caring and accountable leadership.
                    </p>
              </div>
            </div>
          </div>
          <br>
          <div class="col-12">
            <div class="card " style="border-radius: 25px">
              <div class="card-body bg-primary elevation-3" style="border-radius: 25px">
                <h3 class="text-light"><i class="fa fa-flag"></i> Mission</h3>
                  <ul>
                    <li>To promote a broad-based economic growth and business-friendly environment for sustainable development;</li>
                    <li>To protect every person from natural and man-made hazards by ensuring strict enforcement of necessary safety measures;</li>
                    <li>To provide quality social services that include education, health care, livelihood and employment, socialized housing, and social assistance, among others; &</li>
                    <li>To institutionalize community participation in local governance, environmental protection, and economic development.</li>
                  </ul>
              </div>
            </div>
          </div>
          <br>
          <div class="col-12">
            <div class="card bg-gradient-warning" style="border-radius: 25px">
              <div class="card-body pt-3" style="border-radius: 25px">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <br>
          <br>
          <br>
          <br>
          
        </div>
        <div class="col-0 col-lg-8 col-md-6">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <div class="row">
            <div class="col-0 col-lg-2 col-xl-3 "></div>
            <div class="col-12 col-lg-8 col-xl-6 ">
              <div class="row">
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_ayala" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-ayala.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Ayala-Alabang</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_alabang" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-alabang.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Alabang</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_bayanan" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-bayanan.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Bayanan</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_buli" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-buli.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Buli</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_cupang" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-cupang.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Cupang</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_poblacion" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-poblacion.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Poblacion</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_putatan" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-putatan.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Putatan</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_sucat" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-sucat.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md" >Sucat</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 " >
                <div class="card card-white elevation-5" style="border-radius: 25px; cursor: pointer;" id="brgy_tunasan" > 
                  <div class="card-body login-card-body p-4 text-sm" style="border-radius:15px;">
                    <img src="assets/logo-tunasan.png" style="width: 100%;">
                    <div class="col-12 text-center p-0 m-0 " style="position: absolute; bottom: 8px; left: 0">
                      <span class="text-md " >Tunasan</span>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="col-0 col-lg-2 col-xl-3 "></div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
    <img class="muntinlupa-logo" src="assets/muntinlupa-logo.png" id="btn_login" data-toggle="modal" data-target="#loginModal" >

    <div id="loginModal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="forms">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-plus-circle"></i></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Username:</label>
                                <input type="text" name="username" id="username" class="form-control" required />
                            </div>
                            <div class="form-group col-12">
                                <label>Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="btn_action" id="btn_action"/>
                        <button type="submit" class="btn btn-primary pl-3 pr-3" name="action" id="action" ><i class="fa fa-plus text-white"></i> Add</button>
                        <button type="button" class="btn btn-danger pl-3 pr-3" data-dismiss="modal" ><i class="fa fa-times-circle"></i> Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="eventModal" class="modal fade">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-calenday-day"></i> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <table id="datatables" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Barangay</th>
                    <th>Type</th>
                    <th>Details</th>
                    <th>When</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pl-3 pr-3" data-dismiss="modal" ><i class="fa fa-times-circle"></i> Close</button>
            </div>
        </div>
      </div>
    </div>
    
   
  <footer style="padding: 20px 0 20px 0; position: fixed; bottom: 0; width: 100%;" class="bg-yellow text-center text-md text-bold"> 
    <a href="https://facebook.com/officialMuntinlupacity"><i class="fab fa-facebook-square color-primary"></i></a>
      City Government of Muntinlupa &copy; 2022
    <a href="https://twitter.com/officialmunti"><i class="fab fa-twitter-square color-primary"></i></a>
  </footer>

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  
  <!-- InputMask -->
  <script src="assets/plugins/moment/moment.min.js"></script>
  <script src="assets/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/jszip/jszip.min.js"></script>
  <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="assets/dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="assets/dist/js/pages/dashboard.js"></script> -->
  
  <script>
      $(function () {  
      
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });    
        
        $('#btn_login').click(function(){
          $('#forms')[0].reset();
          $('.modal-title').html("<i class='fa fa-sign-in-alt'></i> Login");
          $('#action').html("<i class='fa fa-sign-in-alt '></i> Login");
          $('#action').val('sign_in');
          $('#btn_action').val('sign_in');
        });  
    
        $(document).on('submit','#forms', function(event){
          event.preventDefault();
          $('#action').attr('disabled','disabled');
          var form_data = $(this).serialize();
          $.ajax({
            url:"action.php",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
              $('#action').attr('disabled', false);
              if (data.status == true)
              {
                window.location.href = "dashboard.php";
              }
              else 
              {
                Toast.fire({
                  icon: 'error',
                  title: '&nbsp;'+data.message
                });
              }
            },error:function()
            {
              $('#action').attr('disabled', false);
              Toast.fire({
                icon: 'error',
                title: 'Something went wrong.'
              });
            }
          })
        });

        function brgy(brgy)
        {
          var btn_action = 'barangay';
          $.ajax({
            url:"action.php",
            method:"POST",
            data:{brgy:brgy, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
              window.location.href = 'barangay.php';
            },error:function()
            {
              Toast.fire({
                icon: 'error',
                title: 'Something went wrong.'
              });
            }
          })
        }

        $('#brgy_ayala').click(function(){
          brgy('ayala');
        });   

        $('#brgy_alabang').click(function(){
          brgy('alabang');
        });   

        $('#brgy_bayanan').click(function(){
          brgy('bayanan');
        }); 

        $('#brgy_buli').click(function(){
          brgy('buli');
        }); 

        $('#brgy_cupang').click(function(){
          brgy('cupang');
        });   

        $('#brgy_poblacion').click(function(){
          brgy('poblacion');
        }); 

        $('#brgy_putatan').click(function(){
          brgy('putatan');
        });   

        $('#brgy_sucat').click(function(){
          brgy('sucat');
        }); 

        $('#brgy_tunasan').click(function(){
          brgy('tunasan');
        }); 

        $('#calendar').datetimepicker({
          format: 'L',
          inline: true,
        });

        $('.table').on('click','td',function() {
          var day = $(this).data("day");
          var btn_action = 'load_events';
          $.ajax({
            url:"action.php",
            method:"POST",
            data:{day:day, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
              $('#eventModal').modal('show');
              $('#eventModal .modal-title').html("<i class='fa fa-calenday-day'></i> All Events : " + day);
              // $('#datatables').html(data.table);
              $('#datatables').DataTable().destroy();
              $('#datatables').html(data.table);  
              $("#datatables").DataTable({ 
                  "responsive": true, 
                  "lengthChange": true, 
                  "autoWidth": false,
                  "ordering": false,
                  "info": false,
                  "searching": false,
                  "paging": false,
                  "pageLength": 10, 
              });
              $('#datatables').DataTable().draw();
            },error:function()
            {
              Toast.fire({
                icon: 'error',
                title: 'Something went wrong.'
              });
            }
          })
        });

      });
  </script>

</body>
</html>