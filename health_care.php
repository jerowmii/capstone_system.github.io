<?php

include('header.php');
$status = 'Health & Care';
include('sidebar.php');

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?php echo $status; ?></h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card elevation-3">
                        <div class="card-header">
                            <button type="button" name="add" id="add_button" data-toggle="modal" data-target="#addModal" class="btn btn-primary elevation-3 pl-3 pr-3" >
                                <i class="fa fa-plus-circle"></i> Create</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Content</th>
                                        <th>When</th>
                                        <?php if ($_SESSION["user_type"] !== 'Staff') { ?>
                                            <th>Barangay</th>
                                        <?php } ?>
                                        <th>Date Remove</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
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

<div id="addModal" class="modal fade">
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
                            <div class="text-center">
                                <div class="image-upload " >
                                    <label for="file-input">
                                        <img class="img-thumbnail img-profile img-bordered-sm image" src="assets/images/default.png" style="cursor:pointer; width: 150px; height: 150px;"/>
                                    </label>
                                    <input id="file-input" type="file" accept=".png, .jpg, .jpeg" onchange="readURL(this);" name="image" id="image" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label>Type</label>
                            <select class="form-control" name="type" id="type" required >
                                <option value="">-Please Select-</option>
                                <option value="Post">Post</option>
                                <option value="Format">Format</option>
                            </select>
                        </div>
                        <div class="form-group col-12 what hidden">
                            <label>What:</label>
                            <input type="text" name="what" id="what" class="form-control"  />
                        </div>
                        <div class="form-group col-12 when ">
                            <label>When:</label>
                            <div class="input-group date" id="whens" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" 
                                data-toggle="datetimepicker" data-target="#whens" id="when" name="when" placeholder="MM-DD-YYYY hh:mm A" required />
                                <div class="input-group-append" data-target="#whens" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 where hidden">
                            <label>Where:</label>
                            <textarea name="where" id="where" class="form-control" ></textarea>
                        </div>
                        <div class="form-group col-12 details hidden">
                            <label>Details:</label>
                            <textarea id="details" name="details" class="form-control" style="height: 300px" >
                            </textarea>
                        </div>
                        <?php if ($_SESSION["user_type"] !== 'Staff') { ?>
                            <div class="form-group col-12 ">
                                <label>Barangay</label>
                                <select class="form-control" name="barangay_id" id="barangay_id" required>
                                    <option value="">-Please Select-</option>
                                    <option value="Ayala Alabang">Ayala Alabang</option>
                                    <option value="Alabang">Alabang</option>
                                    <option value="Bayanan">Bayanan</option>
                                    <option value="Buli">Buli</option>
                                    <option value="Cupang">Cupang</option>
                                    <option value="Poblacion">Poblacion</option>
                                    <option value="Putatan">Putatan</option>
                                    <option value="Sucat">Sucat</option>
                                    <option value="Tunasan">Tunasan</option>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="form-group col-12 ">
                            <label>Date Remove:</label>
                            <div class="input-group date" id="date_agings" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" 
                                data-toggle="datetimepicker" data-target="#date_agings" id="date_aging" name="date_aging" placeholder="MM-DD-YYYY" required />
                                <div class="input-group-append" data-target="#date_agings" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="category" id="category" value="Health & Care" />
                    <input type="hidden" name="image" id="image" />
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="btn_action" id="btn_action"/>
                    <button type="submit" class="btn btn-primary pl-3 pr-3" name="action" id="action" ><i class="fa fa-plus text-white"></i> Add</button>
                    <button type="button" class="btn btn-danger pl-3 pr-3" data-dismiss="modal" ><i class="fa fa-times-circle"></i> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('.image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(function () {   
        $('#details').summernote();  
        
        $('#type').change(function(){
            if (this.value == 'Post')
            {
                $('.details').removeClass('hidden');
                $('.what').addClass('hidden');
                // $('.when').addClass('hidden');
                $('.where').addClass('hidden');
                $('#what').removeAttr('required','required');
                // $('#when').removeAttr('required','required');
                $('#where').removeAttr('required','required');
            }
            else if (this.value == 'Format')
            {
                $('.details').addClass('hidden');
                $('.what').removeClass('hidden');
                // $('.when').removeClass('hidden');
                $('.where').removeClass('hidden');
                $('#what').attr('required','required');
                // $('#when').attr('required','required');
                $('#where').attr('required','required');
            }
            else
            {
                $('.details').addClass('hidden');
                $('.what').addClass('hidden');
                // $('.when').addClass('hidden');
                $('.where').addClass('hidden');
                $('#what').attr('required','required');
                // $('#when').attr('required','required');
                $('#where').attr('required','required');
            }
        }); 
    
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });     
        
        $('#add_button').click(function(){
            $('#forms')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus-circle'></i> <?php echo $status;?>");
            $('#action').html("<i class='fa fa-plus-circle '></i> Create");
            $('#action').val('content_add');
            $('#btn_action').val('content_add');
            $('.details').addClass('hidden');
            $('.what').addClass('hidden');
            // $('.when').addClass('hidden');
            $('.where').addClass('hidden');
            $('#what').attr('required','required');
            // $('#when').attr('required','required');
            $('#where').attr('required','required');
            $('#details').summernote('code', '');
            $('.image').attr('src', 'assets/images/default.png');
        });
    
        $(document).on('click', '.update', function(){
            var id = $(this).attr("id");
            var btn_action = 'content_fetch';
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                dataType:"json",
                success:function(data)
                {
                    $('#addModal').modal('show');
                    $('.image').attr('src', data.image);
                    $('#image').val(data.image);
                    $('#type').val(data.type);
                    $('#what').val(data.what);
                    $('#when').val(data.when);
                    $('#where').val(data.where);
                    $('#details').summernote('code', data.details);
                    $('#barangay_id').val(data.barangay_id);
                    $('#date_aging').val(data.date_aging);
                    if (data.type == 'Post')
                    {
                        $('.details').removeClass('hidden');
                        $('.what').addClass('hidden');
                        // $('.when').addClass('hidden');
                        $('.where').addClass('hidden');
                        $('#what').removeAttr('required','required');
                        // $('#when').removeAttr('required','required');
                        $('#where').removeAttr('required','required');
                    }
                    else 
                    {
                        $('.details').addClass('hidden');
                        $('.what').removeClass('hidden');
                        // $('.when').removeClass('hidden');
                        $('.where').removeClass('hidden');
                        $('#what').attr('required','required');
                        // $('#when').attr('required','required');
                        $('#where').attr('required','required');
                    }
                    $('.modal-title').html("<i class='fa fa-edit'></i> Update <?php echo $status;?>");
                    $('#id').val(id);
                    $('#action').html("<i class='fa fa-edit'></i> Update");
                    $('#action').val('content_update');
                    $('#btn_action').val("content_update");
                },error:function()
                {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong.'
                    });
                }
            })
        });
    
        $(document).on('submit','#forms', function(event){
            event.preventDefault();
            if ($('#type').val() == 'Post')
            {
                var details = $('#details').summernote('code');
                if($.trim(details) == '')
                {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp;Details is required.'
                    }); 
                    return;
                }
            }
            $('#action').attr('disabled','disabled');
            $.ajax({
                url:"action.php",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType:"json",
                success:function(data)
                {
                    $('#action').attr('disabled', false);
                    if (data.status == true)
                    {
                        $('#forms')[0].reset();
                        $('#addModal').modal('hide');
                        dataTable.ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: '&nbsp;'+data.message
                        });
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
    
        $(document).on('click', '.delete', function(){
            var id = $(this).attr('id');
            var btn_action = 'content_delete';
            Swal.fire({
                icon: 'question',
                title: 'Do you want to delete this?',
                showDenyButton: true,
                showCancelButton: true,
                showDenyButton: false,
                confirmButtonText: '<i class="fa fa-check-circle"></i> Yes',
                cancelButtonText: `<i class="fa fa-times-circle"></i> No`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{id:id, btn_action:btn_action},
                        dataType:"json",
                        success:function(data)
                        {
                            if (data.status == true)
                            {
                                Toast.fire({
                                    icon: 'success',
                                    title: '&nbsp;'+data.message
                                });  
                            }
                            else 
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: '&nbsp;'+data.message
                                }); 
                            }
                            dataTable.ajax.reload();
                        },error:function()
                        {
                            Toast.fire({
                                icon: 'error',
                                title: 'Something went wrong.'
                            });
                        }
                    })
                } 
                else if (result.isDenied) { }
            })
        });
    
        $(document).on('click', '.status', function(){
            var id = $(this).attr('id');
            var status = $(this).data("status");
            var btn_action = 'content_status';
            Swal.fire({
                icon: 'question',
                title: 'Do you want to change the status?',
                showDenyButton: true,
                showCancelButton: true,
                showDenyButton: false,
                confirmButtonText: '<i class="fa fa-check-circle"></i> Yes',
                cancelButtonText: `<i class="fa fa-times-circle"></i> No`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{id:id, status:status, btn_action:btn_action},
                        dataType:"json",
                        success:function(data)
                        {
                            if (data.status == true)
                            {
                                if (status == 'Active')
                                {
                                    Toast.fire({
                                        icon: 'error',
                                        title: '&nbsp;'+data.message
                                    }); 
                                }
                                else
                                {
                                    Toast.fire({
                                        icon: 'success',
                                        title: '&nbsp;'+data.message
                                    });  
                                }
                                dataTable.ajax.reload();
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
                            Toast.fire({
                                icon: 'error',
                                title: 'Something went wrong.'
                            });
                        }
                    })
                } 
                else if (result.isDenied) { }
            })
        });

        var dataTable = $("#datatables").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "processing":true,
            "serverSide":true,
            "ordering": false,
            "order":[],
            "ajax":{
                url:"fetch/health_care.php",
                type:"POST"
            },
            "columnDefs":[
                {
                "targets":[0],
                "orderable":false,
                },
            ],
            "pageLength": 10, 
        });

        $('#whens').datetimepicker({
            icons: {
                time: "fa fa-clock",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'MM-DD-YYYY hh:mm A',
        });

        $('#date_agings').datetimepicker({
            format: 'MM-DD-YYYY',
            minDate: moment(new Date()).add(0, 'years').startOf('day'),
        });

    });
</script>
</body>
</html>
