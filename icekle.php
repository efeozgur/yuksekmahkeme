<?php include('baglan.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>İçtihat Ekle</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
<?php 
	session_start();
	if (@$_SESSION['kullanici'] == '') {
		header('Refresh: 1; url=giris.php');
		echo "Önce giriş yapınız...!!!";
		exit();
	}
 ?>

<?php 
	$ilgiliserh = $_GET['ilgili'];
 ?>
<?php include('menu.php'); ?>
	<table class="table table-striped">
	<form action="" method="POST">
		<tr>
			<td>Daire Adı</td>
			<td>
				<select name="daireadi" id="">
					<?php 
						$dairegetir = mysqli_query($baglan, "select * from daireler order by daireadi asc");
						while ($daire = mysqli_fetch_array($dairegetir)) {
							extract($daire);
							echo "<option value='$daireadi'>$daireadi</option>";
						}
					 ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Esas No</td>
			<td><input name="esasno" type="text" /></td>
		</tr>
		<tr>
			<td>Karar No</td>
			<td><input name="kararno" type="text" /></td>
		</tr>	
		<tr>
			<td>İçtihat Özeti</td>
			<td><textarea name="ozet" class="ckeditor" cols="30" rows="10"></textarea></td>
		</tr>	
		<tr>
			<td>İçtihat</td>
			<td><textarea name="ictihat" class="ckeditor" cols="80" rows="60"></textarea></td>
		</tr>	
		<tr>
			<td>İlgili Madde</td>
			<td>
				<select name="ilgili" id="">
					<?php 
						echo "<option value='$ilgiliserh'>$ilgiliserh</option>";
					 ?>
				</select>
			</td>
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
			$esasno = $_POST['esasno'];
			$kararno = $_POST['kararno'];
			$ozet = $_POST['ozet'];
			$ictihat = $_POST['ictihat'];
			$ilgili = $_POST['ilgili'];

			if (!empty($esasno) and (!empty($kararno) and (!empty($ozet) and (!empty($ictihat))))) {
				$kaydet = mysqli_query($baglan, "insert into serh (daire, esasno, kararno, ozet, serh, ilgili) values ('$daireadi','$esasno','$kararno','$ozet','$ictihat','$ilgili')");
				if ($kaydet) {
					echo "kayıt başarıyla yapıldı!!!";
				}
			} else {echo "Tüm alanları doldurun!..";}

			
		}
	 ?>
</body>
</html>