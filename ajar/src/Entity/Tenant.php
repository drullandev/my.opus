<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tenant
 *
 * @ORM\Table(name="tenant", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Tenant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=256, nullable=false)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="email_on", type="boolean", nullable=false)
     */
    private $emailOn = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="mobile_phone_number", type="integer", nullable=false)
     */
    private $mobilePhoneNumber;

    /**
     * @var bool
     *
     * @ORM\Column(name="sendsms_on", type="boolean", nullable=false)
     */
    private $sendsmsOn = '0';


}
