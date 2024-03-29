<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $sell = $_POST['sell'];
    $buy = $_POST['buy'];
    $stok = $_POST['stok'];

    $imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

    if(empty($name)){
			$errorMsg = 'Please input name';
		}elseif(empty($sell)){
			$errorMsg = 'Please input price sell';
		}elseif(empty($buy)){
			$errorMsg = 'Please input price buy';
		}elseif(empty($stok)){
			$errorMsg = 'Please input stok';
		}else{

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}


		if(!isset($errorMsg)){
			$sql = "insert into contacts(NamaBarang, HargaBeli, HargaJual, Stok, FotoBarang)
					values('".$name."', '".$buy."', '".$sell."', '".$stok."', '".$userPic."')";
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record added successfully';
				header('Location: index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}
  }
?>
