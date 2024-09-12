<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waterboard Account Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/homepage.css') ?>">
</head>
<body>
    <div class="login-root">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <h1>NWSDB - MATARA REGION</h1>
                <?php if ($this->session->flashdata('msg')): ?>
                    <div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
                <?php endif; ?>
                <form id="loginForm" action="<?php echo site_url('Login/loginUser'); ?>" method="post">
                    <div class="field padding-bottom--24">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        <a class="reset-pass" href="#">Forgot your password?</a>
                    </div>
                    <div class="field field-checkbox padding-bottom--24">
                        <label>
                            <input type="checkbox" name="staySignedIn"> Stay signed in for a week
                        </label>
                    </div>
                    <div class="field padding-bottom--24">
                        <input type="submit" value="Continue">
                    </div>
                    <div class="footer-link padding-bottom--24">
                        <span>Don't have an account? <a href="#">Sign up</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
