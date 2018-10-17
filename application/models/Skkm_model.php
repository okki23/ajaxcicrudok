<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skkm_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function get_all()
  {
    $sql =   "SELECT id, nama_kegiatan, jenis.jenis, tingkat.tingkat, prestasi.prestasi, nilai
              FROM skkm
              INNER JOIN jenis ON jenis.id_jenis = skkm.id_jenis
              INNER JOIN tingkat ON tingkat.id_tingkat = skkm.id_tingkat
              INNER JOIN prestasi ON prestasi.id_prestasi = skkm.id_prestasi";
    return $this->db->query($sql)->result();
  }

  public function get_by_id($id)
  {
    $this->db->where('id', $id);
    return $this->db->get('skkm')->row();
  }

  public function get_jenis()
  {
    $this->db->select('*');
    $this->db->from('jenis');
    $result = $this->db->get();
    return $result->result();
  }

  public function get_tingkat($id_jenis)
  {
    if (isset($id_jenis)) {
      $this->db->where('id_jenis_fk', $id_jenis);
    }

    $this->db->select('*');
		$this->db->from('tingkat');
		$result = $this->db->get();
		return $result->result();
  }

  public function get_prestasi($id_tingkat)
  {
    if (isset($id_tingkat)) {
      $this->db->where('id_tingkat_fk', $id_tingkat);
    }

    $this->db->select('id_prestasi, prestasi');
		$this->db->from('prestasi');
		$result = $this->db->get();
		return $result->result();
  }

  public function get_nilai($id_prestasi)
  {
    if (isset($id_prestasi)) {
      $this->db->where('id_prestasi', $id_prestasi);
    }

    $this->db->select('id_prestasi, bobot');
		$this->db->from('prestasi');
		$result = $this->db->get();
		return $result->result();
  }

  public function insert($data)
  {
    $this->db->insert('skkm', $data);
  }

  public function update($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('skkm', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('skkm');
  }

}
