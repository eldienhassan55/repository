<?php

if($_SERVER['REQUEST_METHOD'] =='POST'){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$url = $_POST['url'];

$nameErrors = [];

if(empty($name)){

	$nameErrors ['name'] = 'Required Field';
}

if(empty($email)){

	$nameErrors ['email'] = 'Required Field';

}elseif(FILTER_VAR($email,FILTER_VALIDATE_EMAIL)){

	$nameErrors ['email'] = 'invalid email';
}

if(empty($password)){

	$nameErrors ['password'] = 'Required Field';
}elseif(strlen($password) <= 6 ){

	$nameErrors  ['password'] ="Length you must enter  = 6 chars";
}

if(empty($address)){

	$nameErrors['address'] = 'Required Field';
} elseif(strlen($address) <= 10){

		$nameErrors['address'] = 'lenth you must enter = 10 chars';
}

if(empty($url)){

	$nameErrors['url'] ='Required Field';

}elseif(FILTER_VAR($url,FILTER_VALIDATE_URL)){

	$nameErrors['url'] = "invalid url";
}

if(count($nameErrors ) > 0){

	foreach($nameErrors as $key => $value){

		echo " * " . $key . '||' .$value.'</br>';
	}

}else{

	echo "valid data";
}

}


?>



<html>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
password: <input type="password" name="password"><br>
address: <input type="text" name="address"><br>
linkedin url: <input type=url name="url"><br>
<input type="submit">
</form>

</body>
</html>