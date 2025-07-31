<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Datasource', 'ds');

		$this->load->library('modalslib');
	}

	public function index()
	{
		$data['breadcrumb'] = 'Home';
		$data['content'] = $this->load->view('pages/home', $data, true);
		$this->load->view('layout', $data);
	}

	public function admin()
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->ds->getBuku();

			print json_encode(['data' => $data]);
		} else {
			$data['breadcrumb'] = 'Tabel Buku';
			$data['breadcrumb2'] = 'Tabel Penerbit';
			$data['data_penerbit'] = $this->ds->get_where('tb_penerbit');
			$data['content'] = $this->load->view('pages/admin', $data, true);
			$this->load->view('layout', $data);
		}
	}

	public function pengadaan()
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->ds->getBukuUnderStock(10); // atur under stock yg ingin ditampilkan

			print json_encode(['data' => $data]);
		} else {
			$data['breadcrumb'] = 'Pengadaan';
			$data['content'] = $this->load->view('pages/pengadaan', $data, true);
			$this->load->view('layout', $data);
		}
	}

	public function get_penerbit()
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->ds->get_where('tb_penerbit');

			print json_encode(['data' => $data]);
		}
	}

	public function save_penerbit()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');

			$this->form_validation->set_rules('nama_penerbit', 'Nama Penerbit', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('kota', 'Kota', 'required');
			$this->form_validation->set_rules('telp', 'Telephone', 'required|numeric');

			if (!isset($id) || $id == '') {
				if ($this->form_validation->run()) {
					$a_data = [
						'IDPenerbit' => $this->ds->generateKodePenerbit(),
						'nama_penerbit' => ucfirst(set_value('nama_penerbit')),
						'alamat' => set_value('alamat'),
						'kota' => ucfirst(set_value('kota')),
						'telepon' => set_value('telp'),
					];

					$this->ds->insert_data_penerbit($a_data);
					$result = array('code' => 0, 'message' => 'Success.');
				} else {
					$result = array('code' => 1, 'message' => validation_errors('<li>', '</li>'));
				}
			} else {
				if ($this->form_validation->run()) {
					$a_data = [
						'nama_penerbit' => ucfirst(set_value('nama_penerbit')),
						'alamat' => set_value('alamat'),
						'kota' => ucfirst(set_value('kota')),
						'telepon' => set_value('telp'),
					];

					$this->ds->update_data_penerbit($a_data, $id);
					$result = array('code' => 0, 'message' => 'Success.');
				} else {
					$result = array('code' => 1, 'message' => validation_errors('<li>', '</li>'));
				}
			}

			print json_encode($result);
		}
	}

	public function delete_data_penerbit()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');

			if ($this->ds->delete_data_penerbit($id)) {
				$result = array('code' => 0, 'message' => 'Success.');
			} else {
				$result = array('code' => 1, 'message' => validation_errors('<li>', '</li>'));
			}

			print json_encode($result);
		}
	}

	public function save_buku()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');

			$this->form_validation->set_rules('nama_penerbit', 'Nama Penerbit', 'required');
			$this->form_validation->set_rules('kategori', 'Alamat', 'required');
			$this->form_validation->set_rules('nama_buku', 'Kota', 'required');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
			$this->form_validation->set_rules('stock', 'Stock', 'required|numeric');

			if (!isset($id) || $id == '') {
				if ($this->form_validation->run()) {
					$a_data = [
						'IDBuku' => $this->ds->generateKodeBuku(),
						'IDPenerbit' => set_value('nama_penerbit'),
						'kategori' => ucfirst(set_value('kategori')),
						'nama_buku' => ucfirst(set_value('nama_buku')),
						'harga' => set_value('harga'),
						'stock' => set_value('stock'),
					];

					$this->ds->insert_data_buku($a_data);
					$result = array('code' => 0, 'message' => 'Success.');
				} else {
					$result = array('code' => 1, 'message' => validation_errors('<li>', '</li>'));
				}
			} else {
				if ($this->form_validation->run()) {
					$a_data = [
						'IDPenerbit' => set_value('nama_penerbit'),
						'kategori' => ucfirst(set_value('kategori')),
						'nama_buku' => ucfirst(set_value('nama_buku')),
						'harga' => set_value('harga'),
						'stock' => set_value('stock'),
					];

					$this->ds->update_data_buku($a_data, $id);
					$result = array('code' => 0, 'message' => 'Success.');
				} else {
					$result = array('code' => 1, 'message' => validation_errors('<li>', '</li>'));
				}
			}

			print json_encode($result);
		}
	}

	public function delete_data_buku()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('id');

			if ($this->ds->delete_data_buku($id)) {
				$result = array('code' => 0, 'message' => 'Success.');
			} else {
				$result = array('code' => 1, 'message' => validation_errors('<li>', '</li>'));
			}

			print json_encode($result);
		}
	}
}
