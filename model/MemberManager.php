<?php
namespace JeanForteroche\Blog\Model;

use JeanForteroche\Blog\Model\Member;

require_once "model/Manager.php";
require_once "model/Member.php";

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
