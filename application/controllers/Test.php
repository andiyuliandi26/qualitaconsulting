<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {
    public function index() {
        $token = $this->input->get('token');

        if ($token) {
            $this->_cekToken($token);
        } else {
            $this->load_view('peserta/input-token');
        }
    }

    private function _cekToken($token) {
        // cek token
        // jika token valid & belum mengerjakan
        $this->_inputProfile();
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