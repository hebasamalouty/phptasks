<?php
session_start();
function Clean($str){
    $str =htmlspecialchars($str);
    $str= trim($str);
    $str = stripslashes($str);
    return $str;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $Username     = Clean($_POST['Name']);
    $UserEmail     = Clean($_POST['Email']);
    $Password      =Clean($_POST['password']);
    $Address     =Clean($_POST['address']);
    $Gender     =$_POST['gender'];
    $LinkedinURL =Clean($_POST['linkedinurl']);

    $errors = [];
    //username required
    if(empty($Username)){
        $errors['Name'] = "Field Required";
    }
      //email required
    if(empty($UserEmail)){
        $errors['UserEmail'] = "Field Required";
    }
    //email validation
    elseif(!filter_var($UserEmail,FILTER_VALIDATE_EMAIL)){
      $errors['UserEmail'] = "Invalid Email";
  }
  //password required
  if(empty($Password)){
    $errors['Password'] = "Field Required";
}
// check password length
elseif(strlen($Password)<6){
    $errors['Password'] = "Your password must be morethan 6 characters";
}
//address required
if(empty($Address)){
    $errors['address'] = "Field Required";
}
//check address length
elseif(strlen($Address)<10){
    $errors['Address'] = "Invalid Address";
}

//linkedin url requied
if(empty($LinkedinURL)){
    $errors['LinkedinURL'] = "Field Required";
}
//URL validation
elseif(!filter_var($LinkedinURL,FILTER_VALIDATE_URL)&& !stristr("linkedinURL","https://linkedin")){
  $errors['LinkedinURL'] = "Invalid URL";
}

//upload profile picture
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
             $errors['ProfilePicture']="error has occured";
         }
 
        }else{
            $errors['ProfilePicture']="Extension not allowed";
        }
 
 
    }else{
        $errors['ProfilePicture']="Image Feild is required";;
    }




    if(count($errors) > 0){
        foreach ($errors as $key => $value) {
            
            echo '* '.$key.' : '.$value.'<br>';
        }}
        else{
            $_SESSION['name']  = $Username;
            $_SESSION['email'] = $UserEmail;
            $_SESSION['password'] = $Password;
            $_SESSION['address'] = $Address;
            $_SESSION['gender'] = $Gender;
            $_SESSION['linkedinurl'] = $LinkedinURL;
            $_SESSION['profilepicture'] = $finalName;

      
           $_SESSION['user'] = ["name" => $Username, "email" => $UserEmail, "password" => $Password,
            "address" => $Address, "gender" => $Gender , "linkedinurl" => $LinkedinURL,"profilepicture"=>$finalName];
      
           

        }

}
      








?>
<!DOCTYPE html>
<html>
    <head><title>Register</title></head>
    <form action="task4.php" method="post" enctype="multipart/form-data">
        <div>
            <label> Name </label>
            <input type="text" name="Name" height="50px" width="100px" placeHolder="Please Enter your name">
</div>
<br>
<div>
            <label> Email </label>
            <input type="text" name="Email" height="50px" width="100px" placeHolder="Please Enter your email">
</div>
<br>
<div>
            <label> Password </label>
            <input type="password" name="password" height="50px" width="100px" placeHolder="Please Enter your password">
</div>
<br>
<div>
            <label> Address</label>
            <input type="text" name="address" height="50px" width="100px" placeHolder="Please Enter your email">
</div>
<br>
<div>
            <label> Gender </label><br>
            <label>Male </label>
            <input type="radio" id="Male" name="gender" value="Male" ><br>
            <label>Female </label>
            <input type="radio" id="Female" name="gender" value="Female" >
</div>
<br>
<div>
            <label> Linkedin URL </label>
            <input type="text" name="linkedinurl" height="50px" width="100px" placeHolder="Please Enter your Linkedin account">
</div>
<br>
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