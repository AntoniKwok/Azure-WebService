<?php
    if($isset($_POST['submit'])){
        $namaFile = $_FILES['image']['name'];
        $namaSementara = $_FILES['image']['tmp_name'];

        $dirUpload = "images/";

        $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);


        if ($terupload) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
        } else {
            echo "Upload Gagal!";
        }
    }
?>