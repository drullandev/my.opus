<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice", indexes={@ORM\Index(name="status", columns={"status_id"}), @ORM\Index(name="invoice_lease_fk", columns={"lease_id"}), @ORM\Index(name="IDX_906517449033212A", columns={"tenant_id"})})
 * @ORM\Entity
 */
class Invoice
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $endDate;

    /**
     * @var float|null
     *
     * @ORM\Column(name="amount", type="float", precision=4, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $amount = '0.00';

    /**
     * @var \Lease
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Lease")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lease_id", referencedColumnName="id")
     * })
     */
    private $lease;

    /**
     * @var \InvoiceStatus
     *
     * @ORM\ManyToOne(targetEntity="InvoiceStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * })
     */
    private $status;

    /**
     * @var \Tenant
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tenant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tenant_id", referencedColumnName="id")
     * })
     */
    private $tenant;

    public function getAmount(){
        return $this->amount;
    }

}
