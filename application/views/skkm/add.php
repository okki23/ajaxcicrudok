<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah SKKM</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <?php echo form_open('skkm/store'); ?>
              <?php echo form_label('Nama Kegiatan','nama_kegiatan'); ?>
              <?php echo form_error('nama_kegiatan'); ?>
              <?php
                  $data = array(
                                  'type' => 'text',
                                  'name' => 'nama_kegiatan',
                                  'id' => 'nama_kegiatan',
                                  'class' => 'form-control',
                                  'placeholder' => 'Nama Kegiatan',
                                  'required' => 'required',
                                  'autofocus' => 'autofocus'
                  );
                  echo form_input($data);
              ?>

              <br><br>

              <?php echo form_label('Jenis Kegiatan', 'id_jenis'); ?>
              <?php echo form_error('id_jenis'); ?>
              <select class="form-control" name="id_jenis" id="jenis" class="form-control" onchange="getTingkat(this.value)" required>
                <option value="">Silahkan Pilih</option>
                <?php foreach ($dd_jenis as $row): ?>
                  <option value="<?php echo $row->id_jenis; ?>"><?php echo $row->jenis; ?></option>
                <?php endforeach; ?>
              </select>

              <br><br>

              <?php echo form_label('Tingkat Kegiatan', 'id_tingkat'); ?>
              <?php echo form_error('id_tingkat'); ?>
              <select name="id_tingkat" id="tingkat" class="form-control" onchange="getPrestasi(this.value)" required>
                <option value="">Silahkan Pilih</option>
              </select>

              <br><br>

              <?php echo form_label('Prestasi', 'id_prestasi'); ?>
              <?php echo form_error('id_prestasi'); ?>
              <select name="id_prestasi" id="prestasi" class="form-control" onchange="getNilai(this.value)" required>
                <option value="">Silahkan Pilih</option>
              </select>

              <br><br>

              <?php echo form_label('Nilai','nilai'); ?>
              <?php echo form_error('nilai'); ?>
              <?php
                  $extra = array(
                                  'type' => 'number',
                                  'name' => 'nilai',
                                  'id' => 'nilai',
                                  'class' => 'form-control',
                                  'placeholder' => 'Nilai',
                                  'required' => 'required',
                                  'readonly' => 'readonly'
                  );
                  echo form_input($extra);
              ?>

              <br><br>

            <?php echo anchor(site_url('skkm'), 'Kembali', 'class="btn btn-default"'); ?>
            <?php echo form_submit('submit', 'Tambah', 'class="btn btn-primary"'); ?>

          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>" charset="utf-8"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" charset="utf-8"></script>
    <script>
    /* Ajax Dropdown Jenis Tingkat */
    function getTingkat(value) {
      var value = value;
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('skkm/get_tingkat');?>",
        data: {value},
        success: function(data) {
          $("#prestasi option:gt(0)").remove();
          $("#tingkat").html(data);
          $("#nilai").val("");
        },

        error:function(XMLHttpRequest){
          alert(XMLHttpRequest.responseText);
        }
      });
    };

    /* Ajax Dropdown Tingkat Prestasi */
    function getPrestasi(value) {
      var value = value;
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('skkm/get_prestasi');?>",
        data:{value},
        success: function(data) {
          $("#prestasi").html(data);
          $("#nilai").val("");
        },

        error:function(XMLHttpRequest){
          alert(XMLHttpRequest.responseText);
        }
      });
    }

    /* Ajax Dropdown Prestasi Nilai */
    function getNilai(value) {
      var value = value;
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('skkm/get_nilai');?>",
        data: {value},
        success: function(data) {
          document.getElementById('nilai').value = data;
        },

        error:function(XMLHttpRequest){
          alert(XMLHttpRequest.responseText);
        }
      });
    }
    </script>
  </body>
</html>
