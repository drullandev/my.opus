<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reviews
 *
 * @ORM\Table(name="reviews")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReviewsRepository")
 */
class Reviews
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idhotel", type="integer")
     */
    private $idhotel;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var array
     *
     * @ORM\Column(name="review", type="array", nullable=true)
     */
    private $review;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    private $score;

    /**
     * @var array
     *
     * @ORM\Column(name="my_review", type="array", nullable=true)
     */
    private $myReview;

    /**
     * @var int
     *
     * @ORM\Column(name="my_score", type="integer", nullable=true)
     */
    private $myScore;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idhotel
     *
     * @param integer $idhotel
     * @return Reviews
     */
    public function setIdhotel($idhotel)
    {
        $this->idhotel = $idhotel;

        return $this;
    }

    /**
     * Get idhotel
     *
     * @return integer 
     */
    public function getIdhotel()
    {
        return $this->idhotel;
    }

    /**
     * Set idreview
     *
     * @param integer $idreview
     * @return Reviews
     */
    public function setIdreview($idreview)
    {
        $this->idreview = $idreview;

        return $this;
    }

    /**
     * Get idreview
     *
     * @return integer 
     */
    public function getIdreview()
    {
        return $this->idreview;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Reviews
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set review
     *
     * @param array $review
     * @return Reviews
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return array 
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return Reviews
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set myReview
     *
     * @param array $myReview
     * @return Reviews
     */
    public function setMyReview($myReview)
    {
        $this->myReview = $myReview;

        return $this;
    }

    /**
     * Get myReview
     *
     * @return array 
     */
    public function getMyReview()
    {
        return $this->myReview;
    }

    /**
     * Set myScore
     *
     * @param integer $myScore
     * @return Reviews
     */
    public function setMyScore($myScore)
    {
        $this->myScore = $myScore;

        return $this;
    }

    /**
     * Get myScore
     *
     * @return integer 
     */
    public function getMyScore()
    {
        return $this->myScore;
    }
}
