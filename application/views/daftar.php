  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Pendaftaran
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> SIM LPQ</a></li>
          <li class="active">Daftar</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
		<?php if(!empty($error)) { ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>
				<?php echo $error; ?>
			</div>
		<?php } ?>
		<?php if(!empty($info)) { ?>
            <div class="callout callout-info">
                <h4><i class="icon fa fa-info"></i>&emsp;Pengumuman</h4>
                <?php echo $info; ?>
            </div>
			<?php } ?>
        <div class="box box-default">
          <div class="box-body">
				<?php echo form_open(site_url('daftar/proses'),'data-toggle="validator"'); ?>
					<div class="col-md-6">
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Username</label>
								<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo html_escape($post['username']) ?>" pattern="[a-z0-9_]{4,16}" data-pattern-error = "Username hanya boleh mengandung huruf kecil, angka, dan underscore (4-16 karakter)." data-required-error="Username wajib diisi." required>
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Password</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Password" data-minlength="6" data-error="Password minimum 6 karakter." data-required-error="Password wajib diisi." required>
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Ulangi Password</label>
								<input type="password" name="ulangi_password" class="form-control" placeholder="Password" data-minlength="6" data-match="#password" data-error="Password minimum 6 karakter." data-required-error="Password wajib diulangi." data-match-error="Password tidak sama." required>
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Alamat Email</label>
								<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo html_escape($post['email']); ?>" data-error="Format email salah." data-required-error="Email wajib diisi." required>
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Nomor HP (SMS)</label>
								<input type="text" name="nomor_hp" class="form-control" placeholder="08xxxxxxxxxx" value="<?php echo html_escape($post['nomor_hp']); ?>" pattern="08[0-9]{8,11}" data-pattern-error="Format nomor HP salah. Contoh: 081234567890 (10-13 digit)." data-required-error="Nomor HP wajib diisi." required>
								<span class="glyphicon glyphicon-earphone form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Nama Lengkap</label>
								<input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap sesuai identitas" value="<?php echo html_escape($post['nama_lengkap']); ?>" data-required-error="Nama lengkap wajib diisi." required>
								<span class="glyphicon glyphicon-flower form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Nomor Identitas</label>
								<input type="text" name="nomor_id" class="form-control" placeholder="NIM / NIP / KTP / SIM / KK / ..." value="<?php echo html_escape($post['nomor_id']); ?>" data-required-error="Nomor Identitas wajib diisi." required>
								<span class="glyphicon glyphicon- form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Jenis Kelamin</label>
								<select name="jenis_kelamin" class="form-control" required>
									<option value="0"<?php if($post['jenis_kelamin'] == 0) echo ' selected'; ?>> Laki-laki </option>
									<option value="1"<?php if($post['jenis_kelamin'] == 1) echo ' selected'; ?>> Perempuan </option>
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="row" style="margin:10px 10px 10px 10px">
							<div class="form-group has-feedback">
								<label class="control-group">Nomor WA (tidak wajib)</label>
								<input type="text" name="nomor_wa" class="form-control" placeholder="08xxxxxxxxxxx" value="<?php echo html_escape($post['nomor_wa']); ?>" pattern="08[0-9]{8,11}" data-pattern-error="Format nomor HP salah. Contoh: 081234567890 (10-13 digit).">
								<span class="glyphicon glyphicon form-control-feedback"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>
					<div>
						<div class="col-md-10">
							Pastikan semua data terisi benar.<br />
							<strong>Username dan Password harap diingat dengan baik</strong>.<br />
							Sudah terdaftar? <a href="<?php echo site_url(); ?>">Login</a><br />
						</div>
						<div class="col-md-2">
						  <button type="submit" class="btn btn-success btn-block btn-flat">Daftar</button>
						</div>
					</div>
				<?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
