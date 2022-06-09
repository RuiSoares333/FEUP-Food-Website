<?php
    declare(strict_types = 1);

    function outputProfileInfo(Costumer $costumer){ ?>
        <section id="user">
            <img src="https://picsum.photos/200/200?<?=$costumer->id?>">
            <p id="profileSquare"></p>
            <p><b><?=$costumer->name?></b>@<?=$costumer->username?></p>
            <a href="../pages/edit_profile.php">Edit Profile</a>
        </section>
    <?php }

?>