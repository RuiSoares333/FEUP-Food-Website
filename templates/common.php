<?php
    function outputHead() { ?>
        <head>
            <title>Super Legit Food</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel = "stylesheet" href="./CSS/layout.css">
            <link rel = "stylesheet" href="./CSS/forms.css">
            <link rel = "stylesheet" href="./CSS/style.css">
            <script src = "script.js" defer></script>
        </head>
    <?php }
?>

<?php
    function outputHeader() { ?>
        <header>
            <h1><a href="index.php">Super Legit Food</a></h1>
            <div id = "topnav">
                <input class = "search" type="text" placeholder="Search...">
                <a href = "login.php">Login</a>
                <!--<a href= "profile.php"><span><?=$_SESSION['username']?><span></a>-->
                <!--<a href = "cart.php">Shoping Cart</a>-->
            </section>
        </header>
    <?php }
?>

<?php
    function outputAds(){ ?>
        <aside id ="ads">
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?1"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?2"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?3"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?4"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?5"></a>
            <a href = "https://rebrand.ly/r1ckr0l13r"><img src="https://picsum.photos/200?6"></a>
        </aside>
    <?php }
?>

<?php
    function outputSideMenu() { ?>
        <nav id="side-menu" class="index">
            <a id="bestRestHref" href="#bestRestaurants">Most Legit Restaurants</a>
            <a id="closeHref" href="#close">Close to You</a>
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
    <?php }
?>

<?php
    function outputSortSideMenu() { ?>
        <nav id="side-menu" class="sort">
            <form>
                <label>Search</label>
                <input type="text" name="restName" placeholder="Restaurant Name">
                <label>Ratings</label>
                    <select name="rating">
                        <option value="emptyS">Select a Rating [1-5]</option>
                        <option value="1">&#9733;</option>
                        <option value="2">&#9733;&#9733;</option>
                        <option value="3">&#9733;&#9733;&#9733;</option>
                        <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                    </select>
                <label>Category</label>
                    <select name="category">
                        <option value="emptyC">Select a Category</option>
                        <option value="European">European</option>
                        <option value="Fast Food">Fast Food</option>
                        <option value="Italian">Italian</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Mexican">Mexican</option>
                        <option value="Portuguese">Portuguese</option>
                    </select>
                <label>Price</label>
                <input type="checkbox" id="price">
                <label class="price" for="price"></label><br>
                <input type="hidden" name = "referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button formaction="../actions/action_login.php" formmethod="post">Sort!</button>
            </form>
        </nav>
    <?php }
?>

<?php
    function outputFooter(){ ?>
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
    <?php }
?>