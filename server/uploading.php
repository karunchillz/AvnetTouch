<?php
$allowedExts = array("xls", "xlsx");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/JPG")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
    {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
	else
    {
    		$found=0;
		$imgNames= array("1.jpg","2.jpg","3.jpg","4.jpg","5.jpg","6.jpg","7.jpg","8.jpg","9.jpg","10.jpg");
		for($i=0;$i<10;$i++){
			if (file_exists("upload/" . $imgNames[$i])){}
			else
			{
				$found=1;
				move_uploaded_file($_FILES["file"]["tmp_name"],
		  "upload/".$imgNames[$i]);
				break;
			}
		}
		echo '<body bgcolor=\'black\'><script type="text/javascript" src="uploadingJs.js"></script><link rel="stylesheet" type="text/css" href="myStyles.css">';
		if($found==1){
			echo "<script>alert('Upload Successful');</script>";
			$string= '<div id="topHeader" class="myContents"></div><hr/><h1>Upload Photos</h1><form action="photoUploading.php" method="post" enctype="multipart/form-data">';
			$string.= '<label for="file">Choose File</label><br/><input type="file" name="file" id="file"><br>';
			$string.= '<input type="hidden" id="myuserid" value="'.$given_user.'"><input type="hidden" id="myuserpass" value="'.$given_pass.'">';
			$string.= '<input type="submit" style="width:70px" name="submit" value="Submit"></form>';
			echo $string;
			
		}
		else{
			echo "<script>alert('Delete some images to upload new one');</script>";
		}
		echo "<br/><h1>Existing Images</h1>";
		$string="<table>";
		for($i=0;$i<10;$i++){
			if (file_exists("upload/" . $imgNames[$i])){
			$string.='<tr><td><img src="http://indiaisshinryukarate.com/uploading/upload/'.$imgNames[$i].'" width="100px" height="auto"></td><td><input type="button" value="Delete" onclick="deleteMePhoto(\'upload/'.$imgNames[$i].'\')"/></td></tr>';
			}
		}
		$string.= '</table><input type="hidden" id="myuserid" value="'.$given_user.'"><input type="hidden" id="myuserpass" value="'.$given_pass.'">';
		echo $string."</body>";
    }
  }
else
  {
  echo "Invalid file";
  }
  echo "<br/><a href=\"http://indiaisshinryukarate.com/uploading/\">Back to Uploading</a>"
?>