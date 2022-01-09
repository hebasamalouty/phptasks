<?php
function Clean($str){
    $str =htmlspecialchars($str);
    $str= trim($str);
    $str = stripslashes($str);
    return $str;
}

if($_SERVER['REQUEST_METHOD']=="POST"){
 $errors=[];
$BlogTitle=Clean($_POST['title']);
$Content=Clean($_POST['content']);

//Title is required
if(empty($BlogTitle)){
    $errors['BlogTitle']="Feild is required";
}
//Content is required and must be morethan 50 char
if(empty($Content)){
    $errors['Content']="Feild is required";
}
elseif(strlen($Content)<50){
    $errors['Content']="Content must be more than 50 characters";
}

//upload Image
if(!empty($_FILES['image']['name'])){
    $imgName     = $_FILES['image']['name'];
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imagSize    = $_FILES['image']['size'];
    $imgType     = $_FILES['image']['type'];
 
     $imgExtensionDetails = explode('.',$imgName);
     $imgExtension        = strtolower(end($imgExtensionDetails));
 
     $allowedExtensions   = ['png','jpg','gif'];
 
        if(in_array($imgExtension ,$allowedExtensions)){
            
           
         $finalName = rand().time().'.'.$imgExtension;
 
          $disPath = './Upload/'.$finalName;
           
         if(move_uploaded_file($imgTempPath,$disPath)){
            echo "Image uploaded";
         }else{
             $errors['Image']="error has occured";
         }
 
        }else{
            $errors['Image']="Extension not allowed";
        }
 
 
    }
    else{
        $errors['Image']="Image Feild is required";;
    }
if(count($errors) > 0){
    foreach ($errors as $key => $value) {
        
        echo '* '.$key.' : '.$value.'<br>';
    }}
else{
   
   $file = fopen('DisplayBlog.txt',"w") or ('unable to open file');
   $BlogDisplay = $BlogTitle."||". $Content. "||" .$finalName."\n";
   fwrite($file , $BlogDisplay);
   fclose($file);
}

}

?>
<!DOCTYPE html>
<html>
    <form action="Task5.php" method="post" enctype="multipart/form-data">
        <div>
        <label> Title </title>
    <input type="text" name="title" size="50" placeHolder="Write the title">
        </div>
        <br> 
        <div>
        <label> Content </title>
        <br>
        <textarea id="content" name="content" rows="5" cols="40" placeholder="Enter you comment here">
        </textarea>
        </div>
        <br>
        <div>
         <label>Image</label>
        <input type="file"  name="image">
        </div>
        <div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
</form>
</html>