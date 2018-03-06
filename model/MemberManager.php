<?php
namespace JeanForteroche\Model;

class MemberManager extends Manager
{
    public function memberCheck($email, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM members WHERE email = ? AND password = ?');
        $req->execute(array($email, $password));
        $data = $req->fetch();
        $member = new Member($data);

        return $member;
    }
}
