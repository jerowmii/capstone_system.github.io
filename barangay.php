<?php
include('config.php');
if ($connect == null)
{
  echo "Create a database with a name 'cms' then reload this page.";
  return;
}
else 
{
  $brgy = '';
  if (empty($_SESSION['brgy']))
  {
    header("location:login.php");
  }
  else
  {
    if ($_SESSION['brgy'] == 'ayala')
    {
      $brgy = 'Ayala Alabang';
    }
    if ($_SESSION['brgy'] == 'alabang')
    {
      $brgy = 'Alabang';
    }
    if ($_SESSION['brgy'] == 'bayanan')
    {
      $brgy = 'Bayanan';
    }
    if ($_SESSION['brgy'] == 'buli')
    {
      $brgy = 'Buli';
    }
    if ($_SESSION['brgy'] == 'cupang')
    {
      $brgy = 'Cupang';
    }
    if ($_SESSION['brgy'] == 'poblacion')
    {
      $brgy = 'Poblacion';
    }
    if ($_SESSION['brgy'] == 'putatan')
    {
      $brgy = 'Putatan';
    }
    if ($_SESSION['brgy'] == 'sucat')
    {
      $brgy = 'Sucat';
    }
    if ($_SESSION['brgy'] == 'tunasan')
    {
      $brgy = 'Tunasan';
    }
  }
}
// echo $_SESSION['brgy'];

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

  <!--jQuery Magnify-->
  <link rel="stylesheet" href="assets/css/jquery.magnify.css">
  
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
    .right-logo
    {
      width: auto;
      height: 80px;
      margin-right: 10px; 
      margin-top: 20px; 
      top: 0; 
      right: 0;
      position: absolute;
    }
    .rectangle-image
    {
      width: 25%;
      height: 25%;
    }
    @media (max-width: 500px) 
    {
      .muntinlupa-logo
      {
        height: 60px;
      }
      .right-logo
      {
        height: 60px;
      }
    }
    @media (max-width: 991px) 
    {
      .rectangle-image
      {
        width: 100%;
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
    #events_announcements .carousel-indicators li {
      cursor: pointer;
      background: #000;
      overflow: hidden;
      border: 0;
      width: 12px;
      height: 12px;
      border-radius: 50px;
      opacity: 0.6;
      transition: 0.3s;
    }
    #events_announcements .carousel-indicators li.active {
      opacity: 1;
      background: #f0c508;
    }
  </style>

<body >

    <div id="home" class="home col-12 p-0"  >
      <div class="col-12 m-0 p-0  " > 
        <div class="col-12 text-center mt-4 pt-5 pt-sm-2">
          <h1 class="text-white">Bgry. <?php echo $brgy;?></h1>
        </div>
        <div class="row p-md-5 m-2 mt-4 ">
          <div class="col-12 col-lg-6 " >
            <div class="card elevation-3">
              <div class="card-body pt-0 pb-0">
                <div class="col-12 text-center mb-3 mt-3">
                  <h3 class="mb-2">Events & Announcements</h3>
                </div>
                <hr>
                <div class="row">
                  <?php 
                    $output = '';
                    $result = fetch_all($connect, $EA_TABLE, " WHERE status = 'Active' AND barangay_id = '$brgy' AND date_aging >= '".date("m-d-Y")."' ");
                    if ($result)
                    {
                      foreach($result as $row)
                      {
                        if ($row["type"] == 'Post')
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Events & Announcements" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 ">'.$row["details"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                        else
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Events & Announcements" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 "><b>WHAT:</b> '.$row["what_format"].'<br><b>WHEN:</b> '.$row["when_format"].'<br><b>WHERE:</b> '.$row["where_format"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                      }
                    }
                    else
                    {
                      $output = '<div class="col-12 text-center font-italic">No Events & Announcements.</div>';
                    }
                    echo $output;
                  ?>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 " >
            <div class="card elevation-3">
              <div class="card-body pt-0 pb-0">
                <div class="col-12 text-center mb-3 mt-3">
                  <h3 class="mb-2">Emergency Notices</h3>
                </div>
                <hr>
                <div class="row">
                  <?php 
                    $output = '';
                    $result = fetch_all($connect, $EN_TABLE, " WHERE status = 'Active' AND barangay_id = '$brgy' AND date_aging >= '".date("m-d-Y")."' ");
                    if ($result)
                    {
                      foreach($result as $row)
                      {
                        if ($row["type"] == 'Post')
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Emergency Notice" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 ">'.$row["details"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                        else
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Emergency Notice" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 "><b>WHAT:</b> '.$row["what_format"].'<br><b>WHEN:</b> '.$row["when_format"].'<br><b>WHERE:</b> '.$row["where_format"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                      }
                    }
                    else
                    {
                      $output = '<div class="col-12 text-center font-italic">No Emergency Notice.</div>';
                    }
                    echo $output;
                  ?>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 " >
            <div class="card elevation-3">
              <div class="card-body pt-0 pb-0">
                <div class="col-12 text-center mb-3 mt-3">
                  <h3 class="mb-2">Health & Care</h3>
                </div>
                <hr>
                <div class="row">
                  <?php 
                    $output = '';
                    $result = fetch_all($connect, $HC_TABLE, " WHERE status = 'Active' AND barangay_id = '$brgy' AND date_aging >= '".date("m-d-Y")."' ");
                    if ($result)
                    {
                      foreach($result as $row)
                      {
                        if ($row["type"] == 'Post')
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Health & Care" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 ">'.$row["details"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                        else
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Health & Care" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 "><b>WHAT:</b> '.$row["what_format"].'<br><b>WHEN:</b> '.$row["when_format"].'<br><b>WHERE:</b> '.$row["where_format"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                      }
                    }
                    else
                    {
                      $output = '<div class="col-12 text-center font-italic">No Health & Care.</div>';
                    }
                    echo $output;
                  ?>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 " >
            <div class="card elevation-3">
              <div class="card-body pt-0 pb-0">
                <div class="col-12 text-center mb-3 mt-3">
                  <h3 class="mb-2">Advertisements</h3>
                </div>
                <hr>
                <div class="row">
                  <?php 
                    $output = '';
                    $result = fetch_all($connect, $ADS_TABLE, " WHERE status = 'Active' AND barangay_id = '$brgy' AND date_aging >= '".date("m-d-Y")."' ");
                    if ($result)
                    {
                      foreach($result as $row)
                      {
                        if ($row["type"] == 'Post')
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Advertisements" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 ">'.$row["details"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                        else
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Advertisements" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 "><b>WHAT:</b> '.$row["what_format"].'<br><b>WHEN:</b> '.$row["when_format"].'<br><b>WHERE:</b> '.$row["where_format"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                      }
                    }
                    else
                    {
                      $output = '<div class="col-12 text-center font-italic">No Advertisements.</div>';
                    }
                    echo $output;
                  ?>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 " >
            <div class="card elevation-3">
              <div class="card-body pt-0 pb-0">
                <div class="col-12 text-center mb-3 mt-3">
                  <h3 class="mb-2">Sports</h3>
                </div>
                <hr>
                <div class="row">
                  <?php 
                    $output = '';
                    $result = fetch_all($connect, $SPORTS_TABLE, " WHERE status = 'Active' AND barangay_id = '$brgy' AND date_aging >= '".date("m-d-Y")."' ");
                    if ($result)
                    {
                      foreach($result as $row)
                      {
                        if ($row["type"] == 'Post')
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Sports" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 ">'.$row["details"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                        else
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="Sports" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 "><b>WHAT:</b> '.$row["what_format"].'<br><b>WHEN:</b> '.$row["when_format"].'<br><b>WHERE:</b> '.$row["where_format"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                      }
                    }
                    else
                    {
                      $output = '<div class="col-12 text-center font-italic">No Sports.</div>';
                    }
                    echo $output;
                  ?>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 " >
            <div class="card elevation-3">
              <div class="card-body pt-0 pb-0">
                <div class="col-12 text-center mb-3 mt-3">
                  <h3 class="mb-2">SK Information</h3>
                </div>
                <hr>
                <div class="row">
                  <?php 
                    $output = '';
                    $result = fetch_all($connect, $SKI_TABLE, " WHERE status = 'Active' AND barangay_id = '$brgy' AND date_aging >= '".date("m-d-Y")."' ");
                    if ($result)
                    {
                      foreach($result as $row)
                      {
                        if ($row["type"] == 'Post')
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="SK Information" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 ">'.$row["details"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                        else
                        {
                          $output .= '
                          <div class="col-12 ">
                            <div class="row p-2 ">
                              <a data-magnify="gallery" class="col-12 col-sm-3 m-2card-img-top rectangle-image " data-caption="SK Information" data-group="" href="'.$row["image"].'">
                                <img class="img-fluid " style="height: auto; width: auto; cursor: pointer;" id="user_img" src="'.$row["image"].'" alt="Valid Photo">
                              </a>
                              <div class="col-12 col-md-9 p-0 pl-3 "><b>WHAT:</b> '.$row["what_format"].'<br><b>WHEN:</b> '.$row["when_format"].'<br><b>WHERE:</b> '.$row["where_format"].'</div>
                            </div>
                            <hr>
                          </div>';
                        }
                      }
                    }
                    else
                    {
                      $output = '<div class="col-12 text-center font-italic">No SK Information.</div>';
                    }
                    echo $output;
                  ?>
                </div>
                <hr>
              </div>
            </div>
          </div>
        </div> <br/> <br/> <br/>
      </div>
      <!-- <footer class="bg-warning" style="padding: 20px 0 20px 0; text-align: center; ">
          <div  class="col-12">
            <div class="row text-center">
              <div class="col-sm-12 col-md-4 col-lg-4 col-12">
                <a><i class="fa fa-phone"></i> 09123456789</a>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4 col-12">
                <a><i class="fa fa-envelope"></i> ayala.muntinlupacity@gmail.com</a>
              </div>
              <div class="col-sm-12 col-md-4 col-lg-4 col-12">
                <a class="text-dark" href="https://facebook.com/Brgy.CupangNgayon"><i class="fab fa-facebook-square"></i> facebook.com/Brgy.AyalaNgayon</a>
              </div>
            </div>
          </div> <br/>
        <strong>&copy; 2022 Brgy. <?php echo $brgy; ?> </strong>
      </footer> -->
    </div>
    <img class="muntinlupa-logo" src="assets/muntinlupa-logo.png" id="btn_back">
    <img class="right-logo" src="assets/logo-<?php echo $_SESSION['brgy']; ?>.png" >
    
   
  <footer style="padding: 20px 0 20px 0; position: fixed; bottom: 0; width: 100%; " class="bg-yellow text-center text-md text-bold"> 
    <!-- <a href="https://facebook.com/officialMuntinlupacity"><i class="fab fa-facebook-square color-primary"></i></a> -->
    Brgy. <?php echo $brgy; ?> &copy; 2022
    <!-- <a href="https://twitter.com/officialmunti"><i class="fab fa-twitter-square color-primary"></i></a> -->
  </footer>

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>

  <!--jQuery Magnify-->
  <script src="assets/js/jquery.magnify.js"></script>
  
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
        
        $('#btn_back').click(function(){
          window.location.href = 'login.php';
        });  

      });
  </script>

</body>
</html>