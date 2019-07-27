<?php
    require_once "vendor/autoload.php"; 
    use MicrosoftAzure\Storage\Blob\BlobRestProxy;
    use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
    use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
    use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
    use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

    $connectionString = "DefaultEndpointsProtocol=https://kwoks.blob.core.windows.net/mycontainer;AccountName=".'kwoks'.";AccountKey=".'GNU7bWnM4Ws5Zcg/FZB7T0YtVEd+kTgZpODhoydogcSCefqmDua3Z+zby8jne6iSlve0GuemBhIhXQ7nzH6J6Q==';
    $containerName = "mycontainer";
    $blobClient = BlobRestProxy::createBlobService($connectionString);

    if(isset($_POST['submit'])){
        $namaFile = $_FILES['image']['name'];
        $namaSementara = $_FILES['image']['tmp_name'];

        $dirUpload = "";

        $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

        
        if ($terupload) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
            $blobClient->createBlockBlob($containerName, $namaFile, $namaSementara);

            $listBlobsOptions = new ListBlobsOptions();
            $listBlobsOptions->setPrefix("");
            $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
        } else {
            echo "Upload Gagal!";
        }
    }
?>