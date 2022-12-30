    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="assets/muntinlupa-logo.png" alt="Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-bold text-dark">Muntinlupa City</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->

            <nav class="mt-2">
                <ul class="nav nav-child-indent nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link <?php echo $status == 'Dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <!-- <li class="nav-item <?php echo $status == 'Events & Announcements' 
                        || $status == 'Emergency Notices' 
                        || $status == 'Health & Care' 
                        || $status == 'Advertisements' 
                        || $status == 'Sports' 
                        || $status == 'SK Infomation' 
                        ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?php echo $status == 'Events & Announcements' 
                            || $status == 'Emergency Notices' 
                            || $status == 'Health & Care' 
                            || $status == 'Advertisements' 
                            || $status == 'Sports' 
                            || $status == 'SK Infomation' 
                            ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p> Content <i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="events.php" class="nav-link <?php echo $status == 'Events & Announcements' ? 'active' : '' ?>">
                                    <i class="fa fa-calendar-check nav-icon"></i>
                                    <p>Events & Ann.s</p>
                                </a>    
                            </li>
                            <li class="nav-item">
                                <a href="emergency_notices.php" class="nav-link <?php echo $status == 'Emergency Notices' ? 'active' : '' ?>">
                                    <i class="fa fa-exclamation-circle nav-icon"></i>
                                    <p>Emergency Notices</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="health_care.php" class="nav-link <?php echo $status == 'Health & Care' ? 'active' : '' ?>">
                                    <i class="fa fa-heart nav-icon"></i>
                                    <p>Health & Care</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="advertisements.php" class="nav-link <?php echo $status == 'Advertisements' ? 'active' : '' ?>">
                                    <i class="fa fa-clipboard nav-icon"></i>
                                    <p>Advertisements</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="sports.php" class="nav-link <?php echo $status == 'Sports' ? 'active' : '' ?>">
                                    <i class="fa fa-medal nav-icon"></i>
                                    <p>Sports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="sk_information.php" class="nav-link <?php echo $status == 'SK Infomation' ? 'active' : '' ?>">
                                    <i class="fa fa-info-circle nav-icon"></i>
                                    <p>SK Infomation</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    
                    <li class="nav-item">
                        <a href="events.php" class="nav-link <?php echo $status == 'Events & Announcements' ? 'active' : '' ?>">
                            <i class="fa fa-calendar-check nav-icon"></i>
                            <p>Events & Ann.s</p>
                        </a>    
                    </li>
                    <li class="nav-item">
                        <a href="emergency_notices.php" class="nav-link <?php echo $status == 'Emergency Notices' ? 'active' : '' ?>">
                            <i class="fa fa-exclamation-circle nav-icon"></i>
                            <p>Emergency Notices</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="health_care.php" class="nav-link <?php echo $status == 'Health & Care' ? 'active' : '' ?>">
                            <i class="fa fa-heart nav-icon"></i>
                            <p>Health & Care</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="advertisements.php" class="nav-link <?php echo $status == 'Advertisements' ? 'active' : '' ?>">
                            <i class="fa fa-clipboard nav-icon"></i>
                            <p>Advertisements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sports.php" class="nav-link <?php echo $status == 'Sports' ? 'active' : '' ?>">
                            <i class="fa fa-medal nav-icon"></i>
                            <p>Sports</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sk_information.php" class="nav-link <?php echo $status == 'SK Infomation' ? 'active' : '' ?>">
                            <i class="fa fa-info-circle nav-icon"></i>
                            <p>SK Infomation</p>
                        </a>
                    </li>

                    <?php if ($_SESSION["user_type"] !== 'Staff') { ?>
                        <li class="nav-item">
                            <a href="user_accounts.php" class="nav-link <?php echo $status == 'User Accounts' ? 'active' : '' ?>">
                                <i class="nav-icon fa fa-users"></i>
                                <p>User Accounts</p>
                            </a>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon fa fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->

        </div>
        <!-- /.sidebar -->
    </aside>