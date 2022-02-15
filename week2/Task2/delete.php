<?php

require './conection.php';

$id = $_GET['id'];

$sql = "delete from todo where id =$id";

$op  = mysqli_query($con,$sql);

if($op){

 	$Message = 'row removed';

}else{

	$Message = 'error try again';
}

$_SESSION['Message'] = $Message;

header("location: index.php");

?>