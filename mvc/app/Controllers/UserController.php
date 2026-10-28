<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function register() {
        $data = [
            'username' => 'ducanh',
            'email' => 'anh@gmail.com',
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'role' => 'admin'
        ];
        try {

        User::create($data);
        echo "Thêm thành công 1 tài khoản";
        }catch (\Throwable $th) {
            throw $th;
        }

    }

    public function login(){
        return $this->view('auth.login');
    }

    public function LoginPost() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::getUserOfEmail($email);
        
        //Nếu tồn tại user
        if ($user) {
            // Kiểm tra mật khẩu của user
            if ( password_verify($password, $user->password) ) {
                $_SESSION['user'] = $user;
                header("location: " . BASE_URL . 'admin/articles');
                exit();
            }
        }

        $error = "Email hoặc Password không chính xác";
        return $this->view('auth.login', compact('error', 'email'));
    }
    public function logout () {
        unset($_SESSION['user']);
        header('Location: ' . BASE_URL . 'auth/login');
        exit;
    }
}