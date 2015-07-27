<!--<h2>Login</h2>
<div id="login_form">
    <form action="http://localhost/login/index.php/login/login_user" method="POST">
        <div>
            <label for="email">Email: </label>
            <input type="email" value="<?php //echo set_value('email'); ?>" name="email" />
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" value="" name="password" />
        </div>
        <div>
            <input type="submit" name="submit" value="Login" />
        </div>
    </form>
    <?php //echo validation_errors('<p class="error">'); ?>
    <?php //echo anchor('login/reset_password', 'Forgot your password?', 'title="Click here to reset your password"'); ?>
</div> -->

<h2>Login</h2>
<div id="login_form">
    <?php
    echo form_open('login/login_user');
    echo form_input('email', set_value('email', 'Email Adress'));
    echo form_password('password', '', 'placeholder="Password" class="password"');
    echo form_submit('submit', 'Login');
    echo form_close();
    echo validation_errors('<p class="error">');
    echo anchor('login/reset_password', 'Forgot your password?');
	echo br(1);
	echo anchor('register', 'Create an Account');
    ?>
</div> <!-- end #login_form -->