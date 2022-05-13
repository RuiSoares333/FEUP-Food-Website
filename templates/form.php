<?php
    function ouputLoginForm() { ?>
        <section id = "login">
            <h1>Login</h1>
            <form>
                <label>
                    Username <input type="text" name="username">
                </label>
                <label>
                    Password <input type="password" name="password">
                </label>
                <input type="hidden" name = "referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button formaction="../actions/action_login.php" formmethod="post">Login</button>
            </form>
            <a class = "register" href="register.php"><h5>Not Registered?</h5></a>
        </section>
    <?php }
?>

<?php
    function outputRegisterForm() { ?>
        <section id="register">
            <h1>Register</h1>
            <form>
                <label>
                    Username <input type="text" name="username">
                </label>
                <label>
                    Real name <input type="text" name="name">
                </label>
                <label>
                    E-mail <input type="email" name="email">
                </label>
                <label>
                    Password <input type="password" name="password">
                </label>
                <label>
                    Password2 <input type="password" name="repeat password">
                </label>
                <label>
                    PhoneNumber <input type="phonenumber" name="phone number">
                </label>
                <label>
                    Address <input type="address" name="address">
                </label>
                <input type="hidden" name="referer" value="<?=$_SERVER['HTTP_REFERER']?>">
                <button formaction="./actions/action_register.php" formmethod="post">Register</button>
                <button formaction="./actions/action_index.php" formmethod="post">Cancel</button>
            </form>
            <a class = "login" href="login.php"><h5>Already have an account?</h5></a>
        </section>
    <?php } 
?>
