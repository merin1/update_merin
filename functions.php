<?php
include 'connection.php';
$flag=0;
 if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];    
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
            $name = $getData[2];
if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {

  echo "<script type=\"text/javascript\">
            alert(\"Only letters and white space allowed.\");
            window.location = \"index.php\"
          </script>";
          $flag=1;

}
$email = $getData[5];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "<script type=\"text/javascript\">
            alert(\"Invalid Email\");
            window.location = \"index.php\"
          </script>";
          $flag=1;
}
if($flag==0)
{
             $sql = "INSERT into employee_details (id,employee_code,employee_name,address,phonenumber,email,department,age,experience,date_birth,joining_date) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$getData[9]."','".$getData[10]."')";
                   $result = pg_query($sql);
        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";    
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"index.php\"
          </script>";
        }
      }
           }
      
           fclose($file);  
     }
  }   
 ?>