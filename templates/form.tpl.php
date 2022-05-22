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
                <label for = "rating">Rating</label>
                <select name = "rating">
                    <option value=""></option>
                    <?php for($i = 1; $i <= 10; $i++){
                        ?> <option value="<?=$i?>"><?=$i?></option> <?php
                    } ?>  
                </select>
                <label for="review">Review</label>
                <textarea id = "review" name ="review" rows="4" cols="50" placeholder ="describe your experience!!"></textarea>

            </form>    
        </section>
    <?php }
?>
