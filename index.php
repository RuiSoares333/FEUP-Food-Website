<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Super Legit Food</title>
        <meta charset="utf-8">
        <link rel = "stylesheet" href="style.css">
        <script src = "script.js" defer></script>
    </head>
    <body>
        <header>
            <h1>Super Legit Food</h1>
            <section id = "topnav">
                <input class = "search" type="text" placeholder="Search..">
                <a href = "login.php">Login</a>
                <!--if logged in-->
                <!--<a href ="profile.php">Profile</a> <a href = "shoping_cart.php">Shoping Cart</a>-->
            </section>
        </header>
        <nav id = "side-menu">
            <a href="#bestRestaurants">Most Legit Restaurants</a>
            <a href="#close">Close to You</a>
            <input id ="hamburger" type ="checkbox">
            <label class="hamburger" for="hamburger">Categories</label>
            <ul>
                <li><a href="index.php">ITALIAN</a></li>
                <li><a href="index.php">JAPANESE</a></li>
                <li><a href="index.php">PORTUGUESE</a></li>
                <li><a href="index.php">FAST FOOD</a></li>
                <li><a href="index.php">EUROPEAN</a></li>
                <li><a href="index.php">MEXICAN</a></li>
            </ul>
        </nav>
        <aside id ="ads">
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?1"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?1"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?1"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?1"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?1"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?1"></a>
        </aside>
        <section id ="search">
            <a class = "order" href="login.php"><h2>Order Now!</h2></a>
            <a class = "order" href="register.php"><h5>Not Registered?</h5></a>
            <!--if logged in-->
            <!--<a class = "order" href="restaurants.php"><h2>Order Now!</h2></a>-->
            <form action ="#">
                <input type ="text" placeholder="Search..">
                <button type ="submit" name="search">Search</button>
            </form>
        </section>
        <section id ="bestRestaurants">
            <ul>
                <li>restaurant</li>
                <li>restaurant</li>
                <li>restaurant</li>
                <li>restaurant</li>
                <li>restaurant</li>
                <li>restaurant</li>
            </ul>
        </section>
        <section id = "close">
            map api
        </section>
        <footer>
            <div class="teacher">
                <p>ANDRÈ RESTIVO</p>
                <P>DIOGO MACHADO</P>
            </div>
            <div class="rights">
                <p>ALL RIGHTS RESERVED &copy;</p>
                <p>SUPER LEGIT COMPANY</p>
            </div>
            <div class ="devTeam">
                <p>CATARINA CANELAS up202103628</p>
                <p>GONÇALO MARQUES up202008674</p>
                <p>RUI SOARES up202103631</p>
            </div>
            <div class = "socials">
                <p>fb</p>
                <p>twitter</p>
                <p>insta</p>
            </div>
            <p>LTW 2021/22</p>
        </footer>
    </body>
</html>