<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/firstPage.css') ?>">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Login</h1>
        </div>
        <form action="<?php echo site_url('Login/loginUser'); ?>" method="post">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Username" >
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit">Log In</button>
            </div>
        </form>
        <?php if ($this->session->flashdata('msg')): ?>
            <div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
