<?php
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/form.php')
?>
<!DOCTYPE html>
<html lang ="en-US">
    <?php
        outputHead();
    ?>
    <body>
        <?php
            outputHeader();
            outputAds();
            outputSideMenu();
            outputRegisterForm();
            outputFooter();
        ?>
    </body>
</html>