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
          Dasbor
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> SIM LPQ</a></li>
          <li>User</li>
          <li class="active">Dasbor</li>
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
		<!--Untuk mengubah data atau menghapus akun, silahkan menuju <a href="#">Akun</a>-->
        <div class="box box-default">
            <div class="box-header with-border">
            	<h4>Program</h4>
            </div>
			<div class="box-body table-condensed">
				<?php echo form_open(site_url('user/program/tambah')); ?>
					<div class="form-group col-md-12">
						<label class="control-group col-md-12"> Tambah program </label>
						<div class="col-md-5">
							<div class="form-group has-feedback">
								<select class="form-control" name="tambah">
									<?php
										if(!isset($program_santri[1]) && !isset($program_santri[2])) {
											echo '<option value="11">'.SANTRI.PROGRAM[1].'</option>'.PHP_EOL;
											echo '<option value="12">'.SANTRI.PROGRAM[2].'</option>'.PHP_EOL;
										}
										if(!isset($program_santri[3]))
											echo '<option value="13">'.SANTRI.PROGRAM[3].'</option>'.PHP_EOL;
										for($i=1; $i<=3; $i++) {
											if(!isset($program_pengajar[$i])) {
												echo '<option value="2'.$i.'">'.PENGAJAR[$i].PROGRAM[$i].'</option>'.PHP_EOL;
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-2">						
							<button type="submit" class="btn btn-success btn-flat">Tambah</button>
						</div>
					</div>
				<?php echo form_close() ?>
				<table class="table">
					<thead>
						<tr>
							<th>Program</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($program_santri as $key => $value) {
						?>
						<tr>
							<td><?php echo SANTRI.PROGRAM[$key]; ?></td>
							<td>
								<a href="<?php echo site_url('user/program/edit/1/'.$key); ?>" class="btn btn-primary flat">Edit</a>
								<a href="<?php echo site_url('user/program/hapus/1/'.$key); ?>" class="btn btn-danger flat">Hapus</a>
							</td>
						</tr>

						<?php
							}
							foreach ($program_pengajar as $key => $value) {
						?>
						<tr>
							<td><?php echo PENGAJAR[$key].PROGRAM[$key]; ?></td>
							<td>
								<a href="<?php echo site_url('user/program/edit/2/'.$key); ?>" class="btn btn-primary flat">Edit</a>
								<a href="<?php echo site_url('user/program/hapus/2/'.$key); ?>" class="btn btn-danger flat">Hapus</a>
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>