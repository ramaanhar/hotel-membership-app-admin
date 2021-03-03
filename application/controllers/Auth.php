<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Back Office Login | Citarum Hotel';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->login();
        }
    }

    private function login()
    {
        if ($this->session->userdata('username')) {
            redirect('admin');
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['username' => $username])->row_array();

        if ($user) {
            if ($user['idrole'] == '1') {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'idrole' => $user['idrole']
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> Wrong password! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> The account could not found! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> The account could not found! </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('idrole');
        $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> You have been logged out! </div>');
        redirect('auth');
    }
    public function denied()
    {
        $data['title'] = '403 Access Forbidden!';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/denied');
        $this->load->view('templates/footer');
    }

    public function notfound()
    {
        $data['title'] = '404 Page Not Found!';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/notfound');
        $this->load->view('templates/footer');
    }
}
