<?php
    declare(strict_types = 1);
    
    function ouputLoginForm() { ?>
    <div id="mainDiv" class="login">
        <p id="square"></p>
        <h1>Login</h1>
        <form id="loginForm" action="../actions/action_login.php" method="post">
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="hidden" name = "referer" value="<?=$_SERVER['HTTP_REFERER']?>">
            <button type="submit">Login</button>
        </form>
        <a class = "RegisterLink" href="../pages/register.php"><h5>Not Registered?</h5></a>
    </div>
    </div>
    <?php }

    function outputRegisterForm() { ?>
        <div id="mainDiv" class="register">
            <p id="squareRegister"></p>
            <h1>Register</h1>
            <form id="registerForm" name = "registerForm" action = "../actions/action_register.php" method = "post">
                <input id="username" type="text" name="username" maxlength="14" placeholder="username" required>
                <p></p>
                <input id ="name" type = "text" name = "name" maxlenght="14" placeholder="Display name" required>
                <p></p>
                <input id="email" type="email" name="email" maxlength="256" placeholder="email" required>
                <p></p>
                <input id="password" type="password" name="password1" placeholder="password" required>
                <p></p>
                <input id="password2" type="password" name="password2" placeholder="confirm password" required>
                <p></p>
                <input id="phone" type="text" name="phone" maxlength ="9" placeholder="phone number" required>
                <p></p>
                <input id="address" type="text" name="address" placeholder="address" required>
                <p></p>
                <input type="hidden" name="referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button id="continue" type ="submit">Register</button>
                <a href ="../pages/index.php">Cancel</a>
            </form>
            <a class = "LoginLink" href="../pages/login.php"><h5>Already have an account?</h5></a>
        </div>
        </div>
    <?php }
    
    
    function outputReviewForm() { ?>
        <section id ="newReview">
            <h1>Make a Review</h1>
            <form id = "reviewForm" action="../actions/action_add_review.php?id=<?=urlencode($_GET["id"])?>" method="post">
                <div class="ratingContainer">
                    <div class="rating">
                        <?php
                        for($i=10; $i>=1; $i--){
                            echo '<input type="radio" name="rating" value="'.$i.'">';
                        }
                        ?>
                    </div>
                </div>
                <p><b>Comment</b>(optional)</p>
                <textarea id = "review" name ="review" rows="4" cols="50" placeholder ="describe your experience!!"></textarea>
                <input type="hidden" name="date" class ="date">
                <button id = "submit" type="submit">Submit</button>  
            </form>    
        </section>
    <?php }


    function outputEditProfileForm(Costumer $costumer) { ?>
        <div id ="mainDiv" class = "edit_profile">
        <section id="edit_profile">
            <p id="squareEdit"></p>
            <h1>Edit Profile</h1>
            <form id = "edit_profile" action="../actions/action_edit_profile.php" method="post">
                <label for="name">Name:</label>
                <input id="name" type ="text" name ="name" value ="<?=$costumer->name?>" maxlength="14" required>
                <p></p>
                <label for="email">Email:</label>
                <input id="email" type ="text" name ="email" value ="<?=$costumer->email?>" maxlength="256" required>
                <p></p>
                <label for="address">Address:</label>
                <input id="address" type ="text" name ="address" value ="<?=$costumer->address?>" required>
                <p></p>
                <label for="phone">Phone number:</label>
                <input id="phone" type ="text" name ="phone" value ="<?=$costumer->phoneNumber?>" maxlength="9" required>
                <p></p>
                <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                <button id="submit" type ="submit">Edit</button>
            </form>
        </section>
        </div>
    </div>
    <?php }

    function outputChangePasswordForm(){ ?>
    <div id ="mainDiv" class="edit_profile">
        <section id ="changePassword">
            <p id="squareEdit"></p>
            <h1>Change Password</h1>
            <form id ="changePassword" action="../actions/action_change_password.php" method="post">
                <label for="oldPassword">old password:</label>
                <input id="oldPassword" type="password" name ="oldPassword" required>
                <p></p>
                <label for="newPassword">new password:</label>
                <input id="newPassword" type="password" name ="newPassword" required>
                <p></p>
                <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                <button id="submit" type="submit">Change Password</button>
            </form>  
        </section>
    </div>
    </div>
    <?php }

    function outputEditRestaurantForm(Restaurant $restaurant, array $categories){ ?>
        <div id ="mainDiv" class="editRestaurant">
            <section id ="editRestaurant">
                <p id="squareEdit"></p>
                <h1>Edit Restaurant</h1>
                <form id ="editRestaurant" action ="../actions/action_edit_restaurant.php?id=<?=$restaurant->id?>" method="post">
                    <label for="name">Name:</label>
                    <input id="name" type ="text" name ="name" value= "<?=$restaurant->name?>" required>
                    <p></p>
                    <label for="address">Address:</label>
                    <input id="address" type ="text" name ="address" value ="<?=$restaurant->address?>" required>
                    <p></p>
                    <button type ="button" id = "categories">categories</button>
                    <dialog id ="myDialog">
                        <h1>Choose the categories</h1>
                        <div id="listCategories">
                        <ul>
                        <?php foreach($categories as $category) {
                            ?><li><input type = "checkbox" name = "categories[]" value="<?=$category?>" <?php if(array_search($category,$restaurant->categories, true) !== false) echo 'checked'; ?>><?=str_replace('_', ' ', $category)?></input></li><?php
                        } ?>
                        </ul>
                        </div>
                        <button type="button">close</button>
                    </dialog>
                    <label for="phone">Phone:</label>
                    <input id="phone" type ="text" name ="phone" value ="<?=$restaurant->phone?>" required>
                    <p></p>
                    <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                    <button type ="submit">Edit</button>
                </form>
            </section>
        </div>
        </div>
    <?php }


    function outputAddDishForm(){ ?>
        <div id ="mainDiv" class="editRestaurant">
        <section id="newDish">
            <p id="squareEdit"></p>
            <h1>Add a new Dish</h1>
            <form id ="addDish" action="../actions/action_add_dish.php?id=<?=urlencode($_GET['id'])?>" method="post">
                <label for="name">Name:</label>
                <input id="name" type="text" name="name" required>
                <p></p>
                <label for="price">Price:</label>
                <input id="price" type ="text" name ="price" required>
                <p></p>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option disabled selected value>--choose a category--</option>
                    <option value ="appetizer">appetizer</option>
                    <option value="drink">drink</option>
                    <option value="soup">soup</option>
                    <option value="main_course">main course</option>
                    <option value ="dessert">dessert</option>
                </select>
                <p></p>
                <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                <button id ="submit" type="submit">Add</button>
            </form>
        </section>
    </div>
    </div>
    </div>
    <?php }


    function outputAddRestaurantForm(array $categories){ ?>
        <div id = "mainDiv" class ="newRestaurant">
            <section id = "newRestaurant">
                <p id="squareEdit"></p>
                <h1>Add your restaurant</h1>
                <form id ="newRestaurant" action ="../actions/action_add_restaurant.php" method="post">
                    <label for="name">Name:</label>
                    <input id="name" type ="text" name ="name" maxlength="50" required>
                    <p></p>
                    <label for="address">Address:</label>
                    <input id="address" type ="text" name ="address" required>
                    <p></p>
                    <button type = "button" id = "categories">categories</button>
                    <dialog id ="myDialog">
                        <h1>Choose the categories</h1>
                        <div id="listCategories">
                        <ul>
                        <?php foreach($categories as $category) {
                            ?><li><input type = "checkbox" name = "categories[]" value="<?=$category?>"><?=str_replace('_', ' ', $category)?></input></li><?php
                        } ?>
                        </ul>
                        </div>
                        <button type="button">close</button>
                    </dialog>
                    <label for="phone">Phone:</label>
                    <input id="phone" type ="text" name ="phone" maxlength = "9" required>
                    <p></p>
                    <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                    <button type="submit">Add</button>
                </form>
            </section>
        </div>
        </div>
    <?php }

    function outputSortSideMenu(array $categories) { 
        ?>
        <div>
        <input type="checkbox" id="responsiveSidebar"> 
        <label class="responsiveSidebar" for="responsiveSidebar"></label>
        <nav id="side-menu" class="sort">
            <form action="../pages/search.php" method="get">
                <input type="text" name="search" placeholder="Search">
                <label for ="rating">Rating</label>
                    <select name="rating">
                        <option selected value="-1">Any</option>
                        <?php
                            for($i=1; $i<10; $i++){
                                echo '<option value="'. $i .'">' . $i . '</option>';
                            }
                        ?>
                    </select>
                <label for = "category">Category</label>
                    <select name="category">
                        <option selected value = "">Any</option>
                        <?php
                            foreach($categories as $category){
                                ?> <option value = "<?=$category?>"><?=str_replace('_', ' ',$category)?></option> <?php
                            }
                        ?>
                    </select>
                <label for="price">Price</label>
                <input type="checkbox" id="price" name = "order" value = "value">
                <label class="price" for="price"></label><br>
                <button type = "submit">Search!</button>
            </form>
        </nav>
    <?php }
?>
