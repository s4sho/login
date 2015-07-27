<!--<h2>Update Your password</h2>
<div id="update_password_form">
    <form action="http://localhost/login/index.php/login/update_password" method="POST">
        <div>
            <label for="email">Email: </label>
            <?php //if (isset($email_hash, $email_code)) { ?>
            <input type="hidden" value="<?php //echo $email_hash ?>" name="email_hash" />
            <input type="hidden" value="<?php //echo $email_code ?>" name="email_code" />  
            <?php //} ?>
            <input type="email" value="<?php //echo (isset($email)) ? $email : ''; ?>" name="email" />
        </div>
        <div>
            <label for="password">New Password: </label>
            <input type="password" value="" name="password" />
        </div>
        <div>
            <label for="password_conf">New Password Again: </label>
            <input type="password" value="" name="password_conf" />
        </div>
        <div>
            <input type="submit" value="Update My password" name="submit" />
        </div>
    </form>
    <?php //echo validation_errors('<p class="error">');?>
</div>-->

<h2>Update Your password</h2>
<div id="update_password_form">
    <?php
    echo form_open('login/update_password');
    if (!isset($email))
    {
        $email='';
    }
    echo form_input('email', $email);
    echo form_hidden ('email_hash', $email_hash);
    echo form_hidden ('email_code', $email_code);
    echo form_password('password', '', 'placeholder="New Password" class="password"');
    echo form_password('password_conf', '', 'placeholder="New Password Confirmation" class="password_conf"');
    echo form_submit('submit', 'Update My Password');
    echo form_close();
    echo validation_errors('<p class="error">');
    ?>
</div> <!-- end $update_password_form -->