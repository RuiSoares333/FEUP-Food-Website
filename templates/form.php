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