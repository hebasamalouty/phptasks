<?php

$file = fopen('DisplayBlog.txt',"r") or ('unable to open file');
while(!feof($file)){ 
                echo fgets($file) , '<br>';
               
            }
    fclose($file); 
            if($_SERVER['REQUEST_METHOD']=="POST"){
           $delete=""."". "". "" .""."\n";
           $file = fopen('DisplayBlog.txt',"w") or ('unable to open file');
           fwrite($file , $delete);
           fclose($file);
           }
          
        
        }

?>
<html>
    <form action="Task5(1).php" method="post" enctype="multipart/form-data">
<div>
        <button type="submit" class="btn btn-primary">Delete</button>
        </div>
    </form>
</html>