<?php
    declare(strict_types = 1);

    function outputProfileInfo(Costumer $costumer){ ?>
        <section id="user">
            <img src="../resources/users/0.jpg">
            <p id="profileSquare"></p>
            <h1><?=$costumer->name?></h1>
            <h4>@<?=$costumer->username?></h4>
            <a href="../pages/edit_profile.php">Edit Profile</a>
        </section>
    <?php }

?>