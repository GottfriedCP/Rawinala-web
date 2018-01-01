<div class="container">
    <?php echo form_open('member/authenticate', ['class' => 'form-signin', 'id' => 'form-ci']);?>
    <?php
        if ($this->session->flashdata('captcha_error')) {
            echo '<p class="signin-error">Captcha salah</p>';
        }
        if ($this->session->flashdata('signin_error')) {
            echo '<p class="signin-error">Username atau password salah</p>';
        }
    ?>
    <h2>Silakan login</h2>
    <label class="sr-only" for="username">Username: </label>
    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>

    <label class="sr-only" for="password">Password: </label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

    <button name="btn_login_submit" class="g-recaptcha btn btn-lg btn-primary btn-block" data-badge="inline" data-sitekey="6Le1xzIUAAAAANn-8kWNrBw0yKT-l0-mLRVA7vxs" data-callback="onSubmit">Sign in</button>
    </form>
</div>