<?php

//action.php

include('config.php');

if(isset($_POST['btn_action']))
{
    if ($_POST["btn_action"] === 'sign_in')
    {
        $result = fetch_row($connect, $USER_TABLE, "username = '".$_POST["username"]."' ");
        $count = get_total_count($connect, $USER_TABLE, "username = '".$_POST["username"]."' ");
        if($count > 0)
        {
            $result = fetch_row($connect, $USER_TABLE, "username = '".$_POST["username"]."' ");
            if($result['status'] == 'Active')
            {
                if(password_verify($_POST["password"], $result["password"]))
                {
                    $_SESSION['user_type']  = $result['user_type'];
                    $_SESSION['user_id']    = $result['id'];
                    $output['status'] = true;
                    $_SESSION["barangay"]   = $result['barangay'];
                }
                else
                {
                    $output['status'] = false;
                    $output['message'] = 'Wrong Password!';
                }
            }
            else
            {
                $output['status'] = false;
                $output['message'] = 'Your account is inactive, please contact your administrator!';
            }
        }
        else
        {
            $output['status'] = false;
            $output['message'] = 'Invalid Account!';
        }
		echo json_encode($output);
    }

	if($_POST['btn_action'] == 'user_total')
	{
        $output['total'] = get_total_count($connect, $USER_TABLE, '');
        $output['active'] = get_total_count($connect, $USER_TABLE, "status = 'Active'");
        $output['inactive'] = get_total_count($connect, $USER_TABLE, "status = 'Inactive'");
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'user_add')
	{
        $count = get_total_count($connect, $USER_TABLE, 
        "fullname = '".trim($_POST["fullname"])."' AND username = '".trim($_POST["username"])."' AND user_type = '".trim($_POST["user_type"])."' ");
        if ($count > 0)
        {
            $output['status'] = false;
            $output['message'] = 'Account already exist.';
        }
        else 
        {
            $barangay = trim($_POST["user_type"]) == 'Staff' ? trim($_POST["barangay"]) : '';
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $create = create($connect, $USER_TABLE, $USER_COLUMN, 
            "'".trim($_POST["fullname"])."','".trim($_POST["username"])."','".$password."', '".trim($_POST["user_type"])."','".$barangay."',  'Active', '".date("m-d-Y h:i A")."'");
            if ($create == true)
            {
                $output['status'] = true;
                $output['message'] = 'Successfully created.';
            }
            else 
            {
                $output['status'] = false;
                $output['message'] = 'Unsuccessfully created.';
            }
        }
		echo json_encode($output);
	}
	
	if($_POST['btn_action'] == 'user_fetch')
	{
        $result = fetch_row($connect, $USER_TABLE, " id = ".$_POST["id"]." ");
        $output['username'] = $result['username'];
        $output['user_type'] = $result['user_type'];
        $output['fullname'] = $result['fullname'];
        $output['barangay'] = $result['barangay'];
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'user_update')
	{
        $barangay = trim($_POST["user_type"]) == 'Staff' ? trim($_POST["barangay"]) : '';
        if (empty($_POST["password"]))
        {
            $update = update($connect, $USER_TABLE, 
            "fullname = '".trim($_POST["fullname"])."', 
            username = '".trim($_POST["username"])."', 
            user_type = '".trim($_POST["user_type"])."', 
            barangay = '".$barangay."' " , 
            "id = '".$_POST['id']."' ");
        }
        else
        {
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $update = update($connect, $USER_TABLE, 
            "fullname = '".trim($_POST["fullname"])."', 
            username = '".trim($_POST["username"])."', 
            password = '".$password."', 
            user_type = '".trim($_POST["user_type"])."'
            barangay = '".$barangay."' " , 
            "id = '".$_POST['id']."' ");
        }
        if ($update == true)
        {
            $output['status'] = true;
            $output['message'] = 'Successfully updated.';
        }
        else 
        {
            $output['status'] = false;
            $output['message'] = 'Unsuccessfully updated.';
        }
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'user_status')
	{
		$status = 'Active';
		if($_POST['status'] == 'Active')
		{
			$status = 'Inactive';	
		}
        $update = update($connect, $USER_TABLE, "status = '".$status."' " , "id = '".$_POST['id']."' ");
        if ($update == true)
        {
            $output['status'] = true;
            $output['message'] = 'Status change to '. $status .'.';
        }
        else 
        {
            $output['status'] = false;
            $output['message'] = 'Status cannot be changed.';
        }
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'user_delete')
	{
        $delete = delete($connect, $USER_TABLE, "id = ".$_POST['id']." ");
        if ($delete == true)
        {
            $output['status'] = true;
            $output['message'] = 'Successfully deleted.';
        }
        else 
        {
            $output['status'] = false;
            $output['message'] = 'Unsuccessfully deleted';
        }
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'barangay')
	{
        $output['status'] = true;
        $output['brgy'] = $_POST["brgy"];
        $_SESSION['brgy'] = $_POST["brgy"];
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'load_events')
	{
        $table = '
        <table class="table">
            <thead>
                <tr>
                    <th>Barangay</th>
                    <th>Type</th>
                    <th>Details</th>
                    <th>When</th>
                </tr>
            </thead><tbody>';
        $result = fetch_all($connect, $CONTENT_TABLE, " WHERE SUBSTR(when_format, 1, 10) = '".str_replace("/","-",$_POST["day"])."' ");
        foreach($result as $row)
        {
            if ($row['type'] == 'Post')
            {
                $content = $row['details'];
            }
            else
            {
                $content = '<b>WHAT:</b> '.$row['what_format'].'<br><b>WHERE:</b> '.$row['where_format'];
            }
            $table .= '
                <tr>
                    <td>'.$row["barangay_id"].'</td>
                    <td>'.$row["category"].'</td>
                    <td>'.$content.'</td>
                    <td>'.$row["when_format"].'</td>
                </tr>';
        }
                $table .= '
            </tbody>
        </table>';
        $output['table'] = $table;
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'content_add')
	{
        if ($_FILES["image"]["size"] !== 0)
        {
            $result = upload_image($_FILES["image"], $_FILES["image"]["name"], 'assets/images/');
            if ($result['status'] == false){
                $output['status'] = false;
                $output['message'] = $result['message'];
            }
            else {
                $brgy = $_SESSION["user_type"] !== 'Staff' ? trim($_POST["barangay_id"]) : $_SESSION["barangay"] ;
                $image = $result['message'];
                if (trim($_POST["type"]) == 'Format')
                {
                    $create = create($connect, $CONTENT_TABLE, "category, type, image, what_format, when_format, where_format, barangay_id, created_by, date_aging, status, date_created", 
                    "'".$_POST["category"]."',
                    '".trim($_POST["type"])."', 
                    '".$image."', 
                    '".str_replace("'","\'",trim($_POST["what"]))."',
                    '".trim($_POST["when"])."',
                    '".str_replace("'","\'",trim($_POST["where"]))."',
                    '".$brgy."',
                    '".$_SESSION['user_id']."',  
                    '".trim($_POST["date_aging"])."', 
                    'Active', 
                    '".date("m-d-Y h:i A")."'");
                }
                else
                {
                    $create = create($connect, $CONTENT_TABLE, "category, type, image, details, when_format, barangay_id, created_by, date_aging, status, date_created", 
                    "'".$_POST["category"]."',
                    '".trim($_POST["type"])."',
                    '".$image."', 
                    '".str_replace("'","\'",trim($_POST["details"]))."',
                    '".trim($_POST["when"])."',
                    '".$brgy."',
                    '".$_SESSION['user_id']."',  
                    '".trim($_POST["date_aging"])."', 
                    'Active', 
                    '".date("m-d-Y h:i A")."'");
                }
                if ($create == true)
                {
                    $output['status'] = true;
                    $output['message'] = 'Successfully created.';
                }
                else 
                {
                    $output['status'] = false;
                    $output['message'] = 'Unsuccessfully created.';
                }
            }
        }
        else 
        {
            $output['status'] = false;
            $output['message'] = 'Please upload an image.';
        }
		echo json_encode($output);
	}
	
	if($_POST['btn_action'] == 'content_fetch')
	{
        $result = fetch_row($connect, $CONTENT_TABLE, " id = ".$_POST["id"]." ");
        $output['image'] = $result['image'];
        $output['type'] = $result['type'];
        $output['what'] = $result['what_format'];
        $output['when'] = $result['when_format'];
        $output['where'] = $result['where_format'];
        $output['details'] = $result['details'];
        $output['barangay_id'] = $result['barangay_id'];
        $output['date_aging'] = $result['date_aging'];
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'content_update')
	{
        $output['status'] = true;
        $image = $_POST["image"];
        if ($_FILES["image"]["size"] !== 0)
        {
            $result = upload_image($_FILES["image"], $_FILES["image"]["name"], 'assets/images/');
            if ($result['status'] == false){
                $output['status'] = false;
                $output['message'] = $result['message'];
            }
            else
            {
                $image = $result['message'];
            }
        }
        if ($output['status'] == true)
        {
            $brgy = $_SESSION["user_type"] !== 'Staff' ? trim($_POST["barangay_id"]) : $_SESSION["barangay"] ;
            if (trim($_POST["type"]) == 'Format')
            {
                $update = update($connect, $CONTENT_TABLE, 
                    "type = '".trim($_POST["type"])."', 
                    image = '".$image."', 
                    what_format = '".str_replace("'","\'",trim($_POST["what"]))."', 
                    when_format = '".trim($_POST["when"])."', 
                    where_format = '".str_replace("'","\'",trim($_POST["where"]))."', 
                    barangay_id = '".$brgy."', 
                    date_aging = '".trim($_POST["date_aging"])."' " , 
                    "id = '".$_POST['id']."' ");
            }
            else
            {
                $update = update($connect, $CONTENT_TABLE, 
                    "type = '".trim($_POST["type"])."', 
                    image = '".$image."', 
                    details = '".str_replace("'","\'",trim($_POST["details"]))."', 
                    when_format = '".trim($_POST["when"])."', 
                    barangay_id = '".$brgy."', 
                    date_aging = '".trim($_POST["date_aging"])."' " , 
                    "id = '".$_POST['id']."' ");
            }
            if ($update == true)
            {
                $output['status'] = true;
                $output['message'] = 'Successfully updated.';
            }
            else 
            {
                $output['status'] = false;
                $output['message'] = 'Unsuccessfully updated.';
            }
        }
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'content_status')
	{
		$status = 'Active';
		if($_POST['status'] == 'Active')
		{
			$status = 'Inactive';	
		}
        $update = update($connect, $CONTENT_TABLE, "status = '".$status."' " , "id = '".$_POST['id']."' ");
        if ($update == true)
        {
            $output['status'] = true;
            $output['message'] = 'Status change to '. $status .'.';
        }
        else 
        {
            $output['status'] = false;
            $output['message'] = 'Status cannot be changed.';
        }
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'content_delete')
	{
        $delete = delete($connect, $CONTENT_TABLE, "id = ".$_POST['id']." ");
        if ($delete == true)
        {
            $output['status'] = true;
            $output['message'] = 'Successfully deleted.';
        }
        else 
        {
            $output['status'] = false;
            $output['message'] = 'Unsuccessfully deleted';
        }
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'load_data')
    {
        $events=array();
        $emergency=array();
        $health=array();
        $ads=array();
        $sports=array();
        $ski=array();

        $output['ayala'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Ayala Alabang' ");
        $output['alabang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Alabang' ");
        $output['bayanan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Bayanan' ");
        $output['buli'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Buli' ");
        $output['cupang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Cupang' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Putatan' ");
        $output['poblacion'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Poblacion' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Sucat' ");
        $output['sucat'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Events & Announcements' AND barangay_id = 'Tunasan' ");
        array_push($events, $output['ayala'], $output['alabang'], $output['bayanan'], $output['buli'], $output['cupang'], $output['putatan'], $output['poblacion'], $output['putatan'], $output['sucat'] );
        $output['events'] = $events;

        $output['ayala'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Ayala Alabang' ");
        $output['alabang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Alabang' ");
        $output['bayanan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Bayanan' ");
        $output['buli'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Buli' ");
        $output['cupang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Cupang' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Putatan' ");
        $output['poblacion'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Poblacion' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Sucat' ");
        $output['sucat'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Emergency Notices' AND barangay_id = 'Tunasan' ");
        array_push($emergency, $output['ayala'], $output['alabang'], $output['bayanan'], $output['buli'], $output['cupang'], $output['putatan'], $output['poblacion'], $output['putatan'], $output['sucat'] );
        $output['emergency'] = $emergency;

        $output['ayala'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Ayala Alabang' ");
        $output['alabang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Alabang' ");
        $output['bayanan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Bayanan' ");
        $output['buli'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Buli' ");
        $output['cupang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Cupang' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Putatan' ");
        $output['poblacion'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Poblacion' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Sucat' ");
        $output['sucat'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Health & Care' AND barangay_id = 'Tunasan' ");
        array_push($health, $output['ayala'], $output['alabang'], $output['bayanan'], $output['buli'], $output['cupang'], $output['putatan'], $output['poblacion'], $output['putatan'], $output['sucat'] );
        $output['health'] = $health;

        $output['ayala'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Ayala Alabang' ");
        $output['alabang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Alabang' ");
        $output['bayanan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Bayanan' ");
        $output['buli'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Buli' ");
        $output['cupang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Cupang' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Putatan' ");
        $output['poblacion'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Poblacion' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Sucat' ");
        $output['sucat'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Advertisements' AND barangay_id = 'Tunasan' ");
        array_push($ads, $output['ayala'], $output['alabang'], $output['bayanan'], $output['buli'], $output['cupang'], $output['putatan'], $output['poblacion'], $output['putatan'], $output['sucat'] );
        $output['ads'] = $ads;

        $output['ayala'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Ayala Alabang' ");
        $output['alabang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Alabang' ");
        $output['bayanan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Bayanan' ");
        $output['buli'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Buli' ");
        $output['cupang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Cupang' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Putatan' ");
        $output['poblacion'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Poblacion' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Sucat' ");
        $output['sucat'] = get_total_count($connect, $CONTENT_TABLE, "category = 'Sports' AND barangay_id = 'Tunasan' ");
        array_push($sports, $output['ayala'], $output['alabang'], $output['bayanan'], $output['buli'], $output['cupang'], $output['putatan'], $output['poblacion'], $output['putatan'], $output['sucat'] );
        $output['sports'] = $sports;

        $output['ayala'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Ayala Alabang' ");
        $output['alabang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Alabang' ");
        $output['bayanan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Bayanan' ");
        $output['buli'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Buli' ");
        $output['cupang'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Cupang' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Putatan' ");
        $output['poblacion'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Poblacion' ");
        $output['putatan'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Sucat' ");
        $output['sucat'] = get_total_count($connect, $CONTENT_TABLE, "category = 'SK Information' AND barangay_id = 'Tunasan' ");
        array_push($ski, $output['ayala'], $output['alabang'], $output['bayanan'], $output['buli'], $output['cupang'], $output['putatan'], $output['poblacion'], $output['putatan'], $output['sucat'] );
        $output['ski'] = $ski;

		echo json_encode($output);
    }

	if($_POST['btn_action'] == 'load_archive')
    {
        $table = '
        <table class="table">
            <thead>
                <tr>
                    <th>Barangay</th>
                    <th>Type</th>
                    <th>Details</th>
                    <th>When</th>
                </tr>
            </thead><tbody>';
        $result = fetch_all($connect, $CONTENT_TABLE, " WHERE SUBSTR(when_format, 7, 4) = '".$_POST["year"]."' ");
        foreach($result as $row)
        {
            if ($row['type'] == 'Post')
            {
                $content = $row['details'];
            }
            else
            {
                $content = '<b>WHAT:</b> '.$row['what_format'].'<br><b>WHERE:</b> '.$row['where_format'];
            }
            $table .= '
                <tr>
                    <td>'.$row["barangay_id"].'</td>
                    <td>'.$row["category"].'</td>
                    <td>'.$content.'</td>
                    <td>'.$row["when_format"].'</td>
                </tr>';
        }
                $table .= '
            </tbody>
        </table>';
        $output['table'] = $table;

		echo json_encode($output);
    }

}

?>