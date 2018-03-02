<?php
namespace JeanForteroche\Blog\Model;

use JeanForteroche\Blog\Model\Counter;

require_once "model/Counter.php";

class CounterManager extends Manager
{
    public function setCount($postId, $ip, $postType)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO counter (postId, ip, postType, accessDate) VALUES (:postId, :ip, :postType, :accessDate)');
        setlocale(LC_TIME, 'fra_fra');
        $accessDate = strftime('%Y-%m-%d %H:%M:%S');
        $req->bindParam(':postId', $postId);
        $req->bindParam(':ip', $ip);
        $req->bindParam(':postType', $postType);
        $req->bindParam(':accessDate', $accessDate);

        $data = $req->execute();
        $counter = new Counter($data);

        return $counter;
    }

    public function mostReadArticle($type)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT postId, COUNT(*) FROM counter WHERE postType = ? GROUP BY postId ORDER BY COUNT(*) DESC LIMIT 1');
        $req->execute(array($type));
        $article = $req->fetch();

        return $article[0];
    }

    public function getReaders($period)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(DISTINCT ip) FROM counter WHERE DATEDIFF(NOW(), accessDate) <= ? ');
        $req->execute(array($period));
        $readers = $req->fetch();

        return $readers[0];
    }
}
