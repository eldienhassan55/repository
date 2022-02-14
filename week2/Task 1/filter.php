<?php

function clean($input , $flag = 0){

	$input = trim($input);

	if($flag  == 0){
	$input = filter_var ($input , FILTER_SANITIZE_STRING);

	}

	return $input;
}


?>