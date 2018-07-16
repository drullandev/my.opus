<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReminderType
 *
 * @ORM\Table(name="reminder_type")
 * @ORM\Entity
 */
class ReminderType
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=5, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;


}
