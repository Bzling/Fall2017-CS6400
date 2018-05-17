
<html>

<head>

<title>Images Search | Welcome to my homepage!</title>
<style type="text/css">@import "style.css";</style>

</head>
<body>
    <script  language="JavaScript"  src = "JavaScript.js" type = "text/javascript" charset="utf-8" >
    </script>
    <script language="JavaScript" src = "formvalidator.js" type = "text/javascript" charset="utf-8" >
    </script>
    <script language="JavaScript" src = "JavaScriptR.js" type = "text/javascript" charset="utf-8" >
    </script>
<div id="back">

<div id="back1">
<?php
include 'header.php';
?>

<hr />
<h1>Images Search</h1>
<hr />

<h3>Please tells us what you are looking for?</h3>

<p></p>

<form onsubmit=" return validateForm()" action="SearchQuery.php" method="POST" name="Search"  > 

<p>
	<label for='Input'> Write a description for the photoes you are looking for:</label>
	<input type = "text"  id = "Input" name = "Input" size = "30" /> 

</p>

<p>
 	<label for='Sdate'> Enter the start date for the photoes you are looking for ( date format yyyy-mm-dd) : </label>
	<input type = "text"  id = "Sdate" name = "Sdate" size = "10" />
</p>

<p>
	<label for='Edate'>  Enter the end date for the photoes you are looking for ( date format yyyy-mm-dd) : </label>
    <input type = "text"  id = "Edate" name = "Edate" size = "10"> 
</p>

<p>
	<label for='Category'>  Choose the category:</label>
    <select id = "Category" name = "Category" >
     	<option value="Select">Select</option>
  		<option value="trans_trainstation">trans_trainstation</option>
 		<option value="building_">building_</option>
  		<option value="building_street">building_street</option>
  		<option value="outdoor_city">outdoor_city</option>
  		<option value="people_group">people_group</option>
  		<option value="sky_cloud">sky_cloud</option>
 		<option value="outdoor">outdoor_</option>
  		<option value="plant_leaves">plant_leaves</option>
  		<option value="abstract">abstract_</option>
  		<option value="outdoor_street">outdoor_street</option>
  		<option value="outdoor_grass">outdoor_grass</option>
 		<option value="food_">food_</option>
  		<option value="text_">text_</option>
  		<option value="people_young">people_young</option>
  		<option value="animal_cat">animal_cat</option>
  		<option value="others_">others_</option>
	</select>
</p>
      
<p>
	<label for='Format'> Image format:</label>
    <select id = "Format" name = "Format" >
      	<option value="Select">Select</option>
  		<option value="png">png</option>
 		<option value="jpeg">jpeg</option>
  		<option value="jpg">jpg</option>
  		<option value="gif">gif</option>
		</select>
</p>

<p>
	<label for='Width'> Width </label> <input type = "text"  id = "Width" name = "Width" size = "5" /> 
    <label for='ToWidth'> To </label> <input type = "text"  id = "ToWidth" name = "ToWidth" size = "5" />
</p>

<p>
 	<label for='Height'> Height </label> <input type = "text"  id = "Height" name = "Height"  size = "5" /> 
	<label for='ToHeight'> To </label> <input type = "text"  id = "ToHeight" name = "ToHeight" size = "5" />
</p>

<p>		
	<label for='Background'> Enter the background color: </label>
    <input type = "text"  id = "Background" name ="Background" size = "20" /> 
</p>

<p>	
	<label for= 'People'> <input type = "radio"  name = "People"  
                       value = "1" /> 
        Are you looking for people's pictures? </label>
	</p>
	
<p>
	<label for='Gender'> Gender:</label>
      <select id="Gender" name = "Gender">
      	<option value="Select">Select</option>
  		<option value="Male">Male</option>
 		<option value="Female">Female</option>
		</select>
</p>    

<p>
	<label for='Age'> Age Group:</label>
    <select id="Age" name = "Age">
      	<option value="Select">Select</option>
  		<option value="Over 60">Over 60</option>
  		<option value="50 to 59">50 to 59</option>
 		<option value="40 to 49">40 to 49</option>
  		<option value="30 to 39">30 to 39</option>
  		<option value="20 to 29">20 to 29</option>
  		<option value="10 to 19">10 to 19</option>
  		<option value="2 to 9">2 to 9</option>
  		<option value="Less than 2">Lass than 2</option>
	</select>
</p>
    
<p>&nbsp;</p>  
  
<p>
	<input type = "submit"  value = "Submit"/> <br>

</p>
</form>   
    
<p>&nbsp;</p>


<hr />
<hr />

<?php
include 'footer.php';
?>
</div>
</div>
</body>
</html>
