if($_FILES['uploaded_file']['name'] !='')
     {
      $allowedExts = array("gif", "jpeg", "jpg", "png");
      $temp = explode(".", $_FILES["uploaded_file"]["name"]);
      $extension = end($temp);
      
      if ((($_FILES["uploaded_file"]["type"] == "image/gif")
      || ($_FILES["uploaded_file"]["type"] == "image/jpeg")
      || ($_FILES["uploaded_file"]["type"] == "image/jpg")
      || ($_FILES["uploaded_file"]["type"] == "image/pjpeg")
      || ($_FILES["uploaded_file"]["type"] == "image/x-png")
      || ($_FILES["uploaded_file"]["type"] == "image/png"))
      && in_array($extension, $allowedExts))
      {
       if ($_FILES["uploaded_file"]["error"] > 0)
       {
        
        $error .=  "Return Code: " . $_FILES["uploaded_file"]["error"] . "<br>
        ";
        $_SESSION['msg'] = $error;  
        header("location:shopcategory_add.php");
       
       }
       else
       {
        
        $filename=$_FILES["uploaded_file"]["name"];
        $source = $_FILES["uploaded_file"];
        $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
        $image = substr(number_format(time() * rand(),0,'',''),0,10).$ext;      
        
        
         move_uploaded_file($source["tmp_name"],"../shopimages/categories/".$image);
                  
         mysql_query("insert into category set parent_id='".$_POST['pid']."', name='".$_POST['name']."',
           weight='".$_POST['weight']."',imname='$image', status=1 ");
         $_SESSION['msg'] = "Category added successfully";  
         header("location:shop_category_list.php");
         }
        
         }
       }