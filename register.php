<?php
    require_once('templates/common.php');
    require_once('templates/form.php')
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
            ouputRegisterForm();
            outputFooter();
        ?>
    </body>
</html>