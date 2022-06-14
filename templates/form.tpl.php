<?php
    declare(strict_types = 1);
    
    function ouputLoginForm() { ?>
    <div id="mainDiv" class="login">
        <p id="square"></p>
        <h1>Login</h1>
        <form id="loginForm">
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="hidden" name = "referer" value="<?=$_SERVER['HTTP_REFERER']?>">
            <button formaction="../actions/action_login.php" formmethod="post">Login</button>
        </form>
        <a class = "RegisterLink" href="../pages/register.php"><h5>Not Registered?</h5></a>
    </div>
    </div>
    <?php }

    function outputRegisterForm() { ?>
        <div id="mainDiv" class="register">
            <p id="squareRegister"></p>
            <h1>Register</h1>
            <form id="registerForm">
                <input id="username" type="text" name="username" placeholder="username" required>
                <input id ="name" type = "text" name = "name" placeholder="Display name" required>
                <input id="email" type="email" name="email" placeholder="email" required>
                <input id="password" type="password" name="password1" placeholder="password" required>
                <input id="password2" type="password" name="password2" placeholder="confirm password" required>
                <input id="phone" type="text" name="phone" placeholder="phone number" required>
                <input id="address" type="text" name="address" placeholder="address" required>
                <input type="hidden" name="referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button id="continue" formaction="../actions/action_register.php" formmethod="post">Register</button>
                <button id="cancel" formaction="../pages/index.php">Cancel</button>
            </form>
            <a class = "LoginLink" href="../pages/login.php"><h5>Already have an account?</h5></a>
        </div>
        </div>
    <?php }
    
    
    function outputReviewForm() { ?>
        <section id ="newReview">
            <h1>Make a Review</h1>
            <form id = "reviewForm">
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
                <button id = "submit" formaction="../actions/action_add_review.php?id=<?=urlencode($_GET["id"])?>" formmethod="post">Submit</button>  
            </form>    
        </section>
    <?php }


    function outputEditProfileForm(Costumer $costumer) { ?>
        <div id ="mainDiv" class = "edit_profile">
        <section id="edit_profile">
            <p id="squareEdit"></p>
            <h1>Edit Profile</h1>
            <form id = "edit_profile">
                <label for="name">Name:</label>
                <input type ="text" name ="name" value ="<?=$costumer->name?>" required>
                <label for="email">Email:</label>
                <input type ="text" name ="email" value ="<?=$costumer->email?>" required>
                <label for="address">Address:</label>
                <input type ="text" name ="address" value ="<?=$costumer->address?>" required>
                <label for="phone">Phone number:</label>
                <input type ="text" name ="phone" value ="<?=$costumer->phoneNumber?>" required>
                <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                <button formaction="../actions/action_edit_profile.php" id="submit" formmethod="post">Edit</button>
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
            <form id ="changePassword">
                <label for="oldPassword">old password:</label>
                <input type="password" name ="oldPassword" required>
                <label for="newPassword">new password:</label>
                <input type="password" name ="newPassword" required>
                <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                <button formaction="../actions/action_change_password.php" id="submit" formmethod="post">Change Password</button>
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
                <form id ="editRestaurant">
                    <label for="name">Name:</label>
                    <input type ="text" name ="name" value= "<?=$restaurant->name?>" required>
                    <label for="address">Address:</label>
                    <input type ="text" name ="address" value ="<?=$restaurant->address?>" required>
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
                    <input type ="text" name ="phone" value ="<?=$restaurant->phone?>" required>
                    <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                    <button formaction="../actions/action_edit_restaurant.php?id=<?=$restaurant->id?>" type ="submit" formmethod="post">Edit</button>
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
            <form id ="addDish">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="price">Price:</label>
                <input type ="text" name ="price" required>
                <label for="category">Category:</label>
                <select name="category" required>
                    <option disabled selected value>--choose a category--</option>
                    <option value ="appetizer">appetizer</option>
                    <option value="drink">drink</option>
                    <option value="soup">soup</option>
                    <option value="main_course">main course</option>
                    <option value ="dessert">dessert</option>
                </select>
                <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                <button formaction="../actions/action_add_dish.php?id=<?=urlencode($_GET['id'])?>" id ="submit" formmethod="post">Add</button>
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
                <form id ="newRestaurant">
                    <label for="name">Name:</label>
                    <input type ="text" name ="name">
                    <label for="address">Address:</label>
                    <input type ="text" name ="address">
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
                    <input type ="text" name ="phone">
                    <input type ="hidden" name = "csrf" value ="<?=$_SESSION['csrf']?>">
                    <button formaction="../actions/action_add_restaurant.php" type="submit" formmethod="post">Add</button>
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
            <form>
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
                <button type = "submit" formaction = "../pages/search.php" formmethod="GET">Search!</button>
            </form>
        </nav>
    <?php }
?>
