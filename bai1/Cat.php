<?php

class Cat extends Animal{
    public function getAge()
    {
        return $this->age;
    }

    public function an(){
        echo $this->getName() . "Đang ăn chuột <br>";
    }
}