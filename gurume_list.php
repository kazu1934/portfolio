<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ろくまる農園</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php

try
{

$dsn='mysql:dbname=portfolio;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT * FROM nikki ';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;



while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	print $rec['name'];
        print $rec['comment'];
        print $rec['address'];
        print $rec['date'];
	print '<br />';
}

}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>
    <a href="top.html">戻る </a>
        
</body>
</html>
