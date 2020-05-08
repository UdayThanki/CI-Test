<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('name') == '') {
            redirect('login');
        }

    }
    public function index()
    {
        $this->load->view('header');
        $this->load->view('dashboard');
        $this->load->view('footer');
    }

    public function store()
    {
        $config['upload_path'] = "./assets/images";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("file")) {
            $data = array('upload_data' => $this->upload->data());  
        }



        $id= $this->input->post('rec_id');
        $name= $this->input->post('product_name');
        $description= $this->input->post('product_desc');
        $image = $data['upload_data']['file_name'];  
        $color= $this->input->post('color');
        $type= $this->input->post('product_type');
        $payment= $this->input->post('qty');

        if($data['upload_data']['file_name'] != ""){
            $data = array(
                'name'  => $name,
                'user_id' => $this->session->userdata('id'),
                'image' => $image,
                'description'  => $description,
                'color'  => $color,
                'p_type'  => $type,
                'qty' => $payment,
                'created_date' => date("Y-m-d h:i:sa")
               );
        }else{
            $data = array(
                'name'  => $name,
                'user_id' => $this->session->userdata('id'),
                'description'  => $description,
                'color'  => $color,
                'p_type'  => $type,
                'qty' => $payment,
                'created_date' => date("Y-m-d h:i:sa")
               );
        }
  
           if($id != ""){
            $this->db->where('id', $id);
            $this->db->update('product', $data);
           }else{
            $this->db->insert('product', $data);
           }
           
           return $this->db->insert_id();

    }


    public function ajexfile(){
        $postData = $this->input->post();
        $this->load->model('Register_model');
        $data =$this->Register_model->getproducts($postData);
        
        echo json_encode($data);
    }

    public function getdata(){
      
        $this->db->select('*');
        $this->db->where('id',$_REQUEST['id_val']);
        $records = $this->db->get('product')->result_array();
    
        echo json_encode($records);
    }
    public function delete(){
        $this->db->where('id', $_REQUEST['id_val']);
        $this->db->update('product', array('is_deleted'=>1));
    }

}