  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelompok
        <small>Pengelolaan jadwal dan kelompok KBM</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> SIM LPQ</a></li>
        <li><a href="<?php echo base_url().'/admin'; ?>">Admin</a></li>
        <li class="active">Kelompok</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Pengajar</h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="dataTable" style="white-space: nowrap;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Program</th>
                <th>Jenjang</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td>Jenis Kelamin</td>
                <td>Program</td>
                <td>Jenjang</td>
                <td></td>
              </tr>
            </tfoot>
            <tbody>
            <?php
             if(is_array($pengajar)) foreach($pengajar as $data) {
              $data->nama_lengkap = html_escape($data->nama_lengkap);
            ?>
              <tr data-id-anggota="<?php echo $data->id_anggota; ?>" data-program="<?php echo $data->program; ?>" data-jenjang="<?php echo $data->jenjang; ?>">
                <td></td>
                <td><?php echo $data->nama_lengkap; ?></td>
                <td><?php echo ($data->jenis_kelamin == 1) ? 'Perempuan' : 'Laki-Laki'; ?></td>
                <td><?php echo PROGRAM[$data->program]; ?></td>
                <td><?php echo JENJANG[$data->program][$data->jenjang]; ?></td>
                <td>
                  <button class="btn btn-sm btn-primary edit" onclick="edit(this);">Edit Jadwal</button>
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

    <div class="modal fade" id="modal" role="dialog">
            <div class="modal-dialog" style="width:70%">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Jadwal</h4>
                </div>
                <div class="modal-body table-condensed">
                  <input type="hidden" id="id_anggota">
                  <input type="hidden" id="program">
                  <input type="hidden" id="jenjang">
                  <div class="form-group col-md-4">
                    <label class="control-group col-md-12"> Jumlah kelompok yang siap dibina</label>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <input type="number" class="form-control" id="jumlah_kelompok" value="">
                      </div>
                    </div>
                    <div class="col-md-2">            
                      <a onclick="jumlah_kelompok()" class="btn btn-primary btn-flat">Ubah</a>
                    </div>
                  </div>
                  <div class="form-group col-md-8">
                    <label class="control-group col-md-12"> Tambah alternatif (durasi 2 jam)</label>
                    <div class="col-md-8">
                      <div class="form-group has-feedback">
                        <div class="col-md-6">
                        <select id="hari" class="form-control">
                          <?php
                            foreach(HARI as $key => $value) {
                              echo '<option value="'.$key.'"'.'>'.$value.'</option>';
                            }
                          ?>
                        </select>
                        </div>
                        <div class="col-md-6">
                        <input type="text" id="waktu" class="form-control" value="00:00">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">            
                      <a onclick="tambah()" class="btn btn-success btn-flat">Tambah</a>
                    </div>
                  </div>
                  <table class="table" id="tabel-jadwal">
                      
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
              </div>
              
            </div>
    </div>

    <script>
      $.ajaxSetup({
          type:"post",
          cache:false,
        });
      $(document).ajaxStart(function ()
      {
          $('html, body, button').css("cursor", "wait");
      }).ajaxComplete(function () {
          $('html, body').css("cursor", "auto");
          $('button').css("cursor", "pointer");
      });

      $.fn.dataTable.Api.register( 'column().title()', function () {
          var colheader = this.header();
          return $(colheader).text().trim();
      } );

        var myTable = $('#dataTable').DataTable({
          "columnDefs": [
            {
               "searchable": false,
               "orderable": false,
               "targets": [0,-1]
            }],
          "order": [[2, 'asc'], [3, 'desc'], [ 1, 'asc' ]],
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "language": {
           "sProcessing":   "Sedang proses...",
           "sLengthMenu":   "_MENU_ entri per halaman",
           "sZeroRecords":  "Data tidak ditemukan",
           "sInfo":         "Menampilkan _START_&ndash;_END_ dari _TOTAL_ entri",
           "sInfoEmpty":    "Menampilkan 0&ndash;0 dari 0 entri",
           "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
           "sInfoPostFix":  "",
           "sSearch":       "Cari:",
           "sUrl":          "",
           "oPaginate": {
               "sFirst":    "&laquo;",
               "sPrevious": "&lt;",
               "sNext":     "&gt;",
               "sLast":     "&raquo;"
           },
          },
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
          "drawCallback": function () {
              this.api().columns([2,3,4]).every( function () {
                  var column = this;
                  var select = $('<select><option value="">'+column.title()+'</option></select>')
                      .appendTo( $(column.footer()).empty() )
                      .on( 'change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );
   
                          column
                              .search( val ? '^'+val+'$' : '', true, false )
                              .draw();
                      } );
                  column.data().unique().sort().each( function ( d, j ) {
                      if(column.search() === '^'+$.fn.dataTable.util.escapeRegex(d)+'$'){
                          select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
                      } else {
                          select.append( '<option value="'+d+'">'+d+'</option>' )
                      }
                  } );
                  var exists = false;
                  $('option', select).each(function(){
                      if ('^'+$.fn.dataTable.util.escapeRegex(this.value)+'$' == column.search() || column.search() == '') {
                          exists = true;
                          return false;
                      }
                  });
                  if(!exists) column.search('').draw();
              } );
          }
        });
        myTable.on( 'order.dt search.dt', function () {
            myTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

      $('#modal').on('hidden.bs.modal', function () {
        $('#id_anggota').val('');
        $('#jumlah_kelompok').val('');
        $('#program').val('');
        $('#jenjang').val('');
        $('#tabel-jadwal tr').remove();
      });

      var tr, id_anggota, program;

      function edit(pointer) {
        tr = $(pointer).parent().parent();
        id_anggota = tr.attr('data-id-anggota');
        program = tr.attr('data-program');
        jenjang = tr.attr('data-jenjang');

        $.ajax({
              data: {'id_anggota': id_anggota, 'program': program},
              dataType: 'json',
              url: '<?php echo site_url('admin/penjadwalan-pengajar'); ?>',
              success: function(data){
                $('#id_anggota').val(id_anggota);
                $('#program').val(program);
                $('#jenjang').val(jenjang);
                $('#jumlah_kelompok').val(data['jumlah_kelompok'])
                $('#tabel-jadwal').append('<tr><th>Alternatif (Jadwal kosong)</th><th>Aksi</th></tr>');
                for(var i in data['jadwal']) {
                  $('#tabel-jadwal').append('<tr data-id-jadwal="'+data['jadwal'][i]['id_jadwal']+'" data-id-kelompok="'+data['jadwal'][i]['id_kelompok']+'"><td></td><td><button class="btn btn-sm btn-success tambah-kelompok" onclick="tambah_kelompok(this);">Tambah Kelompok</button> <button class="btn btn-sm btn-danger hapus-kelompok hidden" onclick="hapus_kelompok(this);">Hapus Kelompok</button> <button class="btn btn-sm btn-primary" onclick="ubah(this);">Ubah</button> <button class="btn btn-sm btn-danger" onclick="hapus(this);">Hapus</button></td></tr>');
                  var tr = $('#tabel-jadwal tr:last');
                  if(data['jadwal'][i]['id_kelompok'] !== null) $('.tambah-kelompok, .hapus-kelompok', tr).toggleClass('hidden');
                  $('#hari').clone().removeAttr('id').attr('class', 'hari').val(data['jadwal'][i]['hari']).change().appendTo('#tabel-jadwal tr:last td:first');
                  $('#waktu').clone().removeAttr('id').attr('class', 'waktu').val(data['jadwal'][i]['waktu'].slice(0,-3)).change().appendTo('#tabel-jadwal tr:last td:first');
                }
                $('#modal').modal('show');
          waktu},
              error: function(){
                alert('error');
              }
        });
      }

      function jumlah_kelompok() {
        var jumlah_kelompok = $('#jumlah_kelompok').val();
        $.ajax({
              data: {'id_anggota': id_anggota, 'program': program, 'jumlah_kelompok' : jumlah_kelompok},
              url: '<?php echo site_url('admin/edit-jumlah-kelompok'); ?>',
              success: function(){
                alert('berhasil');
              },
              error: function(){
                alert('error');
                $('#modal').modal('hide');
              }
        });
      }

      function tambah(pointer) {
        var hari = $('#hari').val();
        var waktu = $('#waktu').val();
        $.ajax({
              data: {'id_anggota': id_anggota, 'program': program, 'hari': hari, 'waktu': waktu},
              url: '<?php echo site_url('admin/tambah-penjadwalan-pengajar'); ?>',
              success: function(id_jadwal){
                alert('berhasil');
                $('#modal').modal('hide');
              },
              error: function(){
                alert('error');
              }
        });
      }

      function ubah(pointer) {
        var tr = $(pointer).parent().parent();
        var id_jadwal = tr.attr('data-id-jadwal');
        var hari = $('.hari', tr).val();
        var waktu = $('.waktu', tr).val();
        $.ajax({
              data: {'id_anggota': id_anggota, 'program': program, 'id_jadwal' : id_jadwal, 'hari': hari, 'waktu': waktu},
              url: '<?php echo site_url('admin/edit-penjadwalan-pengajar'); ?>',
              success: function(){
                alert('berhasil');
              },
              error: function(){
                alert('error');
                $('#modal').modal('hide');
              }
        });
      }

      function hapus(pointer) {
        var tr = $(pointer).parent().parent();
        var id_jadwal = tr.attr('data-id-jadwal');
        if(confirm('Anda yakin?')) $.ajax({
              data: {'id_anggota': id_anggota, 'program': program, 'id_jadwal' : id_jadwal},
              url: '<?php echo site_url('admin/hapus-penjadwalan-pengajar'); ?>',
              success: function(){
                alert('berhasil');
                tr.remove();
              },
              error: function(){
                alert('error');
              }
        });
      }

      function tambah_kelompok(pointer) {
        var tr = $(pointer).parent().parent();
        var id_jadwal = tr.attr('data-id-jadwal');
        $.ajax({
              data: {'id_jadwal' : id_jadwal, 'jenjang': jenjang},
              url: '<?php echo site_url('admin/tambah-kelompok'); ?>',
              success: function(){
                alert('berhasil');
                $('.tambah-kelompok, .hapus-kelompok', tr).toggleClass('hidden');
              },
              error: function(){
                alert('error');
              }
        });
      }

      function hapus_kelompok(pointer) {
        var tr = $(pointer).parent().parent();
        var id_jadwal = tr.attr('data-id-jadwal');
        if(confirm('Anda yakin?')) $.ajax({
              data: {'id_jadwal' : id_jadwal},
              url: '<?php echo site_url('admin/hapus-kelompok'); ?>',
              success: function(){
                alert('berhasil');
                $('.tambah-kelompok, .hapus-kelompok', tr).toggleClass('hidden');
              },
              error: function(){
                alert('error');
              }
        });
      }


    </script>