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