<?php
include('config.php');
if ($connect == null)
{
  echo "Create a database with a name 'pms' then reload this page.";
  return;
}
else 
{
  if (isset($_SESSION['user_type']))
  {
    header("location:dashboard.php");
  }
}
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
    }
    .clinic-logo
    {
      width: auto;
      height: 80px;
      margin-right: 10px; 
      margin-top: 20px; 
      top: 0; 
      right: 0;
      position: absolute;
    }
    @media (max-width: 500px) 
    {
      .muntinlupa-logo
      {
        height: 60px;
      }
      .clinic-logo
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
              <div class="card-body bg-success elevation-3" style="border-radius: 10px">
                <h3 class="text-light"><i class="fa fa-low-vision"></i> Vision</h3>
                    <p>We envision Muntinlupa City as one of the leading investment hubs in the country, with educated, healthy and God-loving people living peacefully and securely in a climate change-adaptive and disaster-resilient community, under the rule of transparent, caring and accountable leadership.
                    </p>
              </div>
            </div>
          </div>
          <br>
          <div class="col-12">
            <div class="card " style="border-radius: 25px">
              <div class="card-body bg-primary elevation-3" style="border-radius: 10px">
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
          <br>
          <br>
          <br>
          
        </div>
        <div class="col-0 col-lg-8 col-md-6 ">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <div class="col-12 d-flex justify-content-end ">
            <div class="col-12 col-md-12 col-xl-6 ">
              <div class="card card-white elevation-3" style="border-radius: 25px"  > 
                <div class="card-header text-center d-flex justify-content-center align-items-center" style="border-radius: 15px 15px 0 0 ;" >
                  <img src="assets/logo-bayanan.png" style="width: 45px;">
                  <a class="h3 pl-2"><b>Bayanan</b></a>
                </div>
                <div class="card-body login-card-body p-3 text-sm" style="border-radius: 0 0 15px 15px ;">
                  <div class="row">
                    <div class="col-12">
                      <h6 class="text-dark"><i class="fa fa-low-vision"></i> Vision</h6>
                      <i> “We envision Barangay Bayanan as the center of fish trade in the City of Muntinlupa, with a healthy and educated citizenry living in a clean and green community with prosperous economy supported by accessible and disaster-resilient infrastructure under responsible, transparent and honest governance.”</i>
                      <br><br>
                      <h6 class="text-dark"><i class="fa fa-flag"></i> Mission</h6>
                      <ul>
                        <li>To foster collaborative effort and honesty in meeting the basic social needs of the constituents</li>
                        <li>To embody good leadership and efficiency in public service delivery</li>
                        <li>To facilitate economic well-being of the constituents through employment</li>
                      </ul>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-end ">
            <div class="col-12 col-md-12 col-xl-6 ">
              <div class="card card-white elevation-3" style="border-radius: 25px"  > 
                <div class="card-header text-center d-flex justify-content-center align-items-center" style="border-radius: 15px 15px 0 0 ;" >
                  <img src="assets/logo-putatan.png" style="width: 45px;">
                  <a class="h3 pl-2"><b>Putatan</b></a>
                </div>
                <div class="card-body login-card-body p-3 text-sm" style="border-radius: 0 0 15px 15px ;">
                  <div class="row">
                    <div class="col-12">
                      <h6 class="text-dark"><i class="fa fa-low-vision"></i> Vision</h6>
                      <i> To make our barangay socially and economically progressive and environmentally sustainable and responsive to the interest and needs of the people through public services and infrastructures with public accountability and good governance.</i>
                      <br><br>
                      <h6 class="text-dark"><i class="fa fa-flag"></i> Mission</h6>
                      <i>Make available the public services and infrastructures where it is needed in order to uplift the status and conditions of the constituents at large</i>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-end ">
            <div class="col-12 col-md-12 col-xl-6 ">
              <div class="card card-white elevation-3" style="border-radius: 25px"  > 
                <div class="card-header text-center d-flex justify-content-center align-items-center" style="border-radius: 15px 15px 0 0 ;" >
                  <img src="assets/logo-tunasan.png" style="width: 45px;">
                  <a class="h3 pl-2"><b>Tunasan</b></a>
                </div>
                <div class="card-body login-card-body p-3 text-sm" style="border-radius: 0 0 15px 15px ;">
                  <div class="row">
                      <!-- <img src="assets/logo-ayala.png" style="width: 100px;"> -->
                    <div class="col-12">
                      <h6 class="text-dark"><i class="fa fa-low-vision"></i> Vision</h6>
                      <i> “We envision Barangay Tunasan, City of Muntinlupa as Service Provider and sports Recreation Hub of the South, with God-fearing and self-reliant, disciplined, healthy, and educated people in a participative community, working together to a progressive economy, supported by a well-built and disaster-resilient infrastructure, in an attractive and clean environment, under a pro-active, transparent, and efficient Barangay Local Governance.”</i>
                      <br><br>
                      <h6 class="text-dark"><i class="fa fa-flag"></i> Mission</h6>
                      <p>In order to fulfill its vision, we are committed to:</p>
                      <ul>
                        <li>To establish the identity of Barangay Tunasan as a Sports Recreation Hub of the South.</li>
                        <li>To transform our barangay into a more peaceful, clean, progressive and disaster resilient community.</li>
                        <li>To encourage the development of business and industries for employment and livelihood within the barangay.</li>
                        <li>To provide our constituents with basic services such as education, health, among others, through effective and efficient governance.</li>
                      </ul>
                    </div>
                  </div>

                </div>
              </div>
            </div>
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
    <img class="muntinlupa-logo" src="assets/muntinlupa-logo.png">
    <!-- <img class="clinic-logo" src="assets/muntinlupa-logo.png"> -->
    
   
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
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  
  <script>
      $(function () {    
      
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-start',
          showConfirmButton: false,
          timer: 3000
        });    
        
        var eye = false;

        $('#btn_password').click(function(){
          if (!eye)
          {
            $('#password').get(0).type = 'text';
            $( "#eyes").removeClass( "fa-eye" ).addClass( "fa-eye-slash" );
            eye = true;
          }
          else 
          {
            $('#password').get(0).type = 'password';
            $( "#eyes").removeClass( "fa-eye-slash" ).addClass( "fa-eye" );
            eye = false;
          }
        });
      
        $(document).on('submit','#login_form', function(event){
          event.preventDefault();
          $('#btn-login').attr('disabled','disabled');
          var form_data = $(this).serialize();
          $.ajax({
            url:"action.php",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
              $('#btn-login').attr('disabled', false);
              if (data.status == true)
              {
                // console.log('success');
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
              $('#btn-login').attr('disabled', false);
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