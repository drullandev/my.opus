<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reminder
 *
 * @ORM\Table(name="reminder", indexes={@ORM\Index(name="type_fk", columns={"type_id"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Reminder
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
     * @var int
     *
     * @ORM\Column(name="invoice_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $invoiceId;

    /**
     * @var \ReminderType
     *
     * @ORM\ManyToOne(targetEntity="ReminderType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;


}
