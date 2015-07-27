<h2>Sign Up</h2>
<div id="register_form">
    <?php
    echo form_open('register/register_user');
    echo form_input('username', set_value('username', 'Username'));
    echo form_input('email', set_value('email', 'Email Adress'));
    echo form_password('password', '', 'placeholder="Password" class="password"');
    echo form_password('password_conf', '', 'placeholder="Confirm Password" class="password_conf"');
    echo form_submit('submit', 'Create Account');
    echo form_close();
    echo validation_errors('<p class="error">');
    ?>
</div> <!-- end #register_form -->