<?php

require './conection.php';
require 'filter.php';



if($_SERVER['REQUEST_METHOD'] == "POST"){
 
   $title     = clean($_POST['title']);
   $content   = clean($_POST['content']);
   $StartDate = clean($_POST['startdate'],1);
   $EndDate   = clean($_POST['Enddate'],1);

   $Errors = [];

   if(empty($title)){

	$Errors['title'] = 'required';

   }

   if(empty($content)){
 
	$Errors['content'] = 'required';

   }

   if(empty($StartDate)){

    $Errors['startdate'] = 'required StartDate';

   }

   if(empty($EndDate)){

    $Errors['Enddate'] = 'required EndDate';

   }

   if(empty($_FILES['image']['name'])){

     $Errors['image'] = "field required"; 


   }else{
      
	$imgName = $_FILES['image']['name'];
	$imgTemp = $_FILES['image']['tmp_name'];
	$imgType = $_FILES['image']['type'];

	$nameArray    = explode('.' , $imgName);
	$imgExtension = strtolower(end($nameArray));
	$imgfinalName = time() . rand() . ' . ' .$imgExtension;
	$allowedExt   = ['jpg' , 'png' ,'txt'];
	
	if(!in_array($imgExtension , $allowedExt)){

		$Errors['image'] = "Not Allowed Extension";

    	} 

	

   }


   if(count($Errors) > 0 ){

	  
	   foreach($Errors as $key => $value){

		echo " * " . $key . ' . ' . $value ."<br>" ;
	   }


	   
   }else{


	$dispath = 'uploads/' . $imgfinalName; 

         if(move_uploaded_file($imgTemp , $dispath));




	$sql = " insert into todo (title,content,image,startdate,Enddate)
    values ('$title' ,'$content' ,'$imgfinalName' , '$StartDate' , '$EndDate')";

     $op = mysqli_query($con,$sql); 

    if($op){
  
		 echo 'row inserted';
		 
		 header("location:index.php");
  
     }else{

		echo 'error try again'. mysqli_error($con);
	 }

   }

   mysqli_close($con);

}



   

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simple Todo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Simple Todo</h2>
      
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"  enctype = "multipart/form-data" >

            <div class="form-group">
                <label for="exampleInputName">title</label>
                <input type="text" class="form-control"  name="title" placeholder="title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">content</label>
                <input type="text"  class="form-control"  name="content" placeholder="content">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">image</label>
                <input type="file" class="form-control" name="image" >
            </div>

			<div class="form-group">
                <label for="exampleInputPassword">StartDate</label>
                <input type="date" class="form-control"  name="startdate" >
            </div>

			<div class="form-group">
                <label for="exampleInputPassword">EndDate</label>
                <input type="date" class="form-control"  name="Enddate" >
            </div>




            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <br>


    


</body>






</html>