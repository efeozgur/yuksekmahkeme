<?php include('baglan.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Ayrıntılı Kanun Şerh - <?php $kanun = strip_tags(trim($_GET["kanun"])); echo $kanun; ?></title>
	<link rel="stylesheet" href="css/ozel.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>

<?php include('kaydir.php'); ?>
<body style="background-color: #272822;" >
<?php include('dmenu.php'); ?>
	<div style="margin:20px; border-radius:5px;" class="beyazkutu">
		<h3 style="text-align:center"><?php echo $kanun; ?></h3>
		<?php 
			$kullanici = mysqli_query($baglan, "select * from uye where id='1'");
			$kgetir = mysqli_fetch_array($kullanici);
			extract($kgetir);

			if (@$_SESSION['kullanici'] == $kadi) {
					$gelenkanun = $_GET['kanun'];
					$gelenno = $_GET['no'];
					echo "<h4 style='text-align:center;'><a href='kekle.php?kanun=$gelenkanun&no=$gelenno'>Madde Ekle</a></h4>";
			}		
			$kanun = mysqli_query($baglan, "select * from kanun where kanunadi = '$kanun' order by maddeno asc");			
			while ($kanunyaz = mysqli_fetch_array($kanun)) {
				extract($kanunyaz);
				echo "<p><b><a href='dtekkanungoster.php?ilgili=$ilgiliserh'>Madde $maddeno </a></b> $madde</p>";	
				$ictihatigetir = mysqli_query($baglan, "select * from serh where ilgili = '$ilgiliserh'");
				$bilgigetir = mysqli_query($baglan, "select * from bilgitbl where bilgibaslik = '$ilgiliserh'");
				$bilgibilgi = mysqli_fetch_array($bilgigetir);
				@extract($bilgibilgi);
				$kacbilgi = mysqli_num_rows($bilgigetir);
				$kacictihat = mysqli_num_rows($ictihatigetir);
				if ($kacictihat > '0') {
					echo "<p class='ictihat'><a href='dgoster.php?ilgili=$ilgiliserh'>$kacictihat İçtihat</a></p>";
				}	
				if ($kacbilgi > '0') {
					@$temizozet = strip_tags($bilgi);
					@$ozetozet = substr($temizozet, 0,300);
					@$ozetozet = $ozetozet . "...[Devamı için tıklayın]";
					echo "<p class='bilgi'><a title='$ozetozet' href='bilgigoster.php?ilgili=$ilgiliserh'>$kacbilgi Bilgi</a></p>";
							
				}	

				$kullanici = mysqli_query($baglan, "select * from uye where id='1'");
				$kgetir = mysqli_fetch_array($kullanici);
				extract($kgetir);
				//session_start();
				if (@$_SESSION['kullanici'] == $kadi) {
							echo "<p class='ictihatekle'><a href='icekle.php?ilgili=$ilgiliserh'>İçtihat Ekle</a></p>";
							echo "<p class='ictihatekle'><a href='bilgiekle.php?ilgili=$ilgiliserh'>Bilgi Ekle</a></p>";
						}	
				echo "<hr>";		
			}
						
							
		 ?>
	</div>




</body>
</html>