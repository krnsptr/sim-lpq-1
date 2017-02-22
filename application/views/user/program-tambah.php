  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tambah Program
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> SIM LPQ</a></li>
          <li>User</li>
          <li>Program</li>
          <li class="active">Tambah</li>
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
				<?php echo form_open(site_url('user/tambah/program'), '', array('keanggotaan' => $keanggotaan, 'program' => $program)); ?>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Sudah pernah ikut KBM di LPQ?</label>
							<div class="form-group has-feedback">
								<select class="form-control" name="sudah_lulus">
									<?php
										foreach(SUDAH_LULUS[$program] as $key => $value) {
										 	echo '<option value="'.$key.'">'.$value.'</option>'.PHP_EOL;
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
											 	echo '<option value="'.$i.'">'.$i.'</option>'.PHP_EOL;
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
									<option value="1">Ganjil (September&ndash;Januari)</option>
									<option value="2">Genap (Februari&ndash;Juni)</option>
								</select>
							</div>
						</div>
					</div>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-success btn-flat">Tambah</button>
							<a href="<?php echo site_url('user/dasbor');?>" class="btn btn-default btn-flat">Batal</a>
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
				<?php echo form_open(site_url('user/tambah/program'), '', array('keanggotaan' => $keanggotaan, 'program' => $program)); ?>
					<?php if($program == 1) { ?>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Pendaftaran</label>
							<div class="form-group has-feedback">
								<select class="form-control" name="pendaftaran">
									<option value="0">Pendaftaran baru</option>
									<option value="1">Pendaftaran ulang</option>
								</select><br />
								Pendaftaran ulang khusus Instruktur Tahsin lama yang sudah pernah mengikuti wawancara.<br />
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Memenuhi syarat</label>
							<div class="form-group has-feedback">
								<input type="checkbox" name="memenuhi_syarat[]" value="1"> Lulus Tahsin 2<br />
								<input type="checkbox" name="memenuhi_syarat[]" value="1"> Lulus Dauroh Syahadah<br />
								<input type="checkbox" name="memenuhi_syarat[]" value="1"> Berkompetensi mengajar<br />
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Alasan mendaftar</label>
							<div class="form-group has-feedback">
								<input type="text" class="form-control" name="alasan_mendaftar"><br />
							</div>
						</div>
					</div>
					<?php } else { ?>
					<div class="form-group col-md-12">
						<div class="col-md-5">
							<label class="control-group">Enrollment Key</label>
							<div class="form-group has-feedback">
								<input type="text" class="form-control" name="enrollment_key"><br />
								Rekrutmen tertutup khusus untuk yang telah menerima enrollment key.<br />
							</div>
						</div>
					</div>
					<?php
						}
					?>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-success btn-flat">Tambah</button>
							<a href="<?php echo site_url('user/dasbor');?>" class="btn btn-default btn-flat">Batal</a>
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