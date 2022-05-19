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
                <input id="Um" type="text" name="username" placeholder="username">
                <input id="Dois" type="email" name="email" placeholder="email">
                <input id="Tres" type="password" name="password" placeholder="password">
                <input id="Quatro" type="password" name="repeat password" placeholder="repeat password">
                <input id="Cinco" type="phonenumber" name="phone number" placeholder="phone number">
                <input id="Seis" type="address" name="address" placeholder="address">
                <input type="hidden" name="referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button id="continue" formaction="../actions/action_register.php" formmethod="post">Register</button>
                <button id="cancel" formaction="../pages/index.php" formmethod="post">Cancel</button>
            </form>
            <a class = "LoginLink" href="../pages/login.php"><h5>Already have an account?</h5></a>
        </div>
    <?php } 
?>
