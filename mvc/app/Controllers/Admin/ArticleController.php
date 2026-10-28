<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::getAllCategery();
        // Lấy ra thông báo
        $message = $_SESSION['success'] ?? ''; // Nếu không có thông báo thì mặc định là rỗng
        unset($_SESSION['success']); // Xóa thông báo sau khi hiển thị
        return $this->view('admin.articles.index', compact('articles', 'message'));
    }

    public function create()
    {
        $categories = Category::all();
        return $this->view('admin.articles.create', compact('categories'));
    }

    public function store() {
        $posts = $_POST;

        $posts['image'] = '';

        // validate dữ liệu
        $error = []; // lưu thông tin lỗi 
        if ($posts['title'] == '' || trim($posts['title']) == '') {
            $error['title'] = 'Tiêu đề không được để trống';
        }


        //Thêm ảnh
        $file = $_FILES['image'];
        // quy định định dạng ảnh được phép
        $img_ext = ['jpg', 'png', 'jpeg'];

        if ($file['size'] > 0) {
            // Lấy định dạng của file
            $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            if ( !in_array($file_ext, $img_ext) ) {
                $error['image'] = " Bạn cần chọn ảnh đúng định dạng ";
            }
            
        }
        if ($error) {
            $categories = Category::all();
            return $this->view('admin.articles.create', compact('categories', 'error', 'posts'));
        }
        if ($file['size'] > 0 ) {
            $path_image = 'images/' . $file['name'];
            move_uploaded_file($file['tmp_name'], ROOT_DIR . '/' . $path_image);

            $posts['image'] = $path_image;
        }
        Article::create($posts);
        
        header('Location: ' . BASE_URL . 'admin/articles');
    }

    public function edit($id) 
    {
       $post = Article::find($id);
       $categories = Category::all();

       // Nếu chúng ta gửi lên sever là post thì sẽ thực hiện cập nhật

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $posts = $_POST;
            $file = $_FILES['image'];
            $posts['image'] = $post->image; // giữ nguyên ảnh cũ nếu không có ảnh mới được upload

            //Thêm ảnh
            $file = $_FILES['image'];
            if ($file['size'] > 0) {
                $path_image = 'images/' . $file['name'];
                move_uploaded_file($file['tmp_name'], ROOT_DIR . '/' . $path_image);

                $posts['image'] = $path_image;
            }

            Article::update($id, $posts);
            // Lưu thông báo vào session
            $_SESSION['success'] = 'Cập nhật thành công!';
            
            return header('Location: ' . BASE_URL . 'admin/articles');
       }

       return $this->view('admin.articles.edit', compact('post', 'categories'));
    }

    public function delete($id) {
        Article::delete($id);
        // Lưu thông báo vào session
        $_SESSION['success'] = 'Xóa thành công!';
        return header('Location: ' . BASE_URL . 'admin/articles');
    }


}