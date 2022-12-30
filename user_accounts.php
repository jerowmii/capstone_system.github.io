<?php

include('header.php');
$status = 'User Accounts';
include('sidebar.php');

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Accounts</h1>
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
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Usertype</th>
                                        <th>Status</th>
                                        <th>Date</th>
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
                            <label>Fullname:</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Usertype:</label>
                            <select class="form-control" name="user_type" id="user_type" required>
                                <option value="">-Please Select-</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Barangay:</label>
                            <select class="form-control" name="barangay" id="barangay" disabled>
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
                        <div class="form-group col-12 col-md-6">
                            <label>Username:</label>
                            <input type="text" name="username" id="username" class="form-control" required />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label>Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
    $(function () {     
        
        $('#user_type').change(function(){
            if (this.value == 'Staff')
            {
                $('#barangay').removeAttr('disabled','disabled').attr('required','required');
            }
            else
            {
                $('#barangay').attr('disabled','disabled').removeAttr('required','required');
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
            $('.modal-title').html("<i class='fa fa-plus-circle'></i> Create User");
            $('#action').val('user_add');
            $('#action').html("<i class='fa fa-plus-circle '></i> Create");
            $('#btn_action').val('user_add');
            $('#password').attr('required','required');
            $('#barangay').attr('disabled','disabled').removeAttr('required','required');
        });
    
        $(document).on('click', '.update', function(){
            var id = $(this).attr("id");
            var btn_action = 'user_fetch';
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                dataType:"json",
                success:function(data)
                {
                    $('#addModal').modal('show');
                    $('#username').val(data.username);
                    $('#user_type').val(data.user_type);
                    $('#fullname').val(data.fullname);
                    $('#barangay').val(data.barangay);
                    if (data.user_type == 'Staff')
                    {
                        $('#barangay').removeAttr('disabled','disabled').attr('required','required');
                    }
                    else
                    {
                        $('#barangay').attr('disabled','disabled').removeAttr('required','required');
                    }
                    $('.modal-title').html("<i class='fa fa-edit'></i> Update User");
                    $('#id').val(id);
                    $('#action').html("<i class='fa fa-edit'></i> Update");
                    $('#action').val('user_update');
                    $('#btn_action').val("user_update");
                    $('#password').removeAttr('required','required');
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
            var btn_action = 'user_delete';
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
            var btn_action = 'user_status';
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
                url:"fetch/user_accounts.php",
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

    });
</script>
</body>
</html>
