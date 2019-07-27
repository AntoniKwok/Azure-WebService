<?php
    require_once "vendor/autoload.php"; 
    use MicrosoftAzure\Storage\Blob\BlobRestProxy;
    use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
    use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
    use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
    use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

    $connectionString = "DefaultEndpointsProtocol=https;AccountName=".'kwoks'.";AccountKey=".'GNU7bWnM4Ws5Zcg/FZB7T0YtVEd+kTgZpODhoydogcSCefqmDua3Z+zby8jne6iSlve0GuemBhIhXQ7nzH6J6Q=='.";BlobEndPoint=https://kwoks.blob.core.windows.net/mycontainer";
                        
    // $connectionString = "DefaultEndpointsProtocol=https;AccountN"
    $containerName = "mycontainer";
    //BlobEndpoint=https://kwoks.blob.core.windows.net/;QueueEndpoint=https://kwoks.queue.core.windows.net/;FileEndpoint=https://kwoks.file.core.windows.net/;TableEndpoint=https://kwoks.table.core.windows.net/;SharedAccessSignature=sv=2018-03-28&ss=bfqt&srt=sco&sp=rwdlacup&se=2019-07-27T21:22:57Z&st=2019-07-27T13:22:57Z&spr=https&sig=Z38KuCsjdMa5jTSCJxSOABrRhy2xr%2FqOewVN6XX%2Fd78%3D
    // die($connectionString);
    $blobClient = BlobRestProxy::createBlobService($connectionString);

    if(isset($_POST['submit'])){
        $namaFile = $_FILES['image']['name'];
        $namaSementara = $_FILES['image']['tmp_name'];

        $dirUpload = "";

        // print_r($blobClient);

        $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

        
        if ($terupload) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
            echo "<img src=".'https://bluejack.azurewebsites.net/'.$namaFile." alt=".$namaFile.">";
            $blobClient->createBlockBlob($containerName, $namaFile, $namaSementara);
        } else {
            echo "Upload Gagal!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Analyze Sample</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</head>
<body>
 
<script type="text/javascript">
    function processImage() {
        // **********************************************
        // *** Update or verify the following values. ***
        // **********************************************
 
        // Replace <Subscription Key> with your valid subscription key.
        var subscriptionKey = "f5a15439a30f4b18bbad8037243e950c";
 
        // You must use the same Azure region in your REST API method as you used to
        // get your subscription keys. For example, if you got your subscription keys
        // from the West US region, replace "westcentralus" in the URL
        // below with "westus".
        //
        // Free trial subscription keys are generated in the "westus" region.
        // If you use a free trial subscription key, you shouldn't need to change
        // this region.
        var uriBase =
            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
 
        // Request parameters.
        var params = {
            "visualFeatures": "Categories,Description,Color",
            "details": "",
            "language": "en",
        };
 
        // Display the image.
        var sourceImageUrl = "https://bluejack.azurewebsites.net/<?=$namaFile;?>";
        // document.querySelector("#sourceImage").src = sourceImageUrl;
 
        // Make the REST API call.
        $.ajax({
            url: uriBase + "?" + $.param(params),
 
            // Request headers.
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader(
                    "Ocp-Apim-Subscription-Key", subscriptionKey);
            },
 
            type: "POST",
 
            // Request body.
            data: '{"url": ' + '"' + sourceImageUrl + '"}',
        })
 
        .done(function(data) {
            // Show formatted JSON on webpage.
            $("#responseTextArea").val(JSON.stringify(data, null, 2));
        })
 
        .fail(function(jqXHR, textStatus, errorThrown) {
            // Display error message.
            var errorString = (errorThrown === "") ? "Error. " :
                errorThrown + " (" + jqXHR.status + "): ";
            errorString += (jqXHR.responseText === "") ? "" :
                jQuery.parseJSON(jqXHR.responseText).message;
            alert(errorString);
        });
    };
    
</script>
<button onclick="processImage()">Analyze image</button>
<div id="jsonOutput" style="width:600px; display:table-cell;">
        Response:
        <br><br>
        <textarea id="responseTextArea" class="UIInput"
                  style="width:580px; height:400px;"></textarea>
</div>