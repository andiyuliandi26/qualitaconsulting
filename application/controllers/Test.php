<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $token = $this->input->get('token', true);

        if ($token) {
            $tokenIsValid = $this->_cekToken($token);
            if ($tokenIsValid) {
                $token_peserta = $this->input->cookie('token');
                if ($token_peserta) {
                    $peserta = $this->pesertamodel->get_peserta_by_pesertatoken($token_peserta);
                    $testStatus = $peserta->TestStatus;
                    switch ($testStatus) {
                    case 'Profile':
                        # code...
                        break;
                    case 'Progress':
                        # code...
                        break;
                    case 'Completed':
                        # code...
                        break;
                    }
                    return;
                }
                $this->_inputProfile();
            } else {
                redirect('test', 'refresh');
            }
        } else {
            $this->load_view('peserta/input-token');
        }
    }

    private function _cekToken($token) {
        // cek token
        $data = $this->clientbatchmodel->validasi_token($token);
        if (!$data) {
            $this->session->set_flashdata('message', 'Hey, kamu memasukkan token yang salah!');
            $this->session->set_flashdata('message_type', 'warning');
            return FALSE;
        }
        // cek validasi waktu test
        if (time() < strtotime($data->TanggalTest ." ".$data->JamAwalTest)) {
            $this->session->set_flashdata('message', 'Waktu test belum dimulai.. Coba lagi nanti ya.');
            $this->session->set_flashdata('message_type', 'info');
            return FALSE;
        } elseif (time() > strtotime($data->TanggalTest ." ".$data->JamAkhirTest)) {
            $this->session->set_flashdata('message', 'Maaf, waktu test sudah selesai. Kamu sudah tidak bisa mengikutinya.');
            $this->session->set_flashdata('message_type', 'info');
            return FALSE;
        }
        // cek jumlah peserta
        $pesertaTerdaftar = $this->pesertamodel->get_jmlpeserta_by_batchid($data->ID);
        if ($pesertaTerdaftar >= $data->TotalPeserta) {
            $this->session->set_flashdata('message', 'Maaf, jumlah peserta test sudah memenuhi kuota.');
            $this->session->set_flashdata('message_type', 'info');
            return FALSE;
        }
        return TRUE;
    }

    private function _inputProfile() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->_showProfile();
        }
        else {
            $this->load_view('peserta/input-profile');
        }
    }

    private function _showProfile() {
        $this->load_view('peserta/profile');
    }

    public function start() {
        $token = $this->input->post('token');

        if (!$token) redirect('test');
    }
}