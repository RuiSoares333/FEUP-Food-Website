<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Super Legit Food</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" href="./CSS/layout.css">
        <link rel = "stylesheet" href="./CSS/style.css">
        <script src = "script.js" defer></script>
    </head>
    <body>
        <header>
            <h1>Super Legit Food</h1>
            <section id = "topnav">
                <input class = "search" type="text" placeholder="Search...">
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
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?2"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?3"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?4"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?5"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?6"></a>
        </aside>
        <div class="mainDiv">
            <section id ="search">
                <a class = "order" href="login.php"><button><h2>Order Now!</h2></button></a>
                <a class = "register" href="register.php"><h5>Not Registered?</h5></a>
                <!--if logged in-->
                <!--<a class = "order" href="restaurants.php"><h2>Order Now!</h2></a>-->
                <form action="#">
                    <input type ="text" placeholder="Cuisine, Restaurant name, ...">
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
        </div>

        <footer>
            <div class="teacher">
                <span class="toNormal">ANDRÉ</span>
                <span class="lname1">RESTIVO</span>
                <br>
                <span class="fname2">DIOGO</span>
                <span class="lname2">MACHADO</span>
            </div>
            <div class="rights">
                <span class="r">ALL RIGHTS RESERVED &copy;</span>
                <br>
                <span class="c">SUPER LEGIT COMPANY</span>
            </div>
            <div class ="devTeam">
                <span class="name1">CATARINA CANELAS</span>
                <span class="nr1">up202103628</span>
                <br>
                <span class="name2">GONÇALO MARQUES</span>
                <span class="nr2">up202008674</span>
                <br>
                <span class="name3">RUI SOARES</span>
                <span class="nr3">up202103631</span>
            </div>
            <div class = "socials">
                <p>fb</p>
                <p>twitter</p>
                <p>insta</p>
            </div>
            <div class = "course">
                <span class="cN">LTW</span>
                <span class="year">2021/22</span>
            </div>
        </footer>
    </body>
</html>