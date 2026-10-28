<?php

namespace App\Models;

class Article extends BaseModel {
    protected $table = 'news';
    protected $fillable = [
        'title',
        'image',
        'description',
        'content',
        'category_id'
    ];
    public static function getAllCategery() {
        $model = new static();
        $sql = "SELECT n.*, name FROM news n JOIN categories c ON n.category_id = c.id";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $results;
    }
    
}