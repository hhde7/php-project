<?php
namespace JeanForteroche\Blog\Model;

class Comment
{	
	private $id;
	private $postId;
	private $postType;
	private $author;
	private $comment;
	private $commentDate;
	private $reported;

	public function __construct($data)
	{	
		$this->id = $data['id'];
		$this->postId = $data['postId'];
		$this->postType = $data['postType'];
		$this->author = $data['author'];
		$this->comment = $data['comment'];
		$this->commentDate = $data['commentDateFr'];
		$this->reported = $data['reported'];

		return $this;
	}

	public function getCommentId()
	{
		return $this->id;
	}

	public function setCommentId($commentId)
	{
		$this->id = $commentId;
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

	public function setPostType($postId)
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
		return $this->commentDate;
	}

	public function setCommentDate($commentDate)
	{
		$this->commentDate = $commentDate;
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