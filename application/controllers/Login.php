<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array('M_Perusahaan'));
        $this->load->helper('form', 'url');
    }

    function index()
    {
        $this->load->view('v_login.php');
    }

    function login_perusahaan()
    {
        $this->load->view('v_login_perusahaan.php');
    }

    function login_klien()
    {
        $this->load->view('v_login_klien.php');
    }

    function login_karyawan()
    {
        $this->load->view('v_login_karyawan.php');
    }

    function verifikasi_perusahaan()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek_login = $this->M_Perusahaan->cek_login('perusahaan', ['username' => $username])->row_array();

        if ($cek_login) {
            //cek status
            if ($cek_login['status_perusahaan'] == 1) {
                //cek password
                if (password_verify($password, $cek_login['password'])) {
                    $session = array(
                        'username_perusahaan' => $cek_login['username'],
                        'status_login_perusahaan' => 'login',
                    );

                    $this->session->set_userdata($session);
                    redirect('Dashboard_Perusahaan/tampil_menu_utama');
                } else {
                    $this->session->set_flashdata('gagal', 'Password salah');
                    redirect('Login/login_perusahaan');
                }
            } else {
                $this->session->set_flashdata('gagal', 'Akun belum aktif');
                redirect('Login/login_perusahaan');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Username salah');
            redirect('Login/login_perusahaan');
        }
    }

    function logout_perusahaan()
    {
        $this->session->sess_destroy();
        redirect('Login/login_perusahaan');
    }

    function logout_klien()
    {
        $this->session->sess_destroy();
        redirect('Login/login_klien');
    }

    function logout_karyawan()
    {
        $this->session->sess_destroy();
        redirect('Login/login_karyawan');
    }
}
