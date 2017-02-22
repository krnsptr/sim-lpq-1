<?php
	$program_santri = array();
	$program_pengajar = array();

	if(is_array($program['santri'])) foreach ($program['santri'] as $object) {
		$program_santri[$object->program] = TRUE;
	}
	if(is_array($program['pengajar']))foreach ($program['pengajar'] as $object) {
		$program_pengajar[$object->program] = TRUE;
	}
?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Penjadwalan
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> SIM LPQ</a></li>
          <li>User</li>
          <li class="active">Penjadwalan</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
		<div style="margin-top:10px">
			<?php if(!empty($error)) { ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>
				<?php echo $error; ?>
			</div>
			<?php } ?>
			<?php if(!empty($warning)) { ?>
			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
				<?php echo $warning; ?>
			</div>
			<?php } ?>
			<?php if(!empty($success)) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                <?php echo $success; ?>
            </div>
			<?php } ?>
			<?php if(!empty($info)) { ?>
            <div class="callout callout-info">
                <h4><i class="icon fa fa-info"></i>&emsp;Pengumuman</h4>
                <?php echo $info; ?>
            </div>
			<?php } ?>
		</div>
		<?php
			if(is_array($program['pengajar'])) foreach($program['pengajar'] as $p) {
				$jadwal = $p->jadwal;
		?>
        <div class="box box-default">
            <div class="box-header with-border">
            	<h4><?php echo PENGAJAR[$p->program].PROGRAM[$p->program]; ?></h4>
            </div>
            <?php if(!$penjadwalan_pengajar) { ?>
            	<div class="box-body table-condensed">Penjadwalan pengajar sudah ditutup.</div>
            <?php } else {?>
			<div class="box-body table-condensed">
				<?php echo form_open('user/edit/jumlah-kelompok','',array('program' => $p->program)); ?>
					<div class="form-group col-md-4">
						<label class="control-group col-md-12"> Jumlah kelompok yang siap dibina</label>
						<div class="col-md-4">
							<div class="form-group has-feedback">
								<input type="number" class="form-control" name="jumlah_kelompok" value="<?php echo $p->jumlah_kelompok; ?>">
							</div>
						</div>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-primary btn-flat">Ubah</button>
						</div>
					</div>
				<?php echo form_close() ?>
				<?php echo form_open('user/tambah/jadwal/2','',array('program' => $p->program)); ?>
					<div class="form-group col-md-8">
						<label class="control-group col-md-12"> Tambah alternatif (durasi 2 jam)</label>
						<div class="col-md-8">
							<div class="form-group has-feedback">
							  <div class="col-md-6">
								<select name="hari" class="form-control">
									<?php
										foreach(HARI as $key => $value) {
											echo '<option value="'.$key.'"'.'>'.$value.'</option>';
										}
									?>
								</select>
							  </div>
							  <div class="col-md-6">
								<input type="text" name="waktu" class="form-control" value="00:00">
							  </div>
							</div>
						</div>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-success btn-flat">Tambah</button>
						</div>
					</div>
				<?php echo form_close(); ?>
				<table class="table">
					<thead>
						<tr>
							<th>Alternatif (Jadwal kosong)</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(is_array($jadwal)) foreach($jadwal as $j) {
								echo form_open('user/edit/jadwal/2','',array('id_jadwal' => $j->id_jadwal, 'program' => $p->program));
						?>
						<tr>
							<td>
								<div class="col-md-3">
									<select name="hari" class="form-control">
										<?php
											foreach(HARI as $key => $value) {
												echo '<option value="'.$key.'"'.(($j->hari == $key) ? ' selected' : NULL).'>'.$value.'</option>';
											}
										?>
									</select>
								</div>
								<div class="col-md-3">
									<input type="text" name="waktu" class="form-control" value="<?php echo date_create($j->waktu)->format('H:i'); ?>">
								</div>
							</td>
							<td>
								<input type="submit" class="btn btn-primary btn-flat" value="Ubah">
								<a href="<?php echo site_url('user/jadwal/hapus/'.$p->program.'/'.$j->id_jadwal); ?>" class="btn btn-danger btn-flat">Hapus</a>
							</td>
							<?php
								echo form_close();
							?>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
          	<!-- /.box-body -->
          	<div class="box-footer">
          		Jumlah alternatif disarankan lebih dari jumlah kelompok yang siap dibina.<br />
				Pengajar <strong>bertanggung jawab penuh</strong> atas jadwal yang dipilih.<br />
				Departemen Administrasi akan menentukan jadwal mana yang akan digunakan untuk KBM.<br />
          	</div>
          	<?php } ?>
        </div>
        <!-- /.box -->
        <?php
			}
		?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>