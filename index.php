<?php

include('config.php');

if ($connect == null)
{
  echo "Create a database with a name 'pms' then reload this page.";
  return;
}
else 
{
  if (isset($_SESSION['user_type']))
  {
    header("location:dashboard.php");
  }
  else
  {
    header("location:login.php");
  }
}

?>