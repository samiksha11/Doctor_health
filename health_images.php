<?php 
include_once("config.php");



if(isset($_POST['submit']) && $_POST['submit'] == 'upload')
    { 
    var_dump($_FILES);
    //die();
    if($_FILES['image']['name'] !='')
     {
      
        
        $filename=$_FILES["image"]["name"];
        $source = $_FILES["image"];
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
        $image = '_report'.substr(number_format(time() * rand(),0,'',''),0,10).$ext;      
        
        
         move_uploaded_file($source["tmp_name"],"../upload/patient_report/".$image);
                  
        
       }
}

?>
<?php        
include_once ('Includes/header.php');?>
<body id="body-color">
<div id="Doctor-Sign-Up">
  <form method="POST" action="" enctype="multipart/form-data">
    <tr>
      <td>Image</td>
      <td><input type="file" name="image"></td>
    </tr>
    <tr>
      <td><input id="button" type="submit" name="submit" value="upload"></td>
    </tr>
    </table>
    </fieldset>
  </form>
</div>
</div>
</body>
</html>
