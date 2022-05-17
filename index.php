<?php
    require_once('templates/common.php');
?>

<!DOCTYPE html>
<html lang="en-US">
    <?php
        outputHead();
    ?>
    <body>
        <?php
            outputHeader();
            outputSideMenu();
            outputAds();
        ?>
        <div id="mainDiv" class="index">
            <section id ="search">
                <a class = "order" href="restaurants.php"><button><h2>Order Now!</h2></button></a>
                <h5><a class = "RegisterList" href="register.php">Not Registered?</a></h5>
                <!--if logged in-->
                <!--<a class = "order" href="restaurants.php"><h2>Order Now!</h2></a>-->
                <form action="#">
                    <input type ="text" placeholder="Cuisine, Restaurant name, ...">
                    <a class = "schName" href="restaurants.php"><button type ="submit" name="search">Search</button></a>
                </form>
            </section>
            <section id ="bestRestaurants">
                <article data-id ="1">
                    <a href="restaurant.php"><img src="https://picsum.photos/200?7"></a>
                    <p>Cozinha International</p>
                    <p>Portucale</p>
                    <p>Porto</p>
                    <p>Preço médio 35$</p>
                </article>
                <article data-id ="2">
                    <a href="restaurant.php"><img src="https://picsum.photos/200?8"></a>
                    <p>Cozinha International</p>
                    <p>Portucale</p>
                    <p>Porto</p>
                    <p>Preço médio 35$</p>
                </article>
                <article data-id ="3">
                    <a href="restaurant.php"><img src="https://picsum.photos/200?9"></a>
                    <p>Cozinha International</p>
                    <p>Portucale</p>
                    <p>Porto</p>
                    <p>Preço médio 35$</p>
                </article>
            </section>
            <section id = "close">
                map api
            </section>
        </div>
        <?php
            outputFooter();
        ?>
    </body>
</html>