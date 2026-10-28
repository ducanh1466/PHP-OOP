<?php

namespace App\Models;

class User extends BaseModel {
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'role'
    ];

    public static function getUserOfEmail($email){
        $model = new static;
        $sql = "SELECT * FROM $model->table WHERE email=:email";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS)[0] ?? [];
    }
}