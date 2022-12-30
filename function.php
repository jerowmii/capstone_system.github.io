<?php

function fetch_row($connect, $table, $conditions) // fetch a single row so use  implode(",",$result) to get all string
{
    $query = "SELECT * FROM $table WHERE $conditions ";
	$statement = $connect->prepare($query);
	$statement->execute();
    $result = $statement->fetch();
	return $result;
}

function fetch_all($connect, $table, $conditions)
{
    $query = "SELECT * FROM $table $conditions ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function get_total_count($connect, $table, $conditions)
{
    if ($conditions != ''){
        $query = "SELECT * FROM $table WHERE $conditions ";
    }
    else{
        $query = "SELECT * FROM $table  ";
    }
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function create($connect, $table, $column, $values)
{
    $query = "INSERT INTO $table ($column) VALUES ($values) ";	
    $statement = $connect->prepare($query);
    $result = $statement->execute();
    if(isset($result))
    {
        return true;
    }
    return false;
}

function update($connect, $table, $values, $conditions)
{
    $query = "UPDATE $table SET $values WHERE $conditions ";
    $statement = $connect->prepare($query);
    $result = $statement->execute();
    if(isset($result))
    {
        return true;
    }
    return false;
}

function delete($connect, $table, $conditions)
{
    $query = "DELETE FROM $table WHERE $conditions ";
    $statement = $connect->prepare($query);
    $result = $statement->execute();
    if(isset($result))
    {
        return true;
    }
    return false;
}

function upload_image($image, $name, $path) 
{
    if (!file_exists($path)) {
        mkdir($path);
    }
    if (strpos($name, '.png') || strpos($name, '.jpg') || strpos($name, '.jpeg'))
    {
        $avatar = $path . rand(9999,999999).'.png';
        if(!move_uploaded_file($image["tmp_name"], $avatar))
        {
            $output['status'] = false;
            $output['message'] = "Can't upload image.";
            return $output;
        }
        else
        {
            $output['status'] = true;
            $output['message'] = $avatar;
            return $output;
        }
    }
    else
    {
        $output['status'] = false;
        $output['message'] = 'Invalid image type.';
        return $output;
    }
}

?>