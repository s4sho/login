<!--<h2>Change Your password</h2>
<div id="change_password_form">
    <form action="http://localhost/login/index.php/login/change_password" method="POST">
        <div>
            <label for="password">Current Password: </label>
            <input type="password_curr" value="" name="password" />
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
            <input type="submit" value="Change My password" name="submit" />
        </div>
    </form>
    <?php //echo validation_errors('<p class="error">');?>
</div>-->

<h2>Change Your password</h2>
<div id="change_password_form">
    <?php
    echo form_open('login/change_password');
    echo form_password('password_old', '', 'placeholder="Old Password: "');
    echo form_password('password_new', '', 'placeholder="New Password: "');
    echo form_password('password_new_conf', '', 'placeholder="New Password Confirmation: "');
    echo form_submit('submit', 'Change My Password');
    echo form_close();
    echo validation_errors('<p class="error">');
    ?>
</div> <!-- end #change_password_form -->