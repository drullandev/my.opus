<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lease
 *
 * @ORM\Table(name="lease", indexes={@ORM\Index(name="id", columns={"id"}), @ORM\Index(name="tenant_id", columns={"tenant_id"}), @ORM\Index(name="property_unit_id", columns={"property_unit_id"})})
 * @ORM\Entity
 */
class Lease
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
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=false)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var \PropertyUnit
     *
     * @ORM\ManyToOne(targetEntity="PropertyUnit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="property_unit_id", referencedColumnName="id")
     * })
     */
    private $propertyUnit;

    /**
     * @var \Tenant
     *
     * @ORM\ManyToOne(targetEntity="Tenant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tenant_id", referencedColumnName="id")
     * })
     */
    private $tenant;


}
