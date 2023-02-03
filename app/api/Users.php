<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
class Users extends Controller{
    private $user;
    function __construct() {
        $this->user=$this->model('User');
    }
    
    public function register(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            extract($_POST);
            $data = [
                'user_name' => $_POST['user_name'] ,
                'user_username' => $_POST['user_username'] ,
                'password' => $_POST['password'] 
            ];
            $data['password'] = password_hash($data['password'] , PASSWORD_DEFAULT);
            if($this->user->register($data)==true){
                echo json_encode(['added' => 'added']);
               
            }
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            extract($_POST);
            $data=$this->user->login($user_id,$password);
          $data;
         
            $this->view('/user/index');
         
        }
    }
}
