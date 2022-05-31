<?php
    declare(strict_types = 1);

    
    function outputHead() { 
    $styleFiles = array('../CSS/style.css', '../CSS/layout.css', '../CSS/forms.css', '../CSS/images.css',
                        '../CSS/layout/index.layout.css', '../CSS/style/index.style.css', 
                        '../CSS/layout/login.layout.css', '../CSS/style/login.style.css',
                        '../CSS/layout/register.layout.css', '../CSS/style/register.style.css',
                        '../CSS/layout/restaurant.layout.css', '../CSS/style/restaurant.style.css',
                        '../CSS/layout/search.layout.css', '../CSS/style/search.style.css');
                        ?>
    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <title>Super Legit Food</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php
            foreach($styleFiles as $file){
                echo '<link rel = "stylesheet" href="'.$file.'">';
            }
            ?>
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
                <form action = "../pages/search.php" method = "POST" class = "search">
                    <input class = "search" type="text" placeholder="Cuisine, Restaurant name, ...">
                </form> <?php
                    if($session->isLoggedin()){ ?>
                        <div class="dropdown">
                            <img src="https://picsum.photos/50/50" for="">
                            <div class="dropdown-content">
                                <a href= "../pages/profile.php">Profile</a>
                                <a href= "../pages/edit_profile.php">Profile Settings</a>
                                <a href = "../pages/cart.php">Cart</a>
                                <a href = "../actions/action_logout.php">Logout</a>
                            </div>   
                        </div>
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
    function outputSideMenu() { ?>
        <nav id="side-menu" class="index">
            <a href="../pages/index.php#bestRestaurants">Most Legit Restaurants</a>
            <a href="#close">Close to You</a>
            <input id ="hamburger" type ="checkbox">
            <label class="hamburger" for="hamburger">Categories</label>
            <ul>
                <li><a href="../pages/index.php">ITALIAN</a></li>
                <li><a href="../pages/index.php">JAPANESE</a></li>
                <li><a href="../pages/index.php">PORTUGUESE</a></li>
                <li><a href="../pages/index.php">FAST FOOD</a></li>
                <li><a href="../pages/index.php">EUROPEAN</a></li>
                <li><a href="../pages/index.php">MEXICAN</a></li>
            </ul>
        </nav>
    <?php }
?>

<?php
    function outputSortSideMenu() { ?>
        <nav id="side-menu" class="sort">
            <form>
                <input type="text" name="searchName" placeholder="Search">
                <label id="rating">Rating</label>
                    <select name="rating">
                        <option value="">Any</option>
                        <?php
                            for($i=1; $i<10; $i++){
                                echo '<option value="'. $i .'">' . $i . '</option>';
                            }
                        ?>
                    </select>
                <label>Category</label>
                    <select name="category">
                        <option value="emptyC">Any</option>
                        <option value="European">European</option>
                        <option value="Fast Food">Fast Food</option>
                        <option value="Italian">Italian</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Mexican">Mexican</option>
                        <option value="Portuguese">Portuguese</option>
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
    function outputSearch(){ ?>
            <section id ="search"><?php
                if(isset($_SESSION['id'])){ ?>
                    <a class = "order" href="../pages/login.php"><button><h2>Order Now!</h2></button></a>
                <?php } else { ?>
                    <a class = "order" href="../pages/search.php"><button><h2>Order Now!</h2></button></a>
                    <a class = "RegisterLink" href="../pages/register.php"><h5>Not Registered?</h5></a>
                <?php } ?>
            </section>
    <?php }
?>
