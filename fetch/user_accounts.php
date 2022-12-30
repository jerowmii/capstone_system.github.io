<?php

//fetch_data.php

include('../config.php');

$query = '';

$output = array();

$query .= "SELECT * FROM $USER_TABLE WHERE user_type IN ('Admin','Staff') AND ";

if(isset($_POST["search"]["value"]))
{
	$query .= '(username LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR fullname LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR user_type LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR barangay LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR status LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR date_created LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}

if($_POST['length'] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row['fullname'];
	$sub_array[] = $row['username'];
	$sub_array[] = $row['user_type'] == 'Staff' ? $row['user_type'].' - '.$row['barangay'] : $row['user_type'];
	
	if($row['status'] == 'Active')
	{
		$sub_array[] = '<button type="button" name="status" id="'.$row["id"].'" class="btn btn-success elevation-3 status " data-status="'.$row["status"].'" ><i class="fa fa-info-circle"></i> </a> Active</button>';
	}
	else
	{
		$sub_array[] = '<button type="button" name="status" id="'.$row["id"].'" class="btn btn-danger elevation-3 status " data-status="'.$row["status"].'" ><i class="fa fa-info-circle"></i> </a> Inactive</button>';
	}
	$sub_array[] = $row['date_created'];
	if ($_SESSION["user_type"] == 'Superadmin')
	{
		$sub_array[] = ' &nbsp; <a class="btn btn-primary update elevation-3" href="#" name="update" id="'.$row["id"].'" data-toggle="tooltip" data-placement="top" title="Edit">
			<i class="fas fa-edit"></i> Update
		</a>
		<a class="btn btn-danger delete elevation-3" href="#" name="delete" id="'.$row["id"].'" data-toggle="tooltip" data-placement="top" title="Delete">
			<i class="fas fa-trash"></i> Delete
		</a>';
	}
	else
	{
		$sub_array[] = ' &nbsp; <a class="btn btn-primary update elevation-3" href="#" name="update" id="'.$row["id"].'" data-toggle="tooltip" data-placement="top" title="Edit">
			<i class="fas fa-edit"></i> Edit
		</a>';
	}

	$data[] = $sub_array;
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect, $USER_TABLE),
	"data"				=>	$data
);

function get_total_all_records($connect, $USER_TABLE)
{
	$statement = $connect->prepare("SELECT * FROM $USER_TABLE WHERE user_type IN ('Admin','Staff') ");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>