<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <?php echo form_open('mahasiswa/store'); ?>
                <?php echo form_label('Nama','nama'); ?>
                <?php echo form_error('nama'); ?>
                <?php
                    $nama = array(
                                      'type' => 'text',
                                      'name' => 'nama',
                                      'id' => 'nama',
                                      'class' => 'form-control',
                                      'placeholder' => 'Nama',
                                      'required' => 'required',
                                      'autofocus' => 'autofocus'
                    );
                 echo form_input($nama); ?>

                 <br><br>

                <?php echo form_label('Jurusan', 'id_jurusan'); ?>
                <?php echo form_error('id_jurusan'); ?>
                <select name="id_jurusan" class="form-control" id="jurusan" onchange="getProdi(this.value)" required>
                  <option value="">Silahkan Pilih</option>
                  <?php foreach ($dd_jurusan as $row): ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->nama_jurusan; ?></option>
                  <?php endforeach; ?>
                </select>

                <br><br>

                <?php echo form_label('Prodi', 'id_prodi'); ?>
                <?php echo form_error('id_prodi'); ?>
                <select name="id_prodi" id="prodi" class="form-control" required>
                  <option value="">Silahkan Pilih</option>
                </select>

                <br><br>

                <?php echo anchor(site_url('mahasiswa'), 'Kembali', 'class="btn btn-default"'); ?>
                <?php echo form_submit('submit', 'Tambah', 'class="btn btn-primary"'); ?>

          <?php echo form_close(); ?><!-- /.form end -->
        </div>
      </div>
    </div>
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>" charset="utf-8"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" charset="utf-8"></script>
    <script>
    /* Ajax Dropdown Jurusan Prodi */
    function getProdi(value) {
      console.log(value);
      var row = value;
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('mahasiswa/get_prodi');?>",
        data: {row},
        success: function(data) {
          $("#prodi").html(data);
          console.log(data);
        },

        error:function(XMLHttpRequest){
          alert(XMLHttpRequest.responseText);
        }
      });
    };
    </script>
  </body>
</html>
