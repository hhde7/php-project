<?php
namespace JeanForteroche\Blog\Model;

class Post
{
    private $id;
    private $title;
    private $creationDateFr;
    private $content;
    private $type;

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
        return $this->id;
    }

    public function setId($id)
    {

        $this->id = $id;
    }

    public function getTitle()
    {
        return mb_strtoupper($this->title) . ' ';
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreationDate()
    {
        return 'publié le ' . $this->creationDateFr;
    }

    public function setCreationDateFr($creationDateFr)
    {
        $this->creationDateFr = $creationDateFr;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

    }
}
