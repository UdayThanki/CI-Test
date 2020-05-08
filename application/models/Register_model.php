<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register_Model extends CI_Model{
    public function insert_user($data)
    {
        $this->db->insert('login', $data);
        return $this->db->insert_id();
    }   
    
    public function getproducts($postData=null){
        $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value

     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (name like '%".$searchValue."%' or description like '%".$searchValue."%') ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $this->db->where('is_deleted',0);
     $this->db->where('user_id',$this->session->userdata('id'));
     $records = $this->db->get('product')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     $this->db->where('user_id',$this->session->userdata('id'));
     $this->db->where('is_deleted',0);
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('product')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     $this->db->where('is_deleted',0);
     $this->db->where('user_id',$this->session->userdata('id'));
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('product')->result();

     $data = array();

     foreach($records as $record ){

        $color = ($record->color == 1)?"black ":"white";
        $p_type = ($record->p_type == 1)?" Home & Furniture  ":" Electronics ";
        $payment_type = ($record->qty == 1)?"1 ":"2";
        $image_name = base_url()."assets/images/".$record->image;
        $image = "<img src='".$image_name."' height='20' >";
        $id= '"'.$record->id.'"';
        $action = "<a href='javascript:void(0);' onclick='showmodel($id)' class='btn btn-primary'>Edit</a>     <a href='javascript:void(0);' onclick='delete_row($id)' class='btn btn-primary'>Delete</a>";
        $data[] = array( 
           "name"=>$record->name,
           "description"=>$record->description,
           "image"=>$image,
           "color"=>$color,
           "p_type"=>$p_type,
           "qty" => $payment_type,
           "action" => $action
        ); 
     }

     ## Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
   }

    
}