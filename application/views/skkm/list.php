<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Skkm</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a href="<?php echo site_url(); ?>dropdown">Back to main menu</a>
          <a href="<?php echo site_url('skkm/store'); ?>">Tambah Skkm</a>
          <br>
            <?php echo $this->session->userdata('message'); ?>
          <table class="table">
            <thead>
              <th>No</th>
              <th>Nama Kegiatan</th>
              <th>Jenis</th>
              <th>Tingkat</th>
              <th>Prestasi</th>
              <th>Nilai</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              <?php
              $start = 0;
              foreach ($skkm as $row): ?>
              <tr>
                <td><?php echo ++$start; ?></td>
                <td><a href="<?php echo site_url('skkm/edit/'.$row->id); ?>"><?php echo $row->nama_kegiatan; ?></a></td>
                <td><?php echo $row->jenis; ?></td>
                <td><?php echo $row->tingkat; ?></td>
                <td><?php echo $row->prestasi; ?></td>
                <td><?php echo $row->nilai; ?></td>
                <td>
                  <?php
                      $hapus = array(
                                    'class' => 'btn btn-sm btn-danger',
                                    'onclick' => 'javascript: return confirm(\'Kamu yakin menghapus '.$row->nama_kegiatan.'?\')');
                      echo anchor(site_url('skkm/delete/'.$row->id), 'Hapus', $hapus);
                   ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>" charset="utf-8"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" charset="utf-8"></script>
  </body>
</html>
