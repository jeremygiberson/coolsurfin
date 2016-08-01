<?php


namespace Coolsurfin\ViewModels;


use Coolsurfin\Models\Comment;
use Coolsurfin\Models\CommentInterface;

class CommentViewModel implements CommentInterface {
    /** @var  Comment */
    private $comment;
    /** @var  string */
    private $headline;
    /** @var  string */
    private $body;

    /**
     * CommentViewModel constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;

        preg_match_all('/(?:[^\.,?!])[\.,?!]/', $comment->getText(), $matches, PREG_OFFSET_CAPTURE);
        if(!empty($matches) && count($matches[0]) > 1) {
            $this->headline = substr($comment->getText(), 0, $matches[0][0][1]+2);
            $this->body = substr($comment->getText(), $matches[0][0][1]+2);
        } else {
            $this->headline = 'untitled';
            $this->body = $comment->getText();
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->comment->getId();
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->comment->getAuthor();
    }

    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getPostedAt()
    {
        return $this->comment->getPostedAt();
    }

    /**
     * @return mixed
     */
    public function getSecretHash()
    {
        return md5($this->comment->getSecretHash());
    }

    public function hasSecret()
    {
        return $this->comment->getSecretHash() !== null;
    }

    public function getIdenticonImageDataUri($size=32)
    {
        $identicon = new \Identicon\Identicon();
        return $identicon->getImageDataUri($this->getSecretHash(), $size);
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->comment->getImageUrl();
    }

    public function hasMore() {
        return $this->comment->getId() > 1;
    }

    public function getNext() {
        return $this->hasMore() ? $this->comment->getId() - 1 : 0;
    }
}

