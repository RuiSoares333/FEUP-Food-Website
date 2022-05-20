<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/form.tpl.php');
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
            outputSortSideMenu();
            outputFooter();
        ?>
    </body>
</html>