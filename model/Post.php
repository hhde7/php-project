<?php
namespace JeanForteroche\Blog\Model;

class Post
{
	private $id;
	private $title;
	private $creationDate;
	private $content;
	private $type;

	public function __construct ($data)
	{
		$this->id = $data['id'];
		$this->title = $data['title'];
		$this->creationDate = $data['creationDateFr'];
		$this->content = $data['content'];
		$this->type = $data['type'];
	}
	
	public function getPostId ()
	{
		return $this->id;
	}
	
	public function setPostId ($id)
	{
		$this->id = $id;
	}

	public function getTitle ()
	{
		return mb_strtoupper($this->title) . ' ';
	}
	
	public function setTitle ($title)
	{
		$this->title = $title;
	}

	public function getContent ()
	{
		return $this->content;
	}
	
	public function setContent ($content)
	{
		$this->content = $content;
	}

	public function getCreationDate ()
	{
		return 'publié le ' . $this->creationDate;
	}
	
	public function setCreationDate ($creationDate)
	{
		$this->creationDate = $creationDate;
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