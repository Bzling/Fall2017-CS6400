<?php
// Connect MySql
$connect = mysqli_connect("localhost","root","root","GallerySearch");
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}else 
	echo "Connected\n";

$query_totalTags = "Select * from tags";
$query_num_of_tag1 = "Select * from tags where Tag = 'person'";
$query_num_of_tag2 = "Select * from tags where Tag = 'outdoor'";
$query_num_of_tag3 = "Select * from tags where Tag = 'group'";
$query_imageIDs = "Select ImageID, Tag, Confidence from tags Where Tag = 'person' Or Tag = 'outdoor' Or Tag = 'group' Order by ImageID";
$query_distinct_ID = "Select ImageID as a, Count(ImageID) as b from tags Where Tag = 'person' Or Tag = 'outdoor' Or Tag = 'group' Group by ImageID";

$totalTags = mysqli_query($connect, $query_totalTags)->num_rows;
$num_of_tag1 = mysqli_query($connect, $query_num_of_tag1)->num_rows;
$num_of_tag2 = mysqli_query($connect, $query_num_of_tag2)->num_rows;
$num_of_tag3 = mysqli_query($connect, $query_num_of_tag3)->num_rows;


$list_of_imageID = mysqli_query($connect, $query_imageIDs);
$distict_imageID = mysqli_query($connect, $query_distinct_ID);
$tag1_IDF = LOG($totalTags/$num_of_tag1, 2);
$tag2_IDF = LOG($totalTags/$num_of_tag2, 2);
$tag3_IDF = LOG($totalTags/$num_of_tag3, 2);
//$result= mysqli_query($connect, $query_num_of_tag1);
if($num_of_tag1 === 0){
	echo "<br>"."Don't have 'person'";
}
else{
	echo "<br>"."IDF of tag1: " . $tag1_IDF;
}

if($num_of_tag2 === 0){
	echo "<br>"."Don't have 'outdoor'";
}
else{
	echo "<br>"."IDF of tag2: " . $tag2_IDF;
}

if($num_of_tag3 === 0){
	echo "<br>"."Don't have 'group'";
}
else{
	echo "<br>"."IDF of tag3: " . $tag3_IDF;
}

while($row = $list_of_imageID->fetch_array()){
    $rows[] = $row;
} 
if($list_of_imageID->num_rows === 0){
    print 'Name not found';
}

$imageid = 0;
$score = array();
//$index = 0;
foreach($rows as $row){
    if($imageid != $row['ImageID']){
		//$index ++;
		$imageid = $row['ImageID'];
		$score[$imageid] = 0;		
	}
	
	if($row['Tag']=='person'){
		$score[$imageid] += $row['Confidence']*$tag1_IDF;
	}
	if($row['Tag']=='outdoor'){
		$score[$imageid] += $row['Confidence']*$tag2_IDF;
	}
	if($row['Tag']=='group'){
		$score[$imageid] += $row['Confidence']*$tag3_IDF;
	}
	
}
print_r($score);

while($row2 = $distict_imageID->fetch_array()){
    $rows2[] = $row2;
} 
if($distict_imageID->num_rows === 0){
    print 'Name not found';
}

foreach($rows2 as $row2){
	$ID = $row2['a'];
	echo "<br>".$ID."	".$score[$ID];
    //echo "<br>"."    ".$row2['a']."		".$row2['b'];
}


arsort($score);
print_r($score);
$keys = array_keys($score);
echo "<br>";
print_r($keys);

foreach($keys as $row){
	$ID = $row;
    //echo "<br>"."    ".$row2['a']."		".$row2['b'];
}


?>