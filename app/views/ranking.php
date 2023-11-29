<!DOCTYPE html>
<html>
<head>
    <title>Julian Lerej</title>
    <meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Full Stack & Unity Dev">
	<meta name="keywords" content="Julian, Lerej, Portfolio">
	<meta name="author" content="Julian Lerej">
	
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"></link>
	<style>
 th, td {border: 1px solid; color: #337ab7; font-weight: bold; padding: 3px; text-align: center; font-size: 14px;}
 table {margin: auto;}
	</style>
	
<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WMF495RMSP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WMF495RMSP');
</script>
</head>
 <body>
 <p style="display: block;">
 <?php
 
 ob_start();
 //session_start();
 include $_SERVER['DOCUMENT_ROOT'] . "/include/config.php";
 
  try {
  $con= new PDO("mysql:host=$hostname;dbname=$database", "$username", "$password");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM leaderboard ORDER BY total DESC";
  print "<table>";
  $result = $con->query($query);
  $row = $result->fetch(PDO::FETCH_ASSOC);
  print "<tr>";
  foreach ($row as $field => $value){
   print " <th>$field</th>";
  }
  print "</tr>";
  $data = $con->query($query);
  $data->setFetchMode(PDO::FETCH_ASSOC);
  foreach($data as $row){
   print "<tr>";
   foreach ($row as $name=>$value){
   print "<td>$value</td>";
   }
   print " </tr>";
  }
  print "</table>";
  } catch(PDOException $e) {
   echo 'ERROR: ' . $e->getMessage();
  }
 ?>
 </p>
 </body>
</html>