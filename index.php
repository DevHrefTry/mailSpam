<style>
*{
	margin: 0;
	background-color:black;
	color:green;
}
input{
	border: 2px green solid;
}
</style>
<?php
session_start();
if(isset($_POST['reset'])){
	session_destroy();
	?>
	<meta http-equiv="refresh" content="0">
	<?php
}
require_once("php_core/main.php");
if(isset($_POST['set'])){
	if(isset($_POST['domain']) && isset($_POST['port']) && isset($_POST['email']) && isset($_POST['password'])){
		$_SESSION['domain'] = $_POST['domain'];
		$_SESSION['port'] = $_POST['port'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['password'] = $_POST['password'];		
	}
}
if(isset($_SESSION['domain']) && isset($_SESSION['port']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
	$main = new main($_SESSION['domain'], $_SESSION['port'], $_SESSION['email'], $_SESSION['password']);
	if(isset($_POST['run']) && isset($_POST['target'])){
		if($main->start($_POST['number'], $_POST['target'])){
				echo "$_POST[number] mails was send on $_POST[target] succesfuly";
		}
	}

}
?>

<?php
if(isset($_SESSION['domain']) && isset($_SESSION['port']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
?>
server: <?=$_SESSION['domain']?>:<?=$_SESSION['port']?>
<br>
Your email: <?=$_SESSION['email']?>
<form method="post">
	<input type="text" name="target" placeholder="target email">
	<input type="number" name="number" placeholder="number of shots">
	<input type="submit" name="run">
</form>
<?php
}else{
?>
<form method="post">
	<input type="text" name="domain" placeholder="Domain of the server">
	<input type="number" name="port" placeholder="port of the server">
	<br>
	<br>
	<input type="email" name="email" placeholder="email">
	<br>
	<br>
	<input type="password" name="password" placeholder="password">
	<input type="submit" name="set">
</form>
<?php }?>
<br>
<form method="post">
<input type="submit" name="reset" value="reset">
</form>