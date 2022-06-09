<?php
    declare(strict_types = 1);

    function outputProfileInfo(Costumer $costumer){ ?>
        <section id="user">
            <img src="../resources/users/0.jpg">
            <p id="profileSquare"></p>
            <p><b><?=$costumer->name?></b>@<?=$costumer->username?></p>
            <a href="../pages/edit_profile.php">Edit Profile</a>
        </section>
    <?php }

?>