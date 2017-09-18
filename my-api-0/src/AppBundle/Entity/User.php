<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $id;

	/**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
	 * @ORM\Column(type="string", length=255)
	 */
	public $email;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	public $phonenum;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	public $address;

}
