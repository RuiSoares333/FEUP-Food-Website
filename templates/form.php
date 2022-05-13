<?php
    function ouputLoginForm() { ?>
    <div id="mainDiv" class="login">
        <br>
        <p id="square"></p>
        <h1>Login</h1>
        <form id="loginForm">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="hidden" name = "referer" value="<?=$_SERVER['HTTP_REFERER']?>">
            <button formaction="../actions/action_login.php" formmethod="post">Login</button>
        </form>
        <a class = "register" href="register.php"><h5>Not Registered?</h5></a>
    </div>
    <?php }
?>

<?php
    function outputRegisterForm() { ?>
        <div id="mainDiv" class="register">
            <p id="square"></p>
            <h1>Register</h1>
            <form>
                <input type="text" name="username" placeholder="username">
                <input type="email" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <input type="password" name="repeat password" placeholder="repeat password">
                <input type="phonenumber" name="phone number" placeholder="phone number">
                <input type="address" name="address" placeholder="address">
                <input type="hidden" name="referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button formaction="./actions/action_register.php" formmethod="post">Register</button>
                <button formaction="./index.php" formmethod="post">Cancel</button>
            </form>
            <a class = "login" href="login.php"><h5>Already have an account?</h5></a>
        </div>
    <?php } 
?>
