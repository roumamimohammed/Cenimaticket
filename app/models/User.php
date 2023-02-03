<?php

class User extends database{
    function __construct() { }


    function register($data){
        $sql = "INSERT INTO `user`(`user_name`, `user_username`, `password`) VALUES (:user_name,:user_username,:password)";
        $stmt=$this->openConnection()->prepare($sql);
        $stmt->bindParam(':user_name', $data['user_name']);
        $stmt->bindParam(':user_username', $data['user_username']);
        $stmt->bindParam(':password', $data['password']);
        if($stmt->execute()){
            return true;
        }
    }

    public function login($user_id,$password){
        $sql = "SELECT `user_id`,`user_name`, `user_username`, `password` FROM `user` WHERE user_id=:user_id";
        $stmt=$this->openConnection()->prepare($sql);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();
        if($stmt->rowCount()==1){
            $res=$stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password,$res['password'])){
                $_SESSION['user_id']=$res['user_id'];
                $_SESSION['user_name']=$res['user_name'];
                $_SESSION['user_username']=$res['user_username'];
                $_SESSION['password']=$res['password'];
                return $_SESSION['user_id'];
            }
            else{
                return false;
            } 
        }
        else{
            return false;
        }
    }
}


