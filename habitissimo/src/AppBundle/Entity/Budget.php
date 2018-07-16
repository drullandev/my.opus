<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="budgeting")
 */
class Budget {

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	public $user_id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	public $category;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	public $title;

	/**
	 * @ORM\Column(type="text")
	 */
	public $description;

	/**
	 * @ORM\Column(type="string", length=128)
	 */
	public $status = 'pendiente';

}
