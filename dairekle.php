<?php include('baglan.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Daire Ekle</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<?php include('menu.php'); ?>
	<table class="table table-striped">
	<form action="" method="POST">
		<tr>
			<td>Daire Adı</td>
			<td><input type="text" name="daireadi" /></td>
		</tr>
		<tr>
			<td>Anasayfa</td>
			<td><input type="submit" value="Ekle" /></td>
		</tr>	
	</form>
	</table>
<?php 
	if ($_POST) {
		$daireadi = $_POST['daireadi'];
		if (!empty($daireadi)) {
			$kaydet=mysqli_query($baglan,"insert into daireler (daireadi) values ('$daireadi')");
			if ($kaydet) {
				echo "Daire Eklendi!";
			}
		} else {echo "Boş kayıt eklenemez!";}
		
	}
 ?>
</body>
</html>