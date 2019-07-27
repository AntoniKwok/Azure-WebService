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

            $listBlobsOptions = new ListBlobsOptions();
            $listBlobsOptions->setPrefix("");
            $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
        } else {
            echo "Upload Gagal!";
        }
    }
?>

