<?php include('baglan.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Daire Ekle</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/ozel.css" />
</head>
<?php 
	session_start();
	if (@$_SESSION['kullanici'] == '') {
		header('Refresh: 1; url=giris.php');
		echo "Önce giriş yapınız...!!!";
		exit();
	}
 ?>
<body>
<?php include('dmenu.php'); ?>
	<table class="table table-striped">
	<form action="" method="POST">
		<tr>
			<td>Kanun Adı</td>
			<td><input type="text" name="kanunadi" /></td>
		</tr>
		<tr>
			<td>Kanun No</td>
			<td><input type="text" name="kanunno" /></td>
		</tr>		
		<tr>
			<td>Kanun Madde Sayısı</td>
			<td><input type="text" name="kanunmaddesayisi" /></td>
		</tr>
		<tr>
			<td>Anasayfa</td>
			<td><input type="submit" value="Ekle" /></td>
		</tr>	
	</form>
	</table>
<?php 
	if ($_POST) {
		$kanunadi = $_POST['kanunadi'];
		$kanunno = $_POST['kanunno'];
		$kanunmaddesayisi = $_POST['kanunmaddesayisi'];
		if (!empty($kanunadi) and (!empty($kanunno))) {
			$kaydet=mysqli_query($baglan,"insert into kanunlar (kanunadi, kanunno, maddesayisi) values ('$kanunadi','$kanunno','$kanunmaddesayisi')");
			if ($kaydet) {
				echo "Kanun Eklendi!"; 
			}
		} else {echo "Tüm alanları doldurun!..";}
		
	}
 ?>
</body>
</html>