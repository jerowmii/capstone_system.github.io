<?php

include('header.php');
$status = 'Dashboard';
include('sidebar.php');

if ($_SESSION["user_type"] !== 'Staff')
{
    $query = " ";
}
else
{
    $query = " barangay_id = '".$_SESSION["barangay"]."' AND ";
}



?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-2 col-md-4 " >
                    <div class="small-box bg-primary elevation-2" >
                        <div class="inner">
                            <h3 id="total_events"><?php echo get_total_count($connect, $CONTENT_TABLE, " $query category = 'Events & Announcements' "); ?></h3>
                            <p>Total of Events & Ann.s</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar-check"></i>
                        </div>
                        <a href="events.php" class="small-box-footer" >More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-12 col-xl-2 col-md-4 " >
                    <div class="small-box bg-danger elevation-2" >
                        <div class="inner">
                            <h3 id="total_events"><?php echo get_total_count($connect, $CONTENT_TABLE, " $query category = 'Emergency Notices' "); ?></h3>
                            <p>Total of Emergency Notices</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>
                        <a href="emergency_notices.php" class="small-box-footer" >More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-12 col-xl-2 col-md-4 " >
                    <div class="small-box bg-success elevation-2" >
                        <div class="inner">
                            <h3 id="total_events"><?php echo get_total_count($connect, $CONTENT_TABLE, " $query category = 'Health & Care' "); ?></h3>
                            <p>Total of Health & Care</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-heart"></i>
                        </div>
                        <a href="health_care.php" class="small-box-footer" >More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-12 col-xl-2 col-md-4 " >
                    <div class="small-box bg-info elevation-2" >
                        <div class="inner">
                            <h3 id="total_events"><?php echo get_total_count($connect, $CONTENT_TABLE, " $query category = 'Advertisements' "); ?></h3>
                            <p>Total of Advertisements</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clipboard "></i>
                        </div>
                        <a href="advertisements.php" class="small-box-footer" >More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-12 col-xl-2 col-md-4 " >
                    <div class="small-box bg-secondary elevation-2" >
                        <div class="inner">
                            <h3 id="total_events"><?php echo get_total_count($connect, $CONTENT_TABLE, " $query category = 'Sports' "); ?></h3>
                            <p>Total of Sports</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-medal "></i>
                        </div>
                        <a href="sports.php" class="small-box-footer" >More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-12 col-xl-2 col-md-4 " >
                    <div class="small-box bg-warning elevation-2" >
                        <div class="inner">
                            <h3 id="total_events"><?php echo get_total_count($connect, $CONTENT_TABLE, " $query category = 'SK Information' "); ?></h3>
                            <p>Total of SK Information</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-info-circle "></i>
                        </div>
                        <a href="sk_information.php" class="small-box-footer" >More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <div class="row">
                                <h3 class="card-title">Total No. of Events per Barangay</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card elevation-3">
                        <div class="card-header">
                            <div class="row">
                                <h3 class="card-title">Archive Year</h3>
                                <div class="col-1">
                                    <select class="form-control" name="year" id="year" required>
                                        <option value="">-Year-</option>
                                        <?php 
                                            $output = '';
                                            $query = "SELECT SUBSTR(when_format, 7, 4) AS years FROM $CONTENT_TABLE GROUP BY SUBSTR(when_format, 7, 4) ORDER BY years DESC ";
                                            $statement = $connect->prepare($query);
                                            $statement->execute();
                                            $result = $statement->fetchAll();
                                            foreach($result as $row)
                                            {
                                                $output .= '<option value="'.$row["years"].'">'.$row["years"].'</option>';
                                            }
                                            echo $output;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
include('footer.php');
?>
    
<script>
    $(function () {   
        $( "#year" ).change(function() {
            loadArchive(this.value);
        });
        
        loadData();
        function loadData()
        {
            var btn_action = 'load_data';
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{btn_action:btn_action},
                dataType:"json",
                success:function(data)
                {
                    var areaChartData = {
                        labels  : ['Ayala-Alabang', 'Alabang', 'Bayanan', 'Buli', 'Cupang', 'Putatan', 'Poblacion', 'Sucat', 'Tunasan'],
                        datasets: [
                            {
                                label               : 'Events & Ann.s',
                                backgroundColor     : '#007bff',
                                borderColor         : '#007bff',
                                pointRadius          : false,
                                pointColor          : '#3b8bba',
                                pointStrokeColor    : '#3b8bba',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: '#3b8bba',
                                data                : data.events
                            },
                            {
                                label               : 'Emergency Notices',
                                backgroundColor     : '#dc3545',
                                borderColor         : '#dc3545',
                                pointRadius         : false,
                                pointColor          : '#dc3545',
                                pointStrokeColor    : '#dc3545',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: '#dc3545',
                                data                : data.emergency
                            },
                            {
                                label               : 'Health & Care',
                                backgroundColor     : '#28a745',
                                borderColor         : '#28a745',
                                pointRadius          : false,
                                pointColor          : '#28a745',
                                pointStrokeColor    : '#28a745',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: '#28a745',
                                data                : data.health
                            },
                            {
                                label               : 'Advertisements',
                                backgroundColor     : '#17a2b8',
                                borderColor         : '#17a2b8',
                                pointRadius         : false,
                                pointColor          : '#17a2b8',
                                pointStrokeColor    : '#17a2b8',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: '#17a2b8',
                                data                : data.ads
                            },
                            {
                                label               : 'Sports',
                                backgroundColor     : '#6c757d',
                                borderColor         : '#6c757d',
                                pointRadius          : false,
                                pointColor          : '#6c757d',
                                pointStrokeColor    : '#6c757d',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: '#6c757d',
                                data                : data.sports
                            },
                            {
                                label               : 'SK Information',
                                backgroundColor     : '#ffc107',
                                borderColor         : '#ffc107',
                                pointRadius         : false,
                                pointColor          : '#ffc107',
                                pointStrokeColor    : '#ffc107',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: '#ffc107',
                                data                : data.ski
                            },
                        ]
                    }

                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    // var temp0 = areaChartData.datasets[0]
                    // var temp1 = areaChartData.datasets[1]
                    // barChartData.datasets[0] = temp1
                    // barChartData.datasets[1] = temp0

                    var barChartOptions = {
                        responsive              : true,
                        maintainAspectRatio     : false,
                        datasetFill             : false
                    }

                    var barChart = new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })

                },error:function()
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong.',
                    })
                }
            })
        }
        
        loadArchive('');
        function loadArchive(year)
        {
            var btn_action = 'load_archive';
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{year:year, btn_action:btn_action},
                dataType:"json",
                success:function(data)
                {
                    $('#datatables').DataTable().destroy();
                    $('#datatables').html(data.table);  
                    $("#datatables").DataTable({ 
                        "responsive": true, 
                        "lengthChange": true, 
                        "autoWidth": false,
                        "ordering": false,
                        "info": true,
                        "searching": true,
                        "paging": true,
                        "pageLength": 10, 
                    });
                    $('#datatables').DataTable().draw();

                },error:function()
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong.',
                    })
                }
            })

        }

    });
</script>

</body>
</html>
