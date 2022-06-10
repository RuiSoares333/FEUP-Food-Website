<?php
    declare(strict_types = 1);

    function outputProfileInfo(Costumer $costumer){ 
        $userImage = '../assets/users/profile/' . $costumer->id . '.webp';
        $defaultImage = '../assets/users/profile/0.webp';
        $image = (file_exists($userImage)) ? $userImage : $defaultImage;
        ?>
        <div id ="mainDiv" class ="profile">
        <section id="user">
            <form method = "POST" action = "../actions/action_upload_user.php" enctype="multipart/form-data" id="upload">
            <input type="file" id = "imgupload" name="image" style="display:none"/>
            <button type="button"><img src="<?=$image?>"></button>
            </form>
            <p id="profileSquare"></p>
            <p><b><?=$costumer->name?></b>@<?=$costumer->username?></p>
        </section>
    <?php }

?>