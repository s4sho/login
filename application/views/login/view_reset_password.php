<!--<h2>Reset Password</h2>
<div id="reset_password_form">
    <form action="http://localhost/login/index.php/login/reset_password" method="POST">
        <div>
            <label for="email">Email: </label>
            <input type="email" value="<?php //echo set_value('email'); ?>" name="email" />
        </div>
        <div>
            <input type="submit" value="Reset My Password" name="submit" />
        </div>
        <?php
            //echo validation_errors('<p class="error">');
            //if (isset($error))
            //{
            //    echo '<p class="error">'.$error.'</p>';
            //}
        ?>
    </form>
</div>-->

<h2>Reset Password</h2>
<div id="reset_password_form">
    <?php
    echo form_open('login/reset_password');
    echo form_input('email', set_value('email', 'Email Adress'));
    echo form_submit('submit', 'Reset My Password');
    echo validation_errors('<p class="error">');
    if (isset($error))
    {
       echo '<p class="error">'.$error.'</p>';
    }
    echo form_close();
    ?>
</div>