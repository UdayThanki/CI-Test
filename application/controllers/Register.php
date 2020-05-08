<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('register');
		$this->load->view('footer');
    }
    

    Public function store(){

        $this->form_validation->set_rules('user_name', 'Name', 'required|trim');
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
    
        if ($this->form_validation->run()) {
            $this->input->post('user_name');
            $this->input->post('user_password');
            $this->input->post('user_email');

            $data = array(
                'name'  => $this->input->post('user_name'),
                'password'  => md5($this->input->post('user_password')),
                'email' => $this->input->post('user_email'),
               );
            $this->load->model('Register_model');
            $this->Register_model->insert_user($data);
            echo json_encode("Registration are successfully");
        } else {
            $data = array(
                'user_name' => form_error('user_name'),
                'user_email' => form_error('user_email'),
                'user_password' => form_error('user_password')
            );

            echo json_encode($data);
        }



    }
    
}
