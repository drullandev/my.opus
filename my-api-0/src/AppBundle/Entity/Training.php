<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="_training")
 */

class Training {

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
    public $id;

 	/**
	 * @ORM\Column(type="string", length=255)
	 */
	public $category;

	/**
	 * @ORM\Column(type="text")
	 */
    public $description;

}
