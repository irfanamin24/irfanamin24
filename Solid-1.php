<?php

class json{
    public static function from($data){
        return json_encode($data);   
    }
}

class UserRequest {
    protected static $rules = [
        'name' => 'Irfan Amin',
        'email' => 'Irfan1900018269@webmail.uad.ac.id',
        'dob' => '24.5.2001',
    ];

    public static function validate($data){
        foreach(static::$rules as $property => $type){
            if (gettype($data[$property]) !== $type)
                throw new \Exception("User Property {$property} Must Be Of Type {$type}");
        }
    }
}

class  User {
    public $name;
    public $email;
    public $dob;

    public function __construct($data){
        $this->name = $data['nama'];
        $this->email = $data['email'];
        $this->dob = $data['dob'];
    }
}

Route::get('/', function(){
    $data = request()->query();

    $user = new User($data);

    $user->validate($data);

    return Json::from($data);
});