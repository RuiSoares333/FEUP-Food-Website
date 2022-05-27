<?php
    declare(strict_types = 1);
    
    function ouputLoginForm() { ?>
    <div id="mainDiv" class="login">
        <br>
        <p id="square"></p>
        <h1>Login</h1>
        <form id="loginForm">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="hidden" name = "referer" value="<?=$_SERVER['HTTP_REFERER']?>">
            <button formaction="../actions/action_login.php" formmethod="post">Login</button>
        </form>
        <a class = "RegisterLink" href="../pages/register.php"><h5>Not Registered?</h5></a>
    </div>
    <?php }
?>

<?php
    function outputRegisterForm() { ?>
        <div id="mainDiv" class="register">
            <p id="squareRegister"></p>
            <h1>Register</h1>
            <form id="registerForm">
                <input id="username" type="text" name="username" placeholder="username">
                <input id ="name" type = "text" name = "name" placeholder="Display name">
                <input id="email" type="email" name="email" placeholder="email">
                <input id="password" type="password" name="password" placeholder="password">
                <input id="password2" type="password" name="repeat password" placeholder="repeat password">
                <input id="phone" type="text" name="phone" placeholder="phone number">
                <input id="address" type="text" name="address" placeholder="address">
                <input type="hidden" name="referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button id="continue" formaction="../actions/action_register.php" formmethod="post">Register</button>
                <button id="cancel" formaction="../pages/index.php">Cancel</button>
            </form>
            <a class = "LoginLink" href="../pages/login.php"><h5>Already have an account?</h5></a>
        </div>
    <?php }
    
    
    function outputReviewForm() { ?>
        <section id ="newReview">
            <h1>Make a Review</h1>
            <form id = "reviewForm">
                <select name = "rating">
                    <option value=""></option>
                    <?php for($i = 1; $i <= 10; $i++){
                        ?> <option value="<?=$i?>"><?=$i?></option> <?php
                    } ?>  
                </select>
                <p>Comment</p>
                <p>(optional)</p>
                <textarea id = "review" name ="review" rows="4" cols="50" placeholder ="describe your experience!!"></textarea>
                <button id = "submit" formaction="../actions/action_add_review.php?id=<?=$_GET["id"]?>" formmethod="post">Submit</button>  
            </form>    
        </section>
    <?php }


    function outputEditProfileForm(Costumer $costumer) { ?>
        <section id="edit_profile">
            <h1>Edit Profile</h1>
            <p id="squareEdit"></p>
            <form id = "edit_profile">
                <label for="name">Name:</label>
                <input type ="text" name ="name" value ="<?=$costumer->name?>">
                <label for="email">Email:</label>
                <input type ="text" name ="email" value ="<?=$costumer->email?>">
                <label for="address">Address:</label>
                <input type ="text" name ="address" value ="<?=$costumer->address?>">
                <label for="phone">Phone number:</label>
                <input type ="text" name ="phone" value ="<?=$costumer->phoneNumber?>">
                <button formaction="../actions/action_edit_profile.php" id="submit" formmethod="post">Edit</button>
            </form>
        </section>
    <?php }

    function outputChangePasswordForm(){ ?>
        <section id ="changePassword">
            <h1>Change Password</h1>
            <p id="squareEdit"></p>
            <form id ="changePassword">
                <label for="oldPassword">old password:</label>
                <input type="password" name ="oldPassword">
                <label for="newPassword">new password:</label>
                <input type="password" name ="newPassword">
                <button formaction="../actions/action_change_password.php" id="submit" formmethod="post">Change Password</button>
            </form>  
        </section>
    <?php }

    function outputEditRestaurantForm(Restaurant $restaurant){ 
        $selected = $restaurant->category;
        ?>
        <div id ="mainDiv" class="editRestaurant">
            <section id ="editRestaurant">
                <h1>Edit Restaurant</h1>
                <p id="squareEdit"></p>
                <form id ="editRestaurant">
                    <label for="name">Name:</label>
                    <input type ="text" name ="name" value= "<?=$restaurant->name?>">
                    <label for="address">Address:</label>
                    <input type ="text" name ="address" value ="<?=$restaurant->address?>">
                    <label for="category">Category:</label>
                    <select name ="category">
                        <option value ="italian" <?php if($selected == 'italian') echo 'selected'?>>italian</option>
                        <option value ="japanese" <?php if($selected == 'japanese') echo 'selected'?>>japanese</option>
                        <option value ="portuguese" <?php if($selected == 'portuguese') echo 'selected'?>>portuguese</option>
                        <option value ="fast food" <?php if($selected == 'fast food') echo 'selected'?>>fast food</option>
                        <option value ="european" <?php if($selected == 'european') echo 'selected'?>>european</option>
                        <option value ="mexican" <?php if($selected == 'mexican') echo 'selected'?>>mexican</option>
                    </select>
                    <label for="phone">Phone:</label>
                    <input type ="text" name ="phone" value ="<?=$restaurant->phone?>">
                    <button formaction="../actions/action_edit_restaurant.php?id=<?=$restaurant->id?>" id ="submit" formmethod="post">Edit</button>
                </form>
            </section>
        </div>
    <?php }
?>
