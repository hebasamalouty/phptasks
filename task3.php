<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $Name=$_POST['Name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $address=$_POST['address'];
    $linkedinURL=$_POST['linkedinUrl'];

    $errors = []; 

    if(empty($Name)){
        $errors['Name'] = "Field Required";}
    
        
    if(empty($email)){
        $errors['email'] = "Field Required";}
elseif(!strrchr($email, "@")&&!strrchr($email, ".com")){
    $errors['email'] = "Invalid email form";
}

         
        
    

   if(empty($password)){
      $errors['Password'] = "Field Required";}

  elseif(strlen($password) < 6){
    $errors['Password'] = "Length must be >= 6 chars";}
  

  if(empty($address)){
    $errors['address'] = "Field Required";}

 elseif(strlen($address) < 10){
  $errors['address'] = "Length must be >= 10 chars";}

    if(empty($linkedinURL)){
        $errors['lnkedinURL'] = "Field Required";}
        elseif(!strrchr($linkedinURL, "http:\\")&&!strrchr($email, ".")){
            $errors['linkedinUrl'] = "Invalid URL form";
        }
       
    
    if(count($errors) > 0){
    foreach ($errors as $key => $value) {
        echo '* '.$key.' : '.$value.'<br>';}
    }
    
else{
    echo 'Valid Data';}

}

?>

<!DOCTYPE html >
<html lang="en">
    <head> 
        <title> Registration Form </title>
    </head>
    <form action="task3.php" method="post">
        <div>
            <label> Name </label>
            <input type="text" name="Name"  placeHolder="Please enter your name">
        </div>

            <div>
                <label> Email</label>
            <input type="text" name="email"  placeHolder="Please enter your email">
        </div>

            <div>
                <label> Password </label>
            <input type="password" name="password"  placeHolder="Please enter your ner password"> 
        </div>

        <div>
            <label>Address</label>
           <input type="text" name="address"  placeHolder="Please enter your address">
            </div>

            <div>
                <label> linkedin URL </label>
            <input type="text" name="linkedinUrl"  placeHolder="Please enter your linkedin URL">
             </div>
<div>
    <button  type="submit"  class="btn btn primary"> Submit </button>

</form>
</html>