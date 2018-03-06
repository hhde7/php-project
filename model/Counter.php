<?php
namespace JeanForteroche\Model;

class Counter
{
    private $postId;
    private $ip;
    private $postType;
    private $accessDate;

    public function __construct($data)
    {
        if (is_array($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getPostType()
    {
        return $this->postType;
    }

    public function setPostType($postType)
    {
        $this->postType = $postType;
    }

    public function getAccessDate()
    {
        return $this->accessDate;
    }

    public function setAccessDate($accessDate)
    {
        $this->accessDate = $accessDate;
    }
}
