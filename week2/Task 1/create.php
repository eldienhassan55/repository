<?php



require './filter.php';
require './connection.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){


	if(!empty($_FILES['image']['name'])){

		$imgName   =  $_FILES['image']['name'];
	    $imgTemp   =  $_FILES['image']['tmp_name'];
		$imgType   =  $_FILES['image']['type'];

		$nameArray = explode('.' , $imgName);
     	$imgExtensions = strtolower(end($nameArray));

		$allowedExt = ['png' , 'jpg' , 'txt'];
		if(in_array($imgExtensions , $allowedExt)){

          $dispath = 'images/'.$imgName;
		  
		 move_uploaded_file($imgTemp , $dispath);
	
		}else{

			echo "invalid extension";
		}
 

	}else {

		echo "Image Required";
	}



	$title   = clean($_POST['title']);
	$content = clean($_POST['content']);
	$date    =clean($_POST['date']);

	$Errors = [];


	if(empty($title)){

        $Errors['title'] = "Required";	
    }
    
	if(empty($content)){

		$Errors['content'] = 'Required';
	} elseif(strlen($content) < 50){

		$Errors['content'] = 'length must be >= 50';
	}

	if(empty($date)){

		$Errors['date'] = 'required';
	}
	

	if(count($Errors) > 0 ){

		foreach($Errors as $key => $value){

         echo "<br> " . $key . ":" . $value ;

		}
	}else{

		$sql = " insert into crud (title , content , date , image) values ('$title'	 , '$content' , '$date' , '$imgName')";
		$op  = mysqli_query($con,$sql);
		
		if($op){

			echo 'row inserted';

		}else{

			echo 'Error try again' . mysqli_error($con);
		}
	}
	mysqli_close($con);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Blog</h2>
      
        <form action="<?php echo htmlspecialchars  ($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data"  >

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="title" placeholder="Enter Title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control"  name="content" placeholder="Enter Content">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file"   name="image" >
            </div>

			<div class="form-group">
                <label for="exampleInputPassword">date</label>
                <input type="date"   name="date" >
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>






</body>






</html>