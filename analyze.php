<!DOCTYPE html>
<html>
<head>
    <title>Analyze</title>
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">@import "style.css";</style>
</head>
<body>
<div id="back">

<div id="back1">
<?php
include 'header.php';
?>
<div class="page">
    <div class="title"><h2>Analyze</h2></div>
    <div class="container">
       
        <div class="userInterface">
            Enter the URL to an image of an image you want to analyze, the click the <strong>Analyze image</strong> button.
            <br><br>
            Image to analyze: <input type="text" name="inputImage" id="inputImage" value="Enter image URL here." />
            <button onclick="analyzeButtonClick()">Analyze Image</button>
            <br><br>
            <div class="wrapper">
                <div class="jsonOutput">
                    Response:
                    <br><br>
                    <form action= "AddForm.php" onsubmit = "return AddValue()" method="POST" name="Add">
                    <input type="hidden" name="URL" id="URL" value = "" />
                    <textarea id="responseTextArea" name="responseTextArea" class="UIInput"></textarea>
                    <form/>
				</div>
                <div class="pad"></div>
                <div class="imageDiv">
                    Source image:<br>
                    <span id="captionSpan"></span><br>
                    <img id="sourceImage" onerror="common.imageLoadError()"/>
                </div>
            </div>
            <div class="subKeyDiv">
                Subscription Key: 
                <input 
                    type="text" 
                    class="subKeyInput" 
                    name="subscriptionKeyInput" 
                    id="subscriptionKeyInput" 
                    onchange="common.subscriptionChange()" 
                    value="93d8b0202287407db6f2250ee69667b5" />
                Subscription Region: 
                <select name="subscriptionRegionSelect" id="subscriptionRegionSelect" onchange="common.subscriptionChange()">
                    <option value="westcentralus">westcentralus</option>
                    <option value="westus">westus</option>
                    <option value="eastus2">eastus2</option>
                    <option value="westeurope">westeurope</option>
                    <option value="southeastasia">southeastasia</option>
                </select>
                Add image information to database: <input type = "submit"  value = "Submit"/> <br>
            </div>
        </div>
   
   </div>
</div>
<?php
include 'footer.php';
?>
</div>
</div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="common.js"></script>

<script type="text/javascript">

function analyzeButtonClick() {

    // Clear the display fields.
    $("#sourceImage").attr("src", "#");
    $("#responseTextArea").val("");
    $("#captionSpan").text("");
    
    // Display the image.
    var sourceImageUrl = $("#inputImage").val();
    $("#sourceImage").attr("src", sourceImageUrl);
    
    AnalyzeImage(sourceImageUrl, $("#responseTextArea"), $("#captionSpan"));
}

/* Analyze the image at the specified URL by using Microsoft Cognitive Services Analyze Image API.
 * @param {string} sourceImageUrl - The URL to the image to analyze.
 * @param {<textarea> element} responseTextArea - The text area to display the JSON string returned
 *                             from the REST API call, or to display the error message if there was 
 *                             an error.
 * @param {<span> element} captionSpan - The span to display the image caption.
 */
function AnalyzeImage(sourceImageUrl, responseTextArea, captionSpan) {
    // Request parameters.
    var params = {
        "visualFeatures": "Categories,Color,Tags,Faces",
        "details": "",
        "language": "en",
    };
    
    // Perform the REST API call.
    $.ajax({
        url: common.uriBasePreRegion + 
             $("#subscriptionRegionSelect").val() + 
             common.uriBasePostRegion + 
             common.uriBaseAnalyze +
             "?" + 
             $.param(params),
                    
        // Request headers.
        beforeSend: function(jqXHR){
            jqXHR.setRequestHeader("Content-Type","application/json");
            jqXHR.setRequestHeader("Ocp-Apim-Subscription-Key", 
                encodeURIComponent($("#subscriptionKeyInput").val()));
        },
        
        type: "POST",
        
        // Request body.
        data: '{"url": ' + '"' + sourceImageUrl + '"}',
    })
    
    .done(function(data) {
        // Show formatted JSON on webpage.
        responseTextArea.val(JSON.stringify(data, null, 2));
        
        // Extract and display the caption and confidence from the first caption in the description object.
        if (data.description && data.description.captions) {
            var caption = data.description.captions[0];

            //if (caption.text && caption.confidence) {
               // captionSpan.text("Caption: " + caption.text +
                //    " (confidence: " + caption.confidence + ").");
            //}
        }
    })
    
    .fail(function(jqXHR, textStatus, errorThrown) {
        // Prepare the error string.
        var errorString = (errorThrown === "") ? "Error. " : errorThrown + " (" + jqXHR.status + "): ";
        errorString += (jqXHR.responseText === "") ? "" : (jQuery.parseJSON(jqXHR.responseText).message) ? 
            jQuery.parseJSON(jqXHR.responseText).message : jQuery.parseJSON(jqXHR.responseText).error.message;
        
        // Put the error JSON in the response textarea.
        responseTextArea.val(JSON.stringify(jqXHR, null, 2));
        
        // Show the error message.
        alert(errorString);
    });
}

function AddValue(){
	var URL = document.getElementById("inputImage").value;
	document.getElementById("URL").value = URL;
	}
	
</script>
