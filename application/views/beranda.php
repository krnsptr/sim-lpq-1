<?php echo $error; ?>
<?php echo $success; ?>

<h2>Masuk ke SIM LPQ</h2>

<?php echo form_open(site_url('user/login')); ?>
<label>Username: </label><input type="text" name="username" /><br />
<label>Password: </label><input type="password" name="password"><br />
Belum terdaftar? <a href="<?php echo site_url('daftar'); ?>">Daftar</a><br />
<input type="submit" value="Login"><br />
<?php echo form_close(); ?>