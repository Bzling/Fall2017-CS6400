
function validateForm()
{
var Count =0;
var i = false;
var x=document.forms.Search.Input.value;

// x is Input value
if (x === null || x === '')
{
	Count +=1;
}
else{
	if (!(/^[a-zA-Z' ']+$/.test(x))){
		alert (" The description input should be a string type only!");
		return false;
	}
}

// y is Sdate value
var y=document.forms.Search.Sdate.value;

if (y !== null && y !== '')
{
  	c = isValidDate(y);
	if (!c){
		alert (" Start date format is wrong!");
		return false;
		}
	 i = true;
}
else 
	Count +=1;
	
var a=document.forms.Search.Edate.value;
// a is Edate value
if (a !== null && a !== '')
  {
	if ( !(isValidDate(a))){
		alert(" End date format is wrong!");
  		return false;
  	}
  	if (i){
  		if ( !(isValidPeriod(y,a)) ){
  			alert(" Start date should be less than end date!");
  			return false;
  			}
  		}
}else 
	Count +=1;

// i.options[i.selectedIndex].text is the value of Category
var i=document.forms.Search.Category;

if ( i.options[i.selectedIndex].text === 'Select')
{
	Count +=1;
}


// j.options[j.selectedIndex].text is the value of Format
var j=document.forms.Search.Format;
if ( j.options[j.selectedIndex].text === 'Select' )
{
	Count +=1;
}

var t=document.forms.Search.Width.value;
var tw=document.forms.Search.ToWidth.value;

// t is the value of sart Width
// tw is the value of end Width
if (t === null || t === '')
{
	Count +=1;
	if (!(tw === null || tw === '')){
		alert(" Please input both width dimensions!!");
		return false;
	}	
}else{
	if ( tw === null || tw === ''){
		alert(" Please input both width dimensions!");
		return false;
	}else{
		if((!(/^[0-9]+$/.test(t)))){
			alert(" Width fields take numbers only!");	
        	return false;
		}
		if((!(/^[0-9]+$/.test(tw)))){
			alert(" Width fields take numbers only!");	
        	return false;
		}
	}
}

var h=document.forms.Search.Height.value;
var th=document.forms.Search.ToHeight.value;
// h is the value of sart Height
// th is the value of end Height

if ( h === null || h === '' )
{
	Count +=1;
	if ( !(th === null || th === '')){
		alert(" Please input both height dimensions!!");
		return false;
		}
}else {
	if ( th === null || th === ''){
		alert(" Please input both height dimensions!");	
		return false;
	}else {
		if((/^[a-zA-Z' '#@$%^&*()!?]+$/.test(h)) && (/^[a-zA-Z' '#@$%^&*()!?]+$/.test(th))){
			alert(" Height fields take numbers only!");	
        	return false;
		}
	}
}

var b=document.forms.Search.Background.value;
// b is background information 

if (b === null || b === '' )
{
	Count +=1;
}else {
	if ( b.split(" ").length > 1){
		alert("Background field takes only one word!");	
		return false;
	}
}


var p= document.forms.Search.People.checked;
var g=document.forms.Search.Gender;
var ag=document.forms.Search.Age;

if (!p)
{
	Count +=1;
}


if ((g.options[g.selectedIndex].text) !== 'Select')
{
	if (!p){
		alert(" Please check the pox to select from Gender list!");
		return false;	
		}	
}
if (ag.options[ag.selectedIndex].text !== 'Select')
{
	if (!p){
		alert(" Please check the pox to select from Age group list!");
		return false;
	}		
}

if ( Count >= 9){
	alert(" You should enter or select at lest one field!");	
	return false;
}

}
function isValidDate(dateString){
    // First check for the pattern
    if(!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(dateString))
        return false;

    // Parse the date parts to integers
    var parts = dateString.split("-");
    var day = parseInt(parts[2], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[0], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 2017 || month === 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0))
        monthLength[1] = 29;

    // Check the range of the day
    return (day > 0 && day <= monthLength[month - 1]);
}


function isValidPeriod(SdateString,EdateString){

    // Parse the date parts to integers
    var Sparts = SdateString.split("-");
    var Sday = parseInt(Sparts[2], 10);
    var Smonth = parseInt(Sparts[1], 10);
    var Syear = parseInt(Sparts[0], 10);
    
    var Eparts = EdateString.split("-");
    var Eday = parseInt(Eparts[2], 10);
    var Emonth = parseInt(Eparts[1], 10);
    var Eyear = parseInt(Eparts[0], 10);
    
    // Check the ranges of month and year
    if(Syear === Eyear){
    	if ( Emonth === Smonth){
    		if ( Eday >= Sday){
    			return true;
    		}else{
        		return false;
        		}
        	}
        else if ( Emonth < Smonth) {
        	return false;
        	}
    }
    else if(Syear > Eyear){
    	return false;
        }
    return true;
}

function WordCount(str) { 
  return str.split(' ').length;
}
