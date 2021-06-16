
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function index()
    {
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('status');

        $this->session->set_flashdata('message', '<div class="alert" style="background-color:#FFA500;color:#ffffff" role="alert">
                Selamat, Anda berhasil keluar.
              </div>');
        redirect('/');
    }
}
