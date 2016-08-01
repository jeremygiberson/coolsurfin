<?php


namespace Coolsurfin\Models;
use DateTime;
use DateTimeZone;


/**
 * @Entity(repositoryClass="Coolsurfin\Repositories\CommentRepository")
 * @Table(name="comments")
 */
class Comment implements CommentInterface
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /** @Column(length=64) */
    private $author;
    /** @Column(length=1024) */
    private $text;
    /** @Column(type="datetime", name="posted_at") */
    private  $postedAt;
    /** @Column(length=32, name="secret_hash", nullable=true) */
    private  $secretHash;
    /** @Column(length=256, name="image_url", nullable=true) */
    private $imageUrl;

    public static function factory($author, $text, $secret = null)
    {
        $comment = new Comment();
        $comment->author = $author;
        $comment->text = $text;
        $comment->postedAt = new DateTime('now', new DateTimeZone('UTC'));
        if ($secret !== null) {
            $comment->secretHash = password_hash($secret, PASSWORD_DEFAULT);
        } else {
            $comment->secretHash = null;
        }
        return $comment;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * @return mixed
     */
    public function getSecretHash()
    {
        return $this->secretHash;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }



}