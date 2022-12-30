<?php

//fetch_data.php

include('../config.php');

$query = '';

$output = array();

$query .= "SELECT * FROM $CONTENT_TABLE WHERE category = 'Events & Announcements' AND ";
if ($_SESSION["user_type"] == 'Staff')
{
	$query .= "  barangay_id = '".$_SESSION["barangay"]."' AND ";
}

if(isset($_POST["search"]["value"]))
{
	$query .= '(type LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR details LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR what_format LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR when_format LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR where_format LIKE "%'.$_POST["search"]["value"].'%" ';
	if ($_SESSION["user_type"] !== 'Staff')
	{
		$query .= 'OR barangay_id LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR created_by LIKE "%'.$_POST["search"]["value"].'%" ';
	}
	$query .= 'OR date_aging LIKE "%'.$_POST["search"]["value"].'%" ';
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
	$sub_array[] = $row['type'];
	if ($row['type'] == 'Post')
	{
		$sub_array[] = $row['details'];
	}
	else
	{
		$sub_array[] = '<b>WHAT:</b> '.$row['what_format'].'<br><b>WHERE:</b> '.$row['where_format'];
	}

	$sub_array[] = $row['when_format'];

	if ($_SESSION["user_type"] !== 'Staff')
	{
		$sub_array[] = $row['barangay_id'];
	}
	
	$sub_array[] = $row['date_aging'];
	
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
	"recordsFiltered" 	=> 	get_total_all_records($connect, $CONTENT_TABLE),
	"data"				=>	$data
);

function get_total_all_records($connect, $CONTENT_TABLE)
{
	$query = '';
	if ($_SESSION["user_type"] == 'Staff')
	{
		$query = " AND barangay_id = '".$_SESSION["barangay"]."' ";
	}
	$statement = $connect->prepare("SELECT * FROM $CONTENT_TABLE WHERE category = 'Events & Announcements' $query ");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>