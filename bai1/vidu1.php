<?php

class Person{
    public $name;
    public $age;
    public function an(){
        echo $this -> name . "Đang ăn <br>";
    }
    public function lamViec(){
        echo $this->name . "Đang làm việc chăm chỉ <br>";
    }
}

$person1 = new Person;
$person1->name = "Nam";
$person1->age = 23;

//Hàm __construct là hàm khởi tạo, sẽ tự động chạy khi tạo đối tượng
public function __construct($name, $age){
{
    $this->name = $name;
    $this->age =$age
}
public function an()
{
    echo $this->name . "Đang ăn <br>";
}
public function lamViec()
{
    echo $this->name . "Đang làm việc chăm chỉ <br>";
}
}

$person1->an();
$person1->lamViec();


//Bài tập
//Hãy viết 1 lớp động vật bao gồm các thuộc tính: màu sắc, cân nặng, loài và các hành vi ăn, bắt mồi

class Dongvat{
    public $name;
    public $mauSac;
    public $canNang;
    public $loai;
    public function an(){
        echo $this->name . "Đang ăn <br>";
    }
    public function batMoi(){
        echo $this->name . "Đang bắt mồi <br>";
    }

}
?>