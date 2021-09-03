<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("app_model");
    }

     public function index(){
     
      if($this->session->userdata("is_active") == 1){


       $data = array(
        "page_content" => "pages/dashboard"
        );
       $this->load->view("layout/main_layout", $data);
      }else{
         $this->load->view("pages/login");
      }

   }
    public function validate_login_details(){

      $login_details = $this->input->post();

      $email = isset($login_details['txt_email']) ? $login_details['txt_email'] : "";
      $password = isset($login_details['txt_password']) ? $login_details['txt_password'] : "";
      //$password = isset($login_details['txt_password']) ? $login_details['txt_password'] : "";

      if($this->app_model->is_admin_exists($email,$password)){


        $this->session->set_userdata([
          "is_active" => 1,
          "email" => $email,
          "name" => $profile->name
          ]);

      }else{

        $this->session->set_flashdata("error","Invalid login credentials");
      }

      return redirect(base_url());

   }
}

?>
