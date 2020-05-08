<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function login_user()
    {
		$this->load->model('User');
        $userName = trim($this->input->post('userName'));
        $password = trim(md5($this->input->post('password')));
        $query = $this->User->login($userName, $password);
        if ($query) {
            $user = array(
                'id' => $query[0]->id,
                'name' => $query[0]->name,
            );

            $this->session->set_userdata($user);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('message_name', 'Email or password is wrong');
            redirect('login');
        }

	}
	
	public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }


}
