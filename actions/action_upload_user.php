<?php
    $target_dir = __DIR__ . '/../resources/' . $_POST['dir'] . '/';

    $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
    $uploadOk = true;

    $imageFileType = strtolower($_FILES['fileToUpload']['tmp_name']);

    if(isset($_POST))
?>