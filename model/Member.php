<?php
namespace JeanForteroche\Blog\Model;

class Member
{
    private $id;
    private $role;
    private $user;
    private $password;
    private $email;
    private $registrationDate;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->role = $data['role'];
        $this->user  = $data['user'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->registrationDate = $data['registrationDate'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }
}
