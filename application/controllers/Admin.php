<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Back Office Hotel Citarum';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function managemember()
    {
        $data['title'] = 'Manage Member';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('users', [
            'idrole' => '2',
            'isactive' => '1'
        ])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/manage-member', $data);
        $this->load->view('templates/footer', $data);
    }

    public function managefacilities()
    {
        $data['title'] = 'Manage Facilities';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/manage-facilities', $data);
        $this->load->view('templates/footer', $data);
    }

    public function managelevel()
    {
        $data['title'] = 'Manage Member Level';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/manage-level', $data);
        $this->load->view('templates/footer', $data);
    }

    public function managefacilityprices()
    {
        $data['title'] = 'Manage Facility Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();
        $data['facilityprices'] = $this->db->get_where('facilities_price', ['status' => 'A'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/manage-facility-prices');
        $this->load->view('templates/footer', $data);
    }

    public function managelevelprices()
    {
        $data['title'] = 'Manage Level Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();
        $data['levelprices'] = $this->db->get_where('membership_price', ['status' => 'A'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/manage-level-prices', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editmember()
    {
        $data['title'] = 'Manage Member';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('users', [
            'idrole' => '2',
            'isactive' => '1'
        ])->result_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|integer');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-member', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $phone = $this->input->post('phone');
            $iduser = $this->input->post('iduser');

            $this->db->set('name', $name);
            $this->db->set('address', $address);
            $this->db->set('phone', $phone);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->set('updatedby', $data['user']['name']);

            $this->db->where('iduser', $iduser);
            $this->db->update('users');

            $this->db->set('membershipname', $name);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->set('updatedby', $data['user']['name']);

            $this->db->where('idmembership', $iduser);
            $this->db->update('membership');

            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->set('updatedby', $data['user']['name']);
            $this->db->where('iduser', $iduser);
            $this->db->update('map_user_membership');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> A member account has been edited!</div>');
            redirect('admin/managemember');
        }
    }

    public function addmember()
    {
        // $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nik', 'Citizen ID', 'required|trim|integer');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|integer');
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim|is_unique[users.username]',
            [
                'is_unique' => 'This username has been used! Please choose another username.'
            ]
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[users.email]',
            [
                'is_unique' => 'This email has been used! Please choose another email.'
            ]
        );

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[8]|max_length[20]|matches[password2]',
            [
                'matches' => 'Password not match!',
                'min_length' => 'Password too short!',
                'max_length' => 'Password too long!'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        $data['title'] = 'Add New Member';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/add-member', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $q = $this->db->query("SELECT MAX(RIGHT(idmembership,8)) AS suffix_max FROM membership WHERE DATE(datecreated)=CURDATE()");
            $suffix = "";
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $k) {
                    $tmp = ((int) $k->suffix_max) + 1;
                    $suffix = sprintf("%08s", $tmp);
                }
            } else {
                $suffix = '10000001';
            }

            $idmember = date('Ymd') . $suffix;

            $user_data = [

                'iduser' => $idmember,
                'name' => htmlspecialchars($this->input->post('name', true)),
                'nik_ktp' => $this->input->post('nik'),
                'address' => $this->input->post('address'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                // 'password' => $this->input->post('password1'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => "defaultuser.jpg",
                'idrole' => "2",
                'isactive' => "1",
                'datecreated' => date('Y-m-d H:i:s'),
                'dateupdated' => date('Y-m-d H:i:s'),
                'createdby' => $data['user']['name'],
                'updatedby' => $data['user']['name']

            ];

            $this->load->library('ciqrcode');
            //isi data untuk QR code
            $params['data'] =
                'Name : ' . $user_data['name'] . ', ' .
                'Email : ' . $user_data['email'] . ', ' .
                'Membership code : ' . $user_data['iduser'];
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . 'assets/img/qr/myqr' . $idmember . '.png';
            $this->ciqrcode->generate($params);

            // buat barcode
            $this->load->library('zend');

            //load yang ada di folder Zend
            $this->zend->load('Zend/Barcode');

            //generate barcodenya

            $kode = $user_data['iduser'];
            $file = Zend_Barcode::draw('code128', 'image', array('text' => $kode), array());

            $store_image = imagepng($file, FCPATH . 'assets/img/barcode/brcd' . $kode . '.png');

            $member_data = [

                'datecreated' => date('Y-m-d H:i:s'),
                'dateupdated' => date('Y-m-d H:i:s'),
                'idmembership' => $idmember,
                'membershipname' => $user_data['name'],
                'qrcode' => 'myqr' . $user_data['iduser'] . '.png',
                'barcode' => 'brcd' . $idmember . '.png',
                'idmembershiplevel' => 1,
                'status' => 'A',
                'createdby' => $data['user']['name'],
                'updatedby' => $data['user']['name']

            ];
            $map_data = [

                'iduser' => $user_data['iduser'],
                'idmembership' => $member_data['idmembership'],
                'startdate' => date('Y-m-d H:i:s'),
                'enddate' => date('Y-m-d H:i:s', strtotime('+1 year')),
                'status' => 'A',
                'createdby' => $data['user']['name'],
                'datecreated' => date('Y-m-d H:i:s'),
                'updatedby' => $data['user']['name'],
                'dateupdated' => date('Y-m-d H:i:s')

            ];

            $this->db->insert('users', $user_data);
            $this->db->insert('membership', $member_data);
            $this->db->insert('map_user_membership', $map_data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> Congratulation! An user account has been created! </div>');
            redirect('admin/managemember');
        }
    }
    public function deletemember()
    {
        $data['title'] = 'Manage Member';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('users', [
            'idrole' => '2',
            'isactive' => '1'
        ])->result_array();
        $this->form_validation->set_rules('iduser', 'ID User', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-member', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $iduser = $this->input->post('iduser');

            $this->db->set('isactive', '0');
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->set('updatedby', $data['user']['name']);
            $this->db->where('iduser', $iduser);
            $this->db->update('users');

            $this->db->set('status', 'I');
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->set('updatedby', $data['user']['name']);
            $this->db->where('idmembership', $iduser);
            $this->db->update('membership');

            $this->db->set('status', 'I');
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->set('updatedby', $data['user']['name']);
            $this->db->where('iduser', $iduser);
            $this->db->update('map_user_membership');

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> An user account has been deleted! </div>');
            redirect('admin/managemember');
        }
    }

    public function addfacility()
    {
        $this->form_validation->set_rules('namefacilities', 'Name', 'required|trim');

        $data['title'] = 'Add New Facility';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-facilities', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $facility_data = [
                'namefacilities' => htmlspecialchars($this->input->post('namefacilities', true)),
                'status' => 'A',
                'createdby' => $data['user']['name'],
                'datecreated' => date('Y-m-d H:i:s'),
                'updatedby' => $data['user']['name'],
                'dateupdated' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('facilities', $facility_data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> Congratulation! A facility has been added! </div>');
            redirect('admin/managefacilities');
        }
    }

    public function editfacility()
    {
        $data['title'] = 'Manage Facilities';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();

        $this->form_validation->set_rules('namefacilities', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-facilities', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idfacilities = $this->input->post('idfacilities');
            $name = $this->input->post('namefacilities');
            $editor = $data['user']['name'];

            $this->db->set('namefacilities', $name);
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));

            $this->db->where('idfacilities', $idfacilities);
            $this->db->update('facilities');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> A facility data has been edited! </div>');
            redirect('admin/managefacilities');
        }
    }

    public function deletefacility()
    {
        $data['title'] = 'Manage Facilities';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();

        $this->form_validation->set_rules('idfacilities', 'Facilities ID', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-facilities', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idfacilities = $this->input->post('idfacilities');
            $editor = $data['user']['name'];

            $this->db->set('status', 'I');
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->where('idfacilities', $idfacilities);
            $this->db->update('facilities');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> A facility data has been deleted! </div>');
            redirect('admin/managefacilities');
        }
    }

    public function addlevel()
    {
        $this->form_validation->set_rules('levelname', 'Name', 'required|trim');

        $data['title'] = 'Manage Member Level';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-level', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $level_name = htmlspecialchars($this->input->post('levelname', true));
            $level_data = [
                'levelname' => $level_name,
                'price' => 0,
                'status' => 'A',
                'createdby' => $data['user']['name'],
                'datecreated' => date('Y-m-d H:i:s'),
                'updatedby' => $data['user']['name'],
                'dateupdated' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('membership_level', $level_data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> Congratulation! Level ' . $level_name . ' has been added! </div>');
            redirect('admin/managelevel');
        }
    }

    public function editlevel()
    {
        $data['title'] = 'Manage Member Level';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();

        $this->form_validation->set_rules('levelname', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-level', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idlevel = $this->input->post('idmembershiplevel');
            $name = $this->input->post('levelname');
            $editor = $data['user']['name'];

            $this->db->set('levelname', $name);
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));

            $this->db->where('idmembershiplevel', $idlevel);
            $this->db->update('membership_level');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> Level ' . $name . ' has been edited! </div>');
            redirect('admin/managelevel');
        }
    }

    public function deletelevel()
    {
        $data['title'] = 'Manage Member Level';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();

        $this->form_validation->set_rules('idmembershiplevel', 'Level ID', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-level', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idlevel = $this->input->post('idmembershiplevel');
            $editor = $data['user']['name'];
            $level_row = $this->db->get_where('membership_level', ['idmembershiplevel' => $idlevel])->row_array();
            $name = $level_row['levelname'];

            $this->db->set('status', 'I');
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->where('idmembershiplevel', $idlevel);
            $this->db->update('membership_level');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> Level ' . $name . ' has been deleted! </div>');
            redirect('admin/managelevel');
        }
    }

    public function addfacilityprice()
    {

        $this->form_validation->set_rules('idfacilities', 'Facility ID', 'required|trim|integer');
        $this->form_validation->set_rules('rateperhour', 'Rate per Hour', 'required|trim|is_natural');
        $this->form_validation->set_rules('rateperpackage', 'Rate per Package', 'required|trim|is_natural');
        $this->form_validation->set_rules('startdate', 'Start date', 'required|trim');
        $this->form_validation->set_rules('enddate', 'End date', 'required|trim');

        $data['title'] = 'Manage Facility Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();
        $data['facilityprices'] = $this->db->get_where('facilities_price', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-facility-prices', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $facility_price_data = [
                'idfacilities' => $this->input->post('idfacilities'),
                'rateperhour' => $this->input->post('rateperhour'),
                'rateperpackage' => $this->input->post('rateperpackage'),
                'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
                'status' => 'A',
                'createdby' => $data['user']['name'],
                'datecreated' => date('Y-m-d H:i:s'),
                'updatedby' => $data['user']['name'],
                'dateupdated' => date('Y-m-d H:i:s'),
                'evoucher' => NULL
            ];
            $this->db->insert('facilities_price', $facility_price_data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> Congratulation! A facility price data has been added! </div>');
            redirect('admin/managefacilityprices');
        }
    }
    public function editfacilityprice()
    {

        $this->form_validation->set_rules('idfacilities', 'Facility ID', 'required|trim|integer');
        $this->form_validation->set_rules('rateperhour', 'Rate per Hour', 'required|trim|is_natural');
        $this->form_validation->set_rules('rateperpackage', 'Rate per Package', 'required|trim|is_natural');
        $this->form_validation->set_rules('startdate', 'Start date', 'required|trim');
        $this->form_validation->set_rules('enddate', 'End date', 'required|trim');

        $data['title'] = 'Manage Facility Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();
        $data['facilityprices'] = $this->db->get_where('facilities_price', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-facility-prices', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idfacilitiesprice = $this->input->post('idfacilitiesprice');
            $editor = $data['user']['name'];
            $idfacilities = $this->input->post('idfacilities');
            $rateperhour = $this->input->post('rateperhour');
            $rateperpackage = $this->input->post('rateperpackage');
            $startdate = $this->input->post('startdate');
            $enddate = $this->input->post('enddate');

            $this->db->set('idfacilities', $idfacilities);
            $this->db->set('rateperhour', $rateperhour);
            $this->db->set('rateperpackage', $rateperpackage);
            $this->db->set('startdate', $startdate);
            $this->db->set('enddate', $enddate);
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->where('idfacilitiesprice', $idfacilitiesprice);
            $this->db->update('facilities_price');
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> A facility price data has been edited! </div>');
            redirect('admin/managefacilityprices');
        }
    }

    public function deletefacilityprice()
    {

        $this->form_validation->set_rules('idfacilitiesprice', 'Facility Price ID', 'required|trim|integer');

        $data['title'] = 'Manage Facility Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['facilities'] = $this->db->get_where('facilities', ['status' => 'A'])->result_array();
        $data['facilityprices'] = $this->db->get_where('facilities_price', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-facility-prices', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idfacilitiesprice = $this->input->post('idfacilitiesprice');
            $editor = $data['user']['name'];
            $this->db->set('status', 'I');
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));
            $this->db->where('idfacilitiesprice', $idfacilitiesprice);
            $this->db->update('facilities_price');
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> A facility price data has been deleted! </div>');
            redirect('admin/manage-facility-prices');
        }
    }

    public function addlevelprice()
    {

        $this->form_validation->set_rules('idmembershiplevel', 'Level ID', 'required|trim|integer');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|is_natural');
        $this->form_validation->set_rules('startdate', 'Start date', 'required|trim');
        $this->form_validation->set_rules('enddate', 'End date', 'required|trim');

        $data['title'] = 'Manage Level Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();
        $data['levelprices'] = $this->db->get_where('membership_price', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-level-prices', $data);
            $this->load->view('templates/footer', $data);;
        } else {
            $level_price_data = [
                'idmembershiplevel' => $this->input->post('idmembershiplevel'),
                'price' => $this->input->post('price'),
                'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
                'status' => 'A',
                'createdby' => $data['user']['name'],
                'datecreated' => date('Y-m-d H:i:s'),
                'updatedby' => $data['user']['name'],
                'dateupdated' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('membership_price', $level_price_data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> Congratulation! A level price data has been added! </div>');
            redirect('admin/managelevelprices');
        }
    }

    public function editlevelprice()
    {
        $this->form_validation->set_rules('idmembershiplevel', 'Level ID', 'required|trim|integer');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|is_natural');
        $this->form_validation->set_rules('startdate', 'Start date', 'required|trim');
        $this->form_validation->set_rules('enddate', 'End date', 'required|trim');

        $data['title'] = 'Manage Level Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();
        $data['levelprices'] = $this->db->get_where('membership_price', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-level-prices', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idmembershipprice = $this->input->post('idmembershipprice');
            $editor = $data['user'][name];
            $idmembershiplevel = $this->input->post('idmembershiplevel');
            $price = $this->input->post('price');
            $startdate = $this->input->post('startdate');
            $enddate = $this->input->post('enddate');

            $this->db->set('idmembershiplevel', $idmembershiplevel);
            $this->db->set('price', $price);
            $this->db->set('startdate', $startdate);
            $this->db->set('enddate', $enddate);
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));

            $this->db->where('idmembershipprice', $idmembershipprice);
            $this->db->update('membership_price');

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> A level price data has been edited! </div>');
            redirect('admin/managelevelprices');
        }
    }

    public function deletelevelprice()
    {
        $this->form_validation->set_rules('idmembershipprice', 'Level Price ID', 'required|trim|integer');

        $data['title'] = 'Manage Level Prices';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['levels'] = $this->db->get_where('membership_level', ['status' => 'A'])->result_array();
        $data['levelprices'] = $this->db->get_where('membership_price', ['status' => 'A'])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manage-level-prices', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $idmembershipprice = $this->input->post('idmembershipprice');
            $editor = $data['user'][name];

            $this->db->set('status', 'I');
            $this->db->set('updatedby', $editor);
            $this->db->set('dateupdated', date('Y-m-d H:i:s'));

            $this->db->where('idmembershipprice', $idmembershipprice);
            $this->db->update('membership_price');

            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> A level price data has been edited! </div>');
            redirect('admin/managelevelprices');
        }
    }
}
