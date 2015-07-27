<?php

if ($logged_in)
{
    $username = $this->session->userdata('username');
    echo "Welcome to the Home Page, ($username)!</h2>";
	echo br(1);
    echo anchor('login/logout', 'Logout');
	echo br(1);
    echo anchor('login/open_change_password', 'Change Password');
}
else
{
    echo "<h2>Please login to see this site</h2>";
    echo anchor('login', 'Login');
}

?>

