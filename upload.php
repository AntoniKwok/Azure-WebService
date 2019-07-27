<?php
    require_once "vendor/autoload.php"; 
    use MicrosoftAzure\Storage\Blob\BlobRestProxy;
    use MicrosoftAzure\Storage\Common\ServiceException;
    if(isset($_POST['submit'])){
        $connectionString = "DefaultEndpointsProtocol=https;AccountName=".getenv('account_name').";AccountKey=".getenv('account_key');
        $namaFile = $_FILES['image']['name'];
        $namaSementara = $_FILES['image']['tmp_name'];
        
        $dirUpload = "";

        $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

        $blobClient = BlobRestProxy::createBlobService($connectionString);
 
        # Membuat BlobService yang merepresentasikan Blob service untuk storage account
        $createContainerOptions = new CreateContainerOptions();
    
        $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

        $containerName = "blobs".generateRandomString();
        
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