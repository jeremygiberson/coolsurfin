<?php
namespace Coolsurfin\Models;


/**
 * @Entity(repositoryClass="Coolsurfin\Repositories\CommentRepository")
 * @Table(name="comments")
 */
interface CommentInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getAuthor();

    /**
     * @return mixed
     */
    public function getText();

    /**
     * @return mixed
     */
    public function getPostedAt();

    /**
     * @return mixed
     */
    public function getSecretHash();

    /**
     * @return mixed
     */
    public function getImageUrl();
}