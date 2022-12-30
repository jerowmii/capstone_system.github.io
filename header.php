<?php

include('config.php');

if(!isset($_SESSION["user_type"]))
{
  header("location:login.php");
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

    <!-- daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
    <style>
        .hidden {
            display: none;
        }
        /* active color */
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, 
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active
        {
            background-color: #007bff;
            color: #fff;
        }
        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active
        {
            background-color: #007bff;
            color: #fff;
        }
        /* inactive color */
        [class*=sidebar-dark-] .sidebar a, 
        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link  {
            color: #000;
        }
        /* inactive hover */
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link:hover, 
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link:hover,
        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:hover,
        [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link,
        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover
        {
            background-color: #007bff;
            color: #fff;
        }
        /* sidebar color */
        /* [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus, */
        [class*=sidebar-dark-] 
        {
            background-color: #ffc107; 
            color: #000;
        }
        /* 007bff */
        
        .image-upload > input {
            visibility:hidden;
            width: 0;
            height: 0;
            border-radius: 100;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini ">
<div class="wrapper">
    <!-- Navbar sidebar-collapse-->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->