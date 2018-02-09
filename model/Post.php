<?php
namespace JeanForteroche\Blog\Model;

class Post
{
	private $title;
	private $creationDate;
	private $content;
	private $type;

	public function __construct ($data)
	{
		$this->title = $data['title'];
		$this->creationDate = $data['creationDateFr'];
		$this->content = $data['content'];
		$this->type = $data['type'];
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