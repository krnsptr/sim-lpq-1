<h2>Pendaftaran</h2>
<?php echo $error; ?>
<?php echo form_open(site_url('daftar/umum/proses')); ?>
	<label>Username: </label><input type="text" maxlength="16" name="username" value="<?php echo html_escape($post['username']) ?>" autocomplete="off"><br />
	<label>Password: </label><input type="password" name="password" autocomplete="off"><br />
	<label>Email: </label><input type="email" maxlength="64" name="email" value="<?php echo html_escape($post['email']); ?>" autocomplete="off"><br />
	<label>Nomor HP (SMS): </label><input type="text" maxlength="13" name="nomor_hp" value="<?php echo html_escape($post['nomor_hp']); ?>" autocomplete="off"><br /><br />

	<label>Nama Lengkap: </label><input type="text" maxlength="64" name="nama_lengkap" value="<?php echo html_escape($post['nama_lengkap']); ?>" autocomplete="off" ><br />
	<label>Nomor Identitas: </label><input type="text" maxlength="32" name="nomor_id" value="<?php echo html_escape($post['nomor_id']); ?>" autocomplete="off"><br />
	<label>Jenis Kelamin: </label>
	<select name="jenis_kelamin" autocomplete="off">
		<option value="0">Laki-Laki</option>
		<option value="1">Perempuan</option>
	</select><br />
	<label>Nomor WA (tidak wajib): </label><input type="text" name="nomor_wa" maxlength="13" value="<?php echo html_escape($post['nomor_wa']); ?>" autocomplete="off"><br />

	Sudah terdaftar? <a href="<?php echo site_url(); ?>">Login</a><br />

	<input type="submit" value="Login"><br />
<?php echo form_close(); ?>