  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Edit Program
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> SIM LPQ</a></li>
          <li>User</li>
          <li>Program</li>
          <li class="active">Edit</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
		<?php
			if($keanggotaan == 1) {
		?>
        <div class="box box-default">
            <div class="box-header with-border">
				<h4><?php echo SANTRI.PROGRAM[$program]; ?></h4>
            </div>
			<div class="box-body">
				<?php echo form_open(site_url('user/edit/program'), '', array('keanggotaan' => $keanggotaan, 'program' => $program)); ?>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Sudah pernah ikut KBM di LPQ?</label>
							<div class="form-group has-feedback">
								<select class="form-control" name="sudah_lulus">
									<?php
										foreach(SUDAH_LULUS[$program] as $key => $value) {
										 	echo '<option value="'.$key.'"'.(($santri->sudah_lulus == $key) ? ' selected' : NULL).'>'.$value.'</option>'.PHP_EOL;
										 } 
									?>
								</select>
								<?php if($program == 2) echo 'Syarat untuk mendaftar '.PROGRAM[2].' minimal lulus Tahsin 2<br />'; ?>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Terakhir KBM tahun</label>
							<div class="form-group has-feedback">
								<select class="form-control" name="kbm_tahun">
									<?php if($program != 2) echo '<option>Belum pernah KBM di LPQ</option>'; ?>
										<?php
											if($program == 3) $j=2016; else $j=2011;
											for($i=2016; $i>=$j; $i--) {
											 	echo '<option value="'.$i.'"'.(($santri->kbm_tahun == $i) ? ' selected' : NULL).'>'.$i.'</option>'.PHP_EOL;
											 } 
										?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Terakhir KBM semester</label>
							<div class="form-group has-feedback">
								<select class="form-control" name="kbm_semester">
									<?php if($program != 2) echo '<option>Belum pernah KBM di LPQ</option>'; ?>
									<option value="1"<?php if($santri->kbm_semester == 1) echo ' selected'; ?>>Ganjil (September&ndash;Januari)</option>
									<option value="2"<?php if($santri->kbm_semester == 2) echo ' selected'; ?>>Genap (Februari&ndash;Juni)</option>
								</select>
							</div>
						</div>
					</div>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-primary btn-flat">Simpan</button>
							<a href="<?php echo site_url('user/dasbor');?>" class="btn btn-default btn-flat">Kembali</a>
						</div>
				<?php echo form_close(); ?>
			</div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php
			}
			else if($keanggotaan == 2) {
		?>
         <div class="box box-default">
            <div class="box-header with-border">
				<h4><?php echo PENGAJAR[$program].PROGRAM[$program]; ?></h4>
            </div>
			<div class="box-body">
				<?php echo form_open(site_url('user/edit/program'), '', array('keanggotaan' => $keanggotaan, 'program' => $program)); ?>
					<?php if($program == 1) { ?>
					<?php $pengajar->data2 = explode(':', $pengajar->data2, 4); ?>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Pendaftaran</label>
							<div class="form-group has-feedback">
								<select class="form-control" name="pendaftaran">
									<option value="0"<?php if($pengajar->data1 == 0) echo ' selected'; ?>>Pendaftaran baru</option>
									<option value="1"<?php if($pengajar->data1 == 1) echo ' selected'; ?>>Pendaftaran ulang</option>
								</select><br />
								Pendaftaran ulang khusus Instruktur Tahsin lama yang sudah pernah mengikuti wawancara.<br />
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Memenuhi syarat</label>
							<div class="form-group has-feedback">
								<input type="checkbox" name="memenuhi_syarat[]" value="1"<?php if($pengajar->data2[0] == 1) echo ' checked'; ?>> Lulus Tahsin 2<br />
								<input type="checkbox" name="memenuhi_syarat[]" value="1"<?php if($pengajar->data2[1] == 1) echo ' checked'; ?>> Lulus Dauroh Syahadah<br />
								<input type="checkbox" name="memenuhi_syarat[]" value="1"<?php if($pengajar->data2[2] == 1) echo ' checked'; ?>> Berkompetensi mengajar<br />
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Alasan mendaftar</label>
							<div class="form-group has-feedback">
								<input type="text" class="form-control" name="alasan_mendaftar" value="<?php echo htmlspecialchars($pengajar->data3); ?>"><br />
							</div>
						</div>
					</div>
					<?php } else { ?>
					<div class="form-group col-md-12">
						Tidak ada data yang bisa diubah.
					</div>
					<?php
						}
					?>
						<div class="col-md-2">						
							<?php if($program == 1) { ?><button type="submit" class="btn btn-primary btn-flat">Simpan</button><?php } ?>
							<a href="<?php echo site_url('user/dasbor');?>" class="btn btn-default btn-flat">Kembali</a>
						</div>
				<?php echo form_close(); ?>
			</div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php
			}
		?>
      </section>
    </div>
    <!-- /.container -->
  </div>