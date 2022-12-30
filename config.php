<?php 
    try
    {
        define('DB_HOST','localhost');
        define('DB_USER','root');
        define('DB_PASS','');
        define('DB_NAME','cms');
        date_default_timezone_set('Asia/Manila');
        
        $conn_pdo = new PDO("mysql:host=".DB_HOST, DB_USER, DB_PASS);
        // set the PDO error mode to exception
        $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn_pdo->query("CREATE DATABASE IF NOT EXISTS ".DB_NAME);

        $connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS); 
        session_start();
        
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        include('function.php');

        $USER_TABLE = 'user_account';
        $USER_COLUMN = 'fullname, username, password, user_type, barangay, status, date_created';
        $query = "SHOW TABLES LIKE '$USER_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $USER_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `fullname` VARCHAR(255) DEFAULT NULL,
                `username` VARCHAR(255) DEFAULT NULL,
                `password` VARCHAR(255) DEFAULT NULL,
                `user_type` VARCHAR(255) DEFAULT NULL,
                `barangay` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
            $password = password_hash('1', PASSWORD_DEFAULT);
            create($connect, $USER_TABLE,$USER_COLUMN, "'Superadmin', 'Superadmin', '".$password."' , 'Superadmin', '', 'Active','".date("m-d-Y h:i A")."'");
        }

        $CONTENT_TABLE = 'contents';
        $query = "SHOW TABLES LIKE '$CONTENT_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $CONTENT_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `category` VARCHAR(255) DEFAULT NULL,
                `type` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `details` TEXT DEFAULT NULL,
                `what_format` VARCHAR(255) DEFAULT NULL,
                `when_format` VARCHAR(255) DEFAULT NULL,
                `where_format` VARCHAR(255) DEFAULT NULL,
                `barangay_id` VARCHAR(255) DEFAULT NULL,
                `created_by` VARCHAR(255) DEFAULT NULL,
                `date_aging` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
        }

        $EA_TABLE = 'events_announcement';
        $query = "SHOW TABLES LIKE '$EA_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $EA_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `type` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `details` TEXT DEFAULT NULL,
                `what_format` VARCHAR(255) DEFAULT NULL,
                `when_format` VARCHAR(255) DEFAULT NULL,
                `where_format` VARCHAR(255) DEFAULT NULL,
                `barangay_id` VARCHAR(255) DEFAULT NULL,
                `created_by` VARCHAR(255) DEFAULT NULL,
                `date_aging` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
        }

        $EN_TABLE = 'emergency_notices';
        $query = "SHOW TABLES LIKE '$EN_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $EN_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `type` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `details` TEXT DEFAULT NULL,
                `what_format` VARCHAR(255) DEFAULT NULL,
                `when_format` VARCHAR(255) DEFAULT NULL,
                `where_format` VARCHAR(255) DEFAULT NULL,
                `barangay_id` VARCHAR(255) DEFAULT NULL,
                `created_by` VARCHAR(255) DEFAULT NULL,
                `date_aging` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
        }

        $HC_TABLE = 'health_care';
        $query = "SHOW TABLES LIKE '$HC_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $HC_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `type` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `details` TEXT DEFAULT NULL,
                `what_format` VARCHAR(255) DEFAULT NULL,
                `when_format` VARCHAR(255) DEFAULT NULL,
                `where_format` VARCHAR(255) DEFAULT NULL,
                `barangay_id` VARCHAR(255) DEFAULT NULL,
                `created_by` VARCHAR(255) DEFAULT NULL,
                `date_aging` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
        }

        $ADS_TABLE = 'advertisements';
        $query = "SHOW TABLES LIKE '$ADS_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $ADS_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `type` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `details` TEXT DEFAULT NULL,
                `what_format` VARCHAR(255) DEFAULT NULL,
                `when_format` VARCHAR(255) DEFAULT NULL,
                `where_format` VARCHAR(255) DEFAULT NULL,
                `barangay_id` VARCHAR(255) DEFAULT NULL,
                `created_by` VARCHAR(255) DEFAULT NULL,
                `date_aging` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
        }

        $SPORTS_TABLE = 'sports';
        $query = "SHOW TABLES LIKE '$SPORTS_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $SPORTS_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `type` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `details` TEXT DEFAULT NULL,
                `what_format` VARCHAR(255) DEFAULT NULL,
                `when_format` VARCHAR(255) DEFAULT NULL,
                `where_format` VARCHAR(255) DEFAULT NULL,
                `barangay_id` VARCHAR(255) DEFAULT NULL,
                `created_by` VARCHAR(255) DEFAULT NULL,
                `date_aging` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
        }

        $SKI_TABLE = 'sk_information';
        $query = "SHOW TABLES LIKE '$SKI_TABLE'";
        $statement = $connect->prepare($query);
        $statement->execute();
        if ($statement->rowCount() == 0)
        {
            $create = "CREATE TABLE $SKI_TABLE(
                `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
                `type` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `details` TEXT DEFAULT NULL,
                `what_format` VARCHAR(255) DEFAULT NULL,
                `when_format` VARCHAR(255) DEFAULT NULL,
                `where_format` VARCHAR(255) DEFAULT NULL,
                `barangay_id` VARCHAR(255) DEFAULT NULL,
                `created_by` VARCHAR(255) DEFAULT NULL,
                `date_aging` VARCHAR(255) DEFAULT NULL,
                `status` VARCHAR(255) DEFAULT NULL,
                `date_created` VARCHAR(255) DEFAULT NULL,
                INDEX (`id`)
            );";
            $connect->exec($create);
        }
    } 
    catch(PDOException $err)
    {   
        $connect = null;
        return;
    }
    
?>