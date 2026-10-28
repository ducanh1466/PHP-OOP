<?php

namespace App\Models;

use PDO;

class BaseModel extends DB {
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = []; // Mảng tên trường của bảng 
    
    public static function all() {
        $model = new static();
        $sql = "SELECT * FROM $model->table";
        // chuẩn bị truy vấn
        $stmt = $model->conn->prepare($sql);
        // thực thi truy vấn 
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }

    // Lấy ra 1 bản ghi 

    public static function find($id) {
        $model = new static();
        $sql = "SELECT * FROM $model->table WHERE $model->primaryKey=:$model->primaryKey";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute(["$model->primaryKey" => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result[0] ?? [4];
    }

    // Phương thức thêm mới bản ghi 

    public static function create($data) 
    {
        $model = new static();

        // chuyển mảng dữ liệu của fillable thành chuỗi các cột và giá trị
        $fields = implode(',', $model ->fillable );
        $values = ':' . implode(', :', $model->fillable);

        // ghép vào câu lệnh SQL INSERT
        $sql = "INSERT INTO $model->table ($fields) VALUES ($values)";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute($data);
        return $model->conn->lastInsertId();
    }
    // phương thức cập nhật dữ liệu 

    public static function update($id, $data) {
        $model = new static;

        //Khai báo mảng chưa dữ liệu placeholder

        $sets = [];
        foreach ($model->fillable as $field) {
            $sets[] = "$field = :$field";
        }

        //Chuyển mảng sets thành chuỗi
        $sqlSet = implode(',', $sets);

        // Câu lệnh SQL UPDATE
        $sql = "UPDATE $model->table SET $sqlSet WHERE 
        $model->primaryKey=:$model->primaryKey";
        
        $stmt = $model->conn->prepare($sql);
        $data["$model->primaryKey"] = $id;
        
        return $stmt->execute($data);
    } 

    // xóa dữ liệu theo id 
    public static function delete($id) 
    {
        $model = new static();
        $sql = "DELETE FROM $model->table WHERE 
        $model->primaryKey = :$model->primaryKey";
        $stmt = $model->conn->prepare($sql);
        return $stmt->execute(["$model->primaryKey" => $id]);
    }
        
}