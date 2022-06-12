<?php
    declare(strict_types = 1);

    
    function outputHead() { ?>
    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <title>Super Legit Food</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel = "stylesheet" href="../CSS/style.css">
            <link rel = "stylesheet" href="../CSS/layout.css">
            <link rel = "stylesheet" href="../CSS/forms.css">
            <link rel = "stylesheet" href="../CSS/images.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="../javascript/filter_header.js" defer></script>
    <?php }
?>

<?php
    function outputHeader(Session $session, array $categories, ?Costumer $user) { ?>
        <header>
            <h1><a href="../pages/index.php">Super Legit Food</a></h1>
            <div id = "topnav">
                <form action = "../pages/search.php?" class = "search">
                    <input class = "search" name = "search" type="text" placeholder="Cuisine, Restaurant name, ...">
                    <button type="button" id="filter"><img src="../assets/symbols/filter-solid.svg" for="" alt="filter"></button>
                    <dialog id="filterDialog">
                        <label for="rating">rating</label>
                        <select name ="rating">
                            <option selected value="-1">Any</option>
                            <?php 
                                for($i=1 ; $i < 10; $i++){
                                    ?> <option value ="<?=$i?>"><?=$i?></option> <?php
                                }
                            ?>
                        </select>
                        <label for="category">category</label>
                        <select name = "category">
                            <option selected value= "">Any</option>
                            <?php
                                foreach($categories as $category){
                                    ?> <option value = "<?=$category['name']?>"><?=$category['name']?></option> <?php
                                }
                            ?>
                        </select>
                        <button type="button">close</button>
                    </dialog>
                </form> 
                </div><?php
                    if($session->isLoggedin()){ 
                        $userImage = '../assets/users/icon/' . $user->id . '.webp';
                        $defaultImage = '../assets/users/icon/0.webp';
                        $image = (file_exists($userImage)) ? $userImage : $defaultImage;
                    }
                    if($session->isLoggedin()){ ?>
                        <div class="dropdown">
                            <img src="<?=$image?>" for="">
                            <div class="dropdown-content">
                                <a href= "../pages/profile.php">Profile</a>
                                <a href= "../pages/edit_profile.php">Profile Settings</a>
                                <a href = "../pages/cart.php">Cart</a>
                                <a href = "../pages/add_restaurant.php">Add new restaurant</a>
                                <a href = "../actions/action_logout.php">Logout</a>
                            </div>   
                        </div>
                    <?php } else {?>
                        <a href = "../pages/login.php">Login</a>
                <?php } ?>
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
    function outputAds(){ 
        $image = '../assets/advertising/';
        ?>
        <aside id ="ads">
            <?php
                for($i = 0; $i <6; $i++){
                    ?><a href = "https://rebrand.ly/r1ckr0l13r"><img src="<?=$image?><?=$i?>.webp" width="200" height = "200" ></a> <?php 
                }
            ?>
        </aside>
    <?php }
?>

<?php
    function outputSideMenu(array $categories) {?>
        <nav id="side-menu" class="index">
            <a href="../pages/index.php#bestRestaurants">Most Legit Restaurants</a>
            <a href="#close">Close to You</a>
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
                <a class = "order" href="../pages/search.php?search=&rating=-1&category="><button><h2>Order Now!</h2></button></a>
                <?php if(!$session->isLoggedin()){?> 
                <a class = "RegisterLink" href="../pages/register.php"><h5>Not Registered?</h5></a> <?php } ?>
                </form>
            </section>
    <?php }
?>


<?php
    function outputEditProfileSideMenu(){ ?>
        <nav id = "side-menu" class="edit_profile">
            <a href = "../pages/edit_profile.php">Edit Profile</a>
            <a href = "../pages/change_password.php">Change Password</a>
            <a href = "../pages/add_restaurant.php">Add Your Restaurant</a>
        </nav>
   <?php }
?>

<?php 
    function outputEditRestaurantSideMenu(){ ?>
        <nav id = "side-menu" class="edit_restaurant">
            <a href = "../pages/edit_restaurant.php?id=<?=$_GET['id']?>">Edit Restaurant</a>
            <a href = "../pages/manage_dishes.php?id=<?=$_GET['id']?>">Manage Dishes</a>
            <a href = "../pages/add_dish.php?id=<?=$_GET['id']?>">Add Dishes</a>
        </nav>
    <?php } 
?> 

<?php
    function outputShoppingCart(){ ?>
        <aside id ="cart">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan ="3">Total:</th><th>0</th>
                    </tr>
                </tfoot>
            </table>
            <button type="button">Order</button>
        </aside>
    <?php }
?>