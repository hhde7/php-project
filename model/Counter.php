<?php
namespace JeanForteroche\Blog\Model;

class Counter
{
	private $postId;
	private $ip;
	private $postType;
	private $accessDate;

	public function __construct($data)
	{
		$this->postId = $data['postId'];
		$this->ip = $data['ip'];
		$this->postType = $data['postType'];
		$this->accessDate = $data['accessDate'];
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

