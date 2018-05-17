<html>
</head>
<title>Images Search | Your Search!</title>
<style type="text/css">@import "style.css";</style>
<body id="list">
<div id="back">
<div id="back1">

<?php
include 'header.php';
?>
<hr />


<h1>Your Search </h1>

<?php 

$Input =$_POST ["Input"];
$Sdate =  $_POST ['Sdate'];
$Edate =  $_POST ['Edate'];
$Category = $_POST ['Category'];
$Format =  $_POST ['Format'];
$Width =$_POST ['Width'];
$ToWidth =  $_POST ['ToWidth'];
$Height =  $_POST ['Height'];
$ToHeight = $_POST ['ToHeight'];
$Background =  $_POST ['Background'];
$People =  $_POST ['People'];
$Gender =  $_POST ['Gender'];
$Age = $_POST ['Age'];

/*echo $Input;
echo "\r\n";
echo $Sdate;
echo "\r\n";
echo $Edate;
echo "\r\n"; 
echo $Category;
echo "\r\n"; 
echo $Format;
echo "\r\n"; 
echo $Width;
echo "\r\n"; 
echo $ToWidth;
echo "\r\n"; 
echo $Height;
echo "\r\n"; 
echo $ToHeight; 
echo "\r\n";
echo $Background;
echo "\r\n"; 
echo $People; 
echo "\r\n";
echo $Gender;
echo "\r\n";
echo $Age;
*/


$errors = '';

 
// Connect MySql
$connect = mysqli_connect("localhost","root","1234","Gallery Search");
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}

$stop_words = "a,about,above,after,again,against,all,am,an,and,any,are,aren't,as,at,be,because,been,before,being,below,between,both,but,by,can't,cannot,could,couldn't,did,didn't,do,does,doesn't,doing,don't,down,during,each,few,for,from,further,had,hadn't,has,hasn't,have,haven't,having,he,he'd,he'll,he's,her,here,here's,hers,herself,him,himself,his,how,how's,i,i'd,i'll,i'm,i've,if,in,into,is,isn't,it,it's,its,itself,let's,me,more,most,mustn't,my,myself,no,nor,not,of,off,on,once,only,or,other,ought,our,ours,	ourselves,out,over,own,same,shan't,she,she'd,she'll,she's,should,shouldn't,so,some,such,than,that,that's,the,their,theirs,them,themselves,then,there,there's,these,they,they'd,they'll,they're,they've,this,those,through,to,too,under,until,up,very,was,wasn't,we,we'd,we'll,we're,we've,were,weren't,what,what's,when,when's,where,where's,which,while,who,who's,whom,why,why's,with,won't,would,wouldn't,you,you'd,you'll,you're,you've,your,yours,yourself,yourselves";
$stop_words_array = explode(",", $stop_words);

if ( $Input != ''){
	$Wordss = explode(" ", $Input);
	foreach($Wordss as $singleWord){
		if(!in_array($singleWord, $stop_words_array)){
		$Words[] = $singleWord;
		}
	}

	if ( 5 <= count($Words) ){
		$query_totalTags = "Select * from tags";
		$query_num_of_tag1 = "Select * from tags where Tag = '$Words[0]'";
		$query_num_of_tag2 = "Select * from tags where Tag = '$Words[1]'";
		$query_num_of_tag3 = "Select * from tags where Tag = '$Words[2]'";
		$query_num_of_tag4 = "Select * from tags where Tag = '$Words[3]'";
		$query_num_of_tag5 = "Select * from tags where Tag = '$Words[4]'";
		$query_imageIDs = "Select ImageID, Tag, Confidence from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' Or Tag = '$Words[3]' Or Tag = '$Words[4]' Order by ImageID";
		$query_distinct_ID = "Select ImageID as ID, Count(ImageID) as b from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' or Tag = '$Words[3]' Or Tag = '$Words[4]' Group by ImageID";
		
		$totalTags = mysqli_query($connect, $query_totalTags)->num_rows;
		$num_of_tag1 = mysqli_query($connect, $query_num_of_tag1)->num_rows;
		$num_of_tag2 = mysqli_query($connect, $query_num_of_tag2)->num_rows;
		$num_of_tag3 = mysqli_query($connect, $query_num_of_tag3)->num_rows;
		$num_of_tag4 = mysqli_query($connect, $query_num_of_tag4)->num_rows;
		$num_of_tag5 = mysqli_query($connect, $query_num_of_tag5)->num_rows;
		
		$list_of_imageID = mysqli_query($connect, $query_imageIDs);
		$distict_imageID = mysqli_query($connect, $query_distinct_ID);
		$tag1_IDF = LOG($totalTags/$num_of_tag1, 2);
		$tag2_IDF = LOG($totalTags/$num_of_tag2, 2);
		$tag3_IDF = LOG($totalTags/$num_of_tag3, 2);
		$tag4_IDF = LOG($totalTags/$num_of_tag4, 2);
		$tag5_IDF = LOG($totalTags/$num_of_tag5, 2);
		
		
/*if(empty($num_of_tag1)){
			echo "<br>"."Don't have '$Words[0]'";
}
else{
	echo "<br>"."IDF of tag1: " . $tag1_IDF;
}

if(empty($num_of_tag2)){
	echo "<br>"."Don't have '$Words[1]'";
}
else{
	echo "<br>"."IDF of tag2: " . $tag2_IDF;
}


if(empty($num_of_tag3)){
	echo "<br>"."Don't have '$Words[2]'";
}
else{
	echo "<br>"."IDF of tag3: " . $tag3_IDF;
}
if(empty($num_of_tag4)){
	echo "<br>"."Don't have '$Words[3]'";
}
else{
	echo "<br>"."IDF of tag4: " . $tag4_IDF;
}

if(empty($num_of_tag5)){
	echo "<br>"."Don't have '$Words[4]'";
}
else{
	echo "<br>"."IDF of tag5: " . $tag5_IDF;
}
*/		
	}
	else{ 	
		if (count($Words) == 4){
		
			$query_totalTags = "Select * from tags";
			$query_num_of_tag1 = "Select * from tags where Tag = '$Words[0]'";
			$query_num_of_tag2 = "Select * from tags where Tag = '$Words[1]'";
			$query_num_of_tag3 = "Select * from tags where Tag = '$Words[2]'";
			$query_num_of_tag4 = "Select * from tags where Tag = '$Words[3]'";
			$query_imageIDs = "Select ImageID, Tag, Confidence from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' Or Tag = '$Words[3]' Order by ImageID";
			$query_distinct_ID = "Select ImageID as ID, Count(ImageID) as b from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' or Tag = '$Words[3]' Group by ImageID";
		
			$totalTags = mysqli_query($connect, $query_totalTags)->num_rows;
			$num_of_tag1 = mysqli_query($connect, $query_num_of_tag1)->num_rows;
			$num_of_tag2 = mysqli_query($connect, $query_num_of_tag2)->num_rows;
			$num_of_tag3 = mysqli_query($connect, $query_num_of_tag3)->num_rows;
			$num_of_tag4 = mysqli_query($connect, $query_num_of_tag4)->num_rows;
		
			$list_of_imageID = mysqli_query($connect, $query_imageIDs);
			$distict_imageID = mysqli_query($connect, $query_distinct_ID);
			$tag1_IDF = LOG($totalTags/$num_of_tag1, 2);
			$tag2_IDF = LOG($totalTags/$num_of_tag2, 2);
			$tag3_IDF = LOG($totalTags/$num_of_tag3, 2);
			$tag4_IDF = LOG($totalTags/$num_of_tag4, 2);
		
		}
		else if (count($Words) == 3){
		
			$query_totalTags = "Select * from tags";
			$query_num_of_tag1 = "Select * from tags where Tag = '$Words[0]'";
			$query_num_of_tag2 = "Select * from tags where Tag = '$Words[1]'";
			$query_num_of_tag3 = "Select * from tags where Tag = '$Words[2]'";
			$query_imageIDs = "Select ImageID, Tag, Confidence from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' Order by ImageID";
			$query_distinct_ID = "Select ImageID as ID, Count(ImageID) as b from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' Group by ImageID";
		
			$totalTags = mysqli_query($connect, $query_totalTags)->num_rows;
			$num_of_tag1 = mysqli_query($connect, $query_num_of_tag1)->num_rows;
			$num_of_tag2 = mysqli_query($connect, $query_num_of_tag2)->num_rows;
			$num_of_tag3 = mysqli_query($connect, $query_num_of_tag3)->num_rows;
		
			$list_of_imageID = mysqli_query($connect, $query_imageIDs);
			$distict_imageID = mysqli_query($connect, $query_distinct_ID);
			$tag1_IDF = LOG($totalTags/$num_of_tag1, 2);
			$tag2_IDF = LOG($totalTags/$num_of_tag2, 2);
			$tag3_IDF = LOG($totalTags/$num_of_tag3, 2);
			
		}
		else if (count($Words) == 2){
		
			$query_totalTags = "Select * from tags";
			$query_num_of_tag1 = "Select * from tags where Tag = '$Words[0]'";
			$query_num_of_tag2 = "Select * from tags where Tag = '$Words[1]'";
			$query_imageIDs = "Select ImageID, Tag, Confidence from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' Order by ImageID";
			$query_distinct_ID = "Select ImageID as ID, Count(ImageID) as b from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' Group by ImageID";
		
			$totalTags = mysqli_query($connect, $query_totalTags)->num_rows;
			$num_of_tag1 = mysqli_query($connect, $query_num_of_tag1)->num_rows;
			$num_of_tag2 = mysqli_query($connect, $query_num_of_tag2)->num_rows;
		
			$list_of_imageID = mysqli_query($connect, $query_imageIDs);
			$distict_imageID = mysqli_query($connect, $query_distinct_ID);
			$tag1_IDF = LOG($totalTags/$num_of_tag1, 2);
			$tag2_IDF = LOG($totalTags/$num_of_tag2, 2);
		
			
		}
		else{		
			$query_totalTags = "Select * from tags";
			$query_num_of_tag1 = "Select * from tags where Tag = '$Words[0]'";
			$query_imageIDs = "Select ImageID, Tag, Confidence from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' Or Tag = '$Words[3]' Order by ImageID";
			$query_distinct_ID = "Select ImageID as ID, Count(ImageID) as b from tags Where Tag = '$Words[0]' Or Tag = '$Words[1]' Or Tag = '$Words[2]' or Tag = '$Words[3]' Group by ImageID";
		
			$totalTags = mysqli_query($connect, $query_totalTags)->num_rows;
			$num_of_tag1 = mysqli_query($connect, $query_num_of_tag1)->num_rows;
		
			$list_of_imageID = mysqli_query($connect, $query_imageIDs);
			$distict_imageID = mysqli_query($connect, $query_distinct_ID);
			$tag1_IDF = LOG($totalTags/$num_of_tag1, 2);
			}
}

	while($row = $list_of_imageID->fetch_array()){
    	$rows[] = $row;
	} 

	$imageid = 0;
	$score = array();

	foreach($rows as $row){
    	if($imageid != $row['ImageID']){
			$imageid = $row['ImageID'];
			$score[$imageid] = 0;		
		}

		if($row['Tag'] == $Words[0]){
			$score[$imageid] += $row['Confidence']*$tag1_IDF;
		}
		if($row['Tag']== $Words[1]){
			$score[$imageid] += $row['Confidence']*$tag2_IDF;
		}
		if($row['Tag'] == $Words[2]){
			$score[$imageid] += $row['Confidence']*$tag3_IDF;
		}
		if($row['Tag']== $Words[3]){
			$score[$imageid] += $row['Confidence']*$tag4_IDF;
		}
		if($row['Tag']== $Words[4]){
			$score[$imageid] += $row['Confidence']*$tag5_IDF;
		}
	}
	
	if ( 4 == count($Words) ){
		if($row['Tag']== $Words[0]){
			$score[$imageid] += $row['Confidence']*$tag1_IDF;
		}
		if($row['Tag']== $Words[1]){
			$score[$imageid] += $row['Confidence']*$tag2_IDF;
		}
		if($row['Tag']== $Words[2]){
			$score[$imageid] += $row['Confidence']*$tag3_IDF;
		}
		if($row['Tag']== $Words[3]){
			$score[$imageid] += $row['Confidence']*$tag4_IDF;
		}
	}
	
	if ( 3 == count($Words) ){
		if($row['Tag']== $Words[0]){
			$score[$imageid] += $row['Confidence']*$tag1_IDF;
		}
		if($row['Tag']== $Words[1]){
			$score[$imageid] += $row['Confidence']*$tag2_IDF;
		}
		if($row['Tag']== $Words[2]){
			$score[$imageid] += $row['Confidence']*$tag3_IDF;
		}
	}
	
	if ( 2 == count($Words) ){
		if($row['Tag']== $Words[0]){
			$score[$imageid] += $row['Confidence']*$tag1_IDF;
		}
		if($row['Tag']== $Words[1]){
			$score[$imageid] += $row['Confidence']*$tag2_IDF;
		}
	}
	
	if ( 1 == count($Words) ){
		if($row['Tag']== $Words[0]){
			$score[$imageid] += $row['Confidence']*$tag1_IDF;
		}
	}
	
while($row2 = $distict_imageID->fetch_array()){
    $rows2[] = $row2;
} 

foreach($rows2 as $row2){
	$ID = $row2['ID'];
}

arsort($score);
$keys = array_keys($score);


}

//look for date
if ( $Sdate !='' || $Edate !='' ){
	if ( $Sdate != ''){
		$Srart = strtotime($Sdate);
		$Snewformat = date('Y-m-d',$Srart);
		
		if ($Edate == ''){
			$datequery = "Select DISTINCT images.ID from images where  TakenDate >= '$Snewformat'";		
		}else
		{
			$End = strtotime($Edate);
			$Enewformat = date('Y-m-d',$End);
			$datequery = "Select DISTINCT images.ID from images where  TakenDate >= '$Snewformat' AND TakenDate <='$Enewformat '";		
		}
	}
	else if ($Edate != ''){
		$End = strtotime($Edate);
		$Enewformat = date('Y-m-d',$End);
		$datequery = "Select DISTINCT images.ID from images where  TakenDate <= '$Enewformat '";
	}

	$Dateresult= mysqli_query($connect, $datequery);

	while($row = $Dateresult->fetch_array()){
    	$Date[] = $row;
	} 

	foreach($Date as $row){
		echo "<br>".$row['ID']."    ".$row['Location']."   ".$row['TakenDate']."   ".$row['BackgroundColor']."    ".$row['ForegroundColor']."   ".$row['Height']."    ".$row['Width']."   ".$row['Format'];
	}
}

//look for Category
if ( $Category != 'Select'){

	$Categoryquery = "Select DISTINCT ImageID from category where Category >= '$Category'";	
	
	$Categoryresult = mysqli_query($connect, $Categoryquery);
	
	while($row = $Categoryresult->fetch_array()){
    	$Cate[] = $row;
	}
	
	foreach($Cate as $row){
		echo "<br>".$row['ImageID'];
	}

}

//look for format
if ( $Format != 'Select'){

	$Formatquery = "Select DISTINCT ID from images where Format = '$Format'";	

	$Formatresult= mysqli_query($connect, $Formatquery);


	while($row = $Formatresult->fetch_array()){
    	$FormatsR[] = $row;
	} 
	foreach($FormatsR as $row){
		echo "<br>".$row['ID'];
	}
}

//look for Width
if ( $Width !='' || $ToWidth !='' ){
	if ( $Width < $ToWidth ){
		$Widthquery = "Select DISTINCT ID from images where Width between ($Width) and ($ToWidth)";		
	}else{
		$Widthquery = "Select DISTINCT ID from images where Width between ($ToWidth) and ($Width)";
	}
	$Widthresult= mysqli_query($connect, $Widthquery);
	
	while($row = $Widthresult->fetch_array()){
    	$WidthR[] = $row;
	} 
	
	foreach($WidthR as $row){
		echo "<br>".$row['ID'];
	}
}

//look for Height
if ( $Height !='' || $ToHeight !='' ){
	if ( $Height < $ToHeight ){
		$Heightquery = "Select DISTINCT ID from images where Height between ($Height) and ($ToHeight)";		
	}else{
		$Heightquery = "Select DISTINCT ID from images where Height between ($ToHeight) and ($Height)";
	}
	$Heightresult= mysqli_query($connect, $Heightquery);
	
	while($row = $Heightresult->fetch_array()){
    	$HeightR[] = $row;
	} 
	
	foreach($HeightR as $row){
		echo "<br>".$row['ID'];
	}
}

//look for Background
if ( $Background !='' ){
	
	$Backgroundquery = "Select DISTINCT ID from images where BackgroundColor = '$Background'";		
	
	$Backgroundresult= mysqli_query($connect, $Backgroundquery);
	
	while($row = $Backgroundresult->fetch_array()){
    	$BackgroundR[] = $row;
	} 
	
	foreach($BackgroundR as $row){
		echo "<br>".$row['ID'];
	}
}

//look for people
if ( $People == 1){
	
	
	if ($Age != 'Select'){
		$AgeWords = explode(" ", $Age);

		if ( count($AgeWords) == 2 and $AgeWords[1] == 60 ){
			if ( $Gender != 'Select'){
				$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID and Gender = '$Gender' and Age > $AgeWords[1]";
			}else{ 
				$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID and Age > $AgeWords[1]";
				}
		}else if ( count($AgeWords) == 3 ){
			if ( $AgeWords[0] == "Less"){
				if ( $Gender != 'Select'){
					$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID and Gender = '$Gender' and Age < $AgeWords[2]";
				}else {
					$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID and Age < $AgeWords[2]";
				}
			} else{
				if ( $Gender != 'Select'){
					$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID and Gender = '$Gender' and Age between ($AgeWords[0]) and ($AgeWords[2])";
				}else 
					$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID and Age between ($AgeWords[0]) and ($AgeWords[2])";
				}
			}
	}else if ( $Gender != 'Select'){
		$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID and Gender = '$Gender'";
	}else 
		$PeoplequeryGA = "Select DISTINCT images.ID from images, face where images.ID = ImageID ";


	$Peopleresult = mysqli_query($connect, $PeoplequeryGA);
	
	while($row = $Peopleresult->fetch_array()){
    	$PeopleR[] = $row;
	} 
	
	foreach($PeopleR as $row){
		echo "<br>".$row['ID'];
	}
}

?>

<?php

$j = 1;
//if ( count($Rank)> 0){
	if ( count($Date) > 0) {
		if ( count($Cate) > 0){ 
			if ( count($PeopleR) > 0){
				if ( count($BackgroundR) > 0) {
					if ( count($FormatsR) > 0) {
						if ( count($HeightR) > 0) {
							if ( count($WidthR) > 0){ 
							
							}
						}
					}
				}
			}
		}
	}
//}
	
	echo "<br>"."&nbsp;&nbsp;";
	foreach($keys as $row){
		if ( $j == 5){
			$j =2;
			echo "<br>"."<br>"."&nbsp;&nbsp;&nbsp;&nbsp;";			
		}else {
			$j = $j + 1;
			echo "&nbsp;&nbsp;";
		}
		
	
		$LocID =$row ;
		$query = "Select DISTINCT Location from images where ID = '$LocID'";
		$result= mysqli_query($connect, $query);
	
		$row = $result->fetch_assoc();
  		$Location = $row['Location'];
     
    	$Location =$Location.'\'';
		$value = "<img src='".$Location."  alt='HTML5 Icon' width='228' height='228' />";
    	echo $value;
}
?>


<br><br><br><a href="http://localhost/ImagesSearch/ImagesSearch.php" title="Search page"> Go back to Search page </a><br>
or 
<a href="http://localhost/ImagesSearch/Home.php" title="Home page"> Go to Home page </a><br>


</div>
</div>
</body>
</html>

