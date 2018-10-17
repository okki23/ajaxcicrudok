<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skkm extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Skkm_model', 'skkm');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data = array('skkm' => $this->skkm->get_all());
    $this->load->view('skkm/list', $data);
  }

  public function get_tingkat()
  {
    $id_jenis = $this->input->post('value');
    $tingkat = $this->skkm->get_tingkat($id_jenis);

    echo '<select name="">';
    echo '<option value="">Pilih Tingkat</option>';
		foreach ($tingkat as $row)
		{
    	echo '<option value="'.$row->id_tingkat.'">'.$row->tingkat.'</option>';
		}
		echo '</select>';
  }

  public function get_prestasi()
  {
    $id_tingkat = $this->input->post('value');
    $prestasi = $this->skkm->get_prestasi($id_tingkat);

    echo '<select name="">';
    echo '<option value="">Pilih Prestasi</option>';
		foreach ($prestasi as $row)
		{
    	echo '<option value="'.$row->id_prestasi.'">'.$row->prestasi.'</option>';
		}
		echo '</select>';
  }

  public function get_nilai()
  {
    $id_prestasi = $this->input->post('value');
    $nilai = $this->skkm->get_nilai($id_prestasi);

    $data = array();
		foreach ($nilai as $row)
		{
      $data['value'] = $row->bobot;
		}
    echo $data['value'];
  }

  public function create()
  {
    $data = array(
                'dd_jenis' => $this->skkm->get_jenis(),
                'jenis_selected' => $this->input->post('id_jenis') ? $this->input->post('id_jenis') : '',
                'tingkat_selected' => $this->input->post('id_tingkat') ? $this->input->post('id_tingkat') : '',
                'prestasi_selected' => $this->input->post('id_prestasi') ? $this->input->post('id_prestasi') : ''
    );
    $this->load->view('skkm/add', $data);
  }

  public function store()
  {
    $this->rules();
    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $data = array(
                    'nama_kegiatan' => $this->input->post('nama_kegiatan'),
                    'id_jenis' => $this->input->post('id_jenis'),
                    'id_tingkat' => $this->input->post('id_tingkat'),
                    'id_prestasi' => $this->input->post('id_prestasi'),
                    'nilai' => $this->input->post('nilai'),
      );
      $this->skkm->insert($data);

      $this->session->set_flashdata('message', 'SKKM berhasil ditambah');
      redirect('skkm');
    }
  }

  public function edit($id)
  {
    $row = $this->skkm->get_by_id($id);
    if ($row) {
      $data = array(
                  'id' => $row->id,
                  'nama_kegiatan' => $row->nama_kegiatan,
                  'dd_jenis' => $this->skkm->get_jenis(),
                  'id_jenis' => $row->id_jenis,
                  'dd_tingkat' => $this->skkm->get_tingkat($row->id_jenis),
                  'id_tingkat' => $row->id_tingkat,
                  'dd_prestasi' => $this->skkm->get_prestasi($row->id_tingkat),
                  'id_prestasi' => $row->id_prestasi,
                  'nilai' => $row->nilai
      );
      $this->load->view('skkm/edit', $data);
      } else {
        $this->session->set_flashdata('message', 'Data SKKM tidak ditemukan.');
        redirect(site_url('skkm'));
      }
  }

  public function update($id)
  {
    $this->rules();
    if ($this->form_validation->run() == FALSE) {
      $this->edit($id);
    } else {
      $id = $this->input->post('id');
      $data = array(
                    'nama_kegiatan' => $this->input->post('nama_kegiatan'),
                    'id_jenis' => $this->input->post('id_jenis'),
                    'id_tingkat' => $this->input->post('id_tingkat'),
                    'id_prestasi' => $this->input->post('id_prestasi'),
                    'nilai' => $this->input->post('nilai')
      );
      $this->skkm->update($id, $data);
      $this->session->set_flashdata('message', 'SKKM berhasil diubah');
      redirect('skkm');
    }
  }

  public function hapus($id)
  {
    $row = $this->skkm->get_by_id($id);

    if ($row) {
      $this->skkm->delete($id);
      $this->session->set_flashdata('message', 'SKKM berhasil dihapus');
      redirect(site_url('skkm'));
    } else {
      $this->session->set_flashdata('message', 'Data tidak ditemukan');
      redirect(site_url('skkm'));
    }
  }

  public function rules()
  {
    $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'trim|required');
    $this->form_validation->set_rules('id_jenis', 'Jenis', 'trim|required');
    $this->form_validation->set_rules('id_tingkat', 'Tingkat', 'trim|required');
    $this->form_validation->set_rules('id_prestasi', 'Sebagai', 'trim|required');
    $this->form_validation->set_rules('nilai', 'Nilai', 'trim|required|numeric');
    $this->form_validation->set_error_delimiters('<span class="text-warning">', '</span>');
  }

}
