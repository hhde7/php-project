<?php
namespace JeanForteroche\Model;

class Comment
{
    private $id;
    private $postId;
    private $postType;
    private $author;
    private $comment;
    private $commentDateFr;
    private $reported;

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

    public function getCommentId()
    {
        return $this->id;
    }

    public function setId($Id)
    {
        $this->id = $Id;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getPostType()
    {
        return $this->postType;
    }

    public function setPostType($postType)
    {
        $this->postType = $postType;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getCommentDate()
    {
        return $this->commentDateFr;
    }

    public function setCommentDateFr($commentDateFr)
    {
        $this->commentDateFr = $commentDateFr;
    }

    public function getReported()
    {
        return $this->reported;
    }

    public function setReported($reported)
    {
        $this->reported = $reported;
    }
}
