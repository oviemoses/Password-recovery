<?php
/******************************************************************************************************/
/*                             Online md5 Password Recovery
/*                              
/*
/*                           we are using password1.txt & password1.txt
/*        or you can try with more other dictionary : https://wiki.skullsecurity.org/Passwords
/******************************************************************************************************/
$yourhash = isset($_POST['yourhash']) ? $_POST['yourhash'] : '';
$yourhash = !empty($_POST['yourhash']) ? $_POST['yourhash'] : '';
$yourhash = trim($yourhash);
$value = isset($_POST['dictnm']) ? $_POST['dictnm'] : '';
$value = !empty($_POST['dictnm']) ? $_POST['dictnm'] : '';
if(@$_POST['submit']=='Exec') {
	if ($value == "dictionary/password1.txt") {
		$myfile = fopen("dictionary/password1.txt", "r") or die("Unable to open file!");
	} else {
		$myfile = fopen("dictionary/password2.txt", "r") or die("Unable to open file!");		
	}	
	while(!feof($myfile)) {
		$strpass = trim(fgets($myfile));
		$md5hash = md5($strpass);
		if ($yourhash == $md5hash) {
			exit("<center><h2>Recovered!! Your password is <span style=\"background-color:#fff\">{$strpass}</span></h2></center>");
		}
	}
	fclose($myfile);
	exit("<center><h2>Please Try Another Dictionary ..</h2></center>");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>:: Online md5 Password Recovery ::</title>
</head>
<body bgcolor=#fff>
<p>&nbsp;</p>
<center><span style="color: black; font: 40px tahoma; text-shadow: 0px 0px 50px;">Md5 password recovery</span></center>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table align=center style="border: 3px solid #fff; height: 100px; width: 200px; margin-top: 40px">
<tr>
	<td align=center colspan=2>
		<span style="color: white; font: 10px tahoma; text-shadow: 0px 0px 50px;">Your hash (md5): </span><input type="text" name="yourhash" placeholder="Put Your Md5 Hash Here .." >
	</td>
</tr>
<tr>
	<td align=center>
		<select name="dictnm">
		  <option value="select">Select</option>
		  <option value="dictionary/password1.txt">password1 Txt</option>
		  <option value="dictionary/password2.txt">password2 Txt</option>
		</select>
	</td>
	<td align=center><input type="submit" name="submit" value="Recover"></td>
</tr>
</table>
</form>
</body>
</html>