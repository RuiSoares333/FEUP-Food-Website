<?php
    declare(strict_types = 1);
    
    function outputHead() { ?>
    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <title>Super Legit Food</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel = "stylesheet" href="../CSS/layout.css">
            <link rel = "stylesheet" href="../CSS/images.css">
            <link rel = "stylesheet" href="../CSS/forms.css">
            <link rel = "stylesheet" href="../CSS/style.css">
            <script src = "script.js" defer></script>
        </head>
        <body>
    <?php }
?>

<?php
    function outputHeader(Session $session) { ?>
        <header>
            <h1><a href="../pages/index.php">Super Legit Food</a></h1>
            <div id = "topnav">
                <form action = "../pages/restaurants.php" method = "POST" class = "search">
                    <input class = "search" type="text" placeholder="Search...">
                </form> <?php
                    if($session->isLoggedin()){ ?>
                        <a href= "../pages/profile.php"></a>
                        <a href = "../actions/action_logout.php">Logout</a>
                        <a href = "../pages/cart.php"></a>
                    <?php } else {?>
                        <a href = "../pages/login.php">Login</a>
                <?php } ?>
            </div>
            
            <section id ="messages">
            <?php foreach($session->getMessages() as $message) {?>
                <article class = "<?=$message['type']?>">
                    <?=$message['text']?>
                </article>
                <?php } ?>
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
    function outputSideMenu(PDO $db) { 
        $query = 'SELECT name FROM RestaurantCategory';
        $categories = getQueryResults($db, $query, true, null);
        ?>
        <nav id="side-menu" class="index">
            <a id="bestRestHref" href="../pages/index.php#bestRestaurants">Most Legit Restaurants</a>
            <a id="closeHref" href="#close">Close to You</a>
            <input id ="hamburger" type ="checkbox">
            <label class="hamburger" for="hamburger">Categories</label>
            <ul>
                <?php
                    foreach($categories as $category){
                        ?> <li><a href= "../pages/index.php"><?=$category['name']?></a></li> <?php
                    }
                ?>
            </ul>
        </nav>
    <?php }
?>

<?php
    function outputSortSideMenu(PDO $db) { 
        $query = 'SELECT name FROM RestaurantCategory';
        $categories = getQueryResults($db, $query, true, null);
        ?>
        <nav id="side-menu" class="sort">
            <form>
                <input type="text" name="searchName" placeholder="Search">
                <label id="rating">Rating</label>
                    <select name="rating">
                        <option value="0">Any</option>
                        <?php
                            for($i=1; $i<10; $i++){
                                echo '<option value="'. $i .'">' . $i . '</option>';
                            }
                        ?>
                    </select>
                <label>Category</label>
                    <select name="category">
                        <option selected value = "">Any</option>
                        <?php
                            foreach($categories as $category){
                                ?> <option value = "<?=$category['name']?>"><?=$category['name']?></option> <?php
                            }
                        ?>
                    </select>
                <label id="prc">Price</label>
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
    </body>
    </html>
    <?php }
?>

<?php 
    function outputSearch(Session $session){ ?>
            <section id ="search">
                <a class = "order" <?php if($session->isLoggedin()) echo 'href="../pages/restaurants.php"'; else echo 'href="../pages/login.php"';?>><button><h2>Order Now!</h2></button></a>
                <?php if(!$session->isLoggedin()){?> 
                <a class = "RegisterLink" href="../pages/register.php"><h5>Not Registered?</h5></a> <?php } ?> 
                <form action="#">
                    <input type ="text" placeholder="Cuisine, Restaurant name, ...">
                    <button formaction = "../pages/restaurants.php" type ="submit" name="search">Search</button>
                </form>
            </section>
    <?php }
?>
