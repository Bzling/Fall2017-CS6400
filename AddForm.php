<html>
<head>
	<title>Add Image</title>
	<style type="text/css">@import "style.css";</style>
</head>

<body id="add">
    <?php $browser = $_SERVER['HTTP_USER_AGENT']; ?>  
    <?php if (strstr($browser, "Firefox")) { ?>  
    <link rel="stylesheet" href="CSS/style.css" type="text/css" media="screen" />  
    <?php }elseif(strstr($browser, "MSIE")){ ?>  
    <link rel="stylesheet" href="CSS/style.css" type="text/css" media="screen" />  
    <?php }else{ ?>  
    <link rel="stylesheet" href="CSS/style.css" type="text/css" media="screen" />  
    <?php } ?> 


<div id="back">
<div id="back1">
<?php
include 'header.php';
?>

<hr />


<?php 
 
$json =$_POST ["responseTextArea"];
$URL = $_POST ["URL"];


$data = json_decode($json, true);

// Connect MySql
$connect = mysqli_connect("localhost","root","root","GallerySearch");
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}

$backgroundcolor = $data['color']['dominantColorBackground'];

$Foregroundcolor = $data['color']['dominantColorForeground'];

$widthvalue = $data['metadata']['width'];

$heightvalue = $data['metadata']['height'];

$formatvalue = $data['metadata']['format'];

$date = date("Y-m-d");

$IDQuery = "SELECT ID FROM images ORDER BY ID DESC limit 1";
$IDQueryResult = mysqli_query($connect, $IDQuery);

while($row = $IDQueryResult->fetch_array()){
 	 $ID[] = $row;
} 
	
foreach($ID as $row){
	$ImageID = $row['ID']+1;
}
	
echo "Image's information to be stored:"."<p>"."ID:   ".$ImageID."&nbsp;&nbsp;&nbsp;"."height:   ".$heightvalue."&nbsp;&nbsp;&nbsp;"."width:   ".$widthvalue."&nbsp;&nbsp;&nbsp;"."ForegroundColor:   ".$Foregroundcolor."&nbsp;&nbsp;&nbsp;"."BackgroundColor:   ".$backgroundcolor."&nbsp;&nbsp;&nbsp;"."TakenDate:   ".$date."&nbsp;&nbsp;&nbsp;"."Format:   ".$formatvalue."&nbsp;&nbsp;&nbsp;"."<p>"."Location:   ".$URL;

$CheckQuery = "SELECT ID FROM images where Location = '$URL'";
$Check = mysqli_query($connect, $CheckQuery)->num_rows;

if (mysqli_query($connect, $IDQuery)){
	print'<h1>Image ID for tags has been successfully retrieved</h1>';
}
else{
	print'<p>Can not execute the ID query</p>';
	die (mysql_error());
}


if ($Check == 0){
	echo "ME";
	//(`ID`, `Height`, `Width`, `ForegroundColor`, `BackgroundColor`, `TakenDate`, `Format`, `Location`) 
	$ImageQuery = "INSERT INTO images VALUES ('$ImageID', '$heightvalue', '$widthvalue', '$Foregroundcolor', '$backgroundcolor', '$date', '$formatvalue', '$URL')";						
	$ImageQueryResult = mysqli_query($connect, $ImageQuery);

	foreach ($tagvalue = $data['description']['tags'] as $tag) {
	 	$tagvalue= $tag;
		//INSERT INTO `tags` (`ID`, `ImageID`, `Tag`, `Confidence`) VALUES ('', '', '', '');
		$TagQuery = "INSERT INTO tags VALUES (DEFAULT, '$ImageID', '$tagvalue', '0')";
		$TagQueryResult = mysqli_query($connect, $TagQuery);
	}

	
	foreach ($cateName= $data['categories'] as $categories) {
	 	$catevalue= $categories['name'];
		$cateQuery = "INSERT INTO category VALUES (DEFAULT, '$ImageID', '$catevalue')";
		$cateQueryResult = mysqli_query($connect, $cateQuery);
	}

	if (mysqli_query($connect, $ImageQuery)){
		print'<h1>Basic image information have been added successfully </h1>';
	}
	else{
		print'<p>Can not execute the image query</p>';
		die (mysql_error());
	}

	if ( mysqli_query($connect, $TagQuery)){
		print'<h1>Image\'s tags have been added successfully </h1>';
	}
	else{
		print'<p>Can not execute the tag query</p>';
		die (mysql_error());
	}
	
	if ( mysqli_query($connect, $cateQuery)){
		print'<h1>Image\'s tags have been added successfully </h1>';
	}
	else{
		print'<p>Can not execute the tag query</p>';
		die (mysql_error());
	}

}
?>
<br><br><br><br><br><br><br><br><br><br>
<hr />
<?php
include 'footer.php';
mysql_close();
?>
<hr />
</div>
</div>
</body>
</html>