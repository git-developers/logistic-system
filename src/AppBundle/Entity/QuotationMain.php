<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * QuotationMain
 *
 * @ORM\Table(name="quotation_main")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuotationMainRepository")
 */
class QuotationMain
{

    const ESTADO_APROBADO = 'APROBADO';
    const ESTADO_NO_APROBADO = 'NO_APROBADO';
    const ESTADO_COMPLETADO = 'COMPLETADO';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"quotation_main", "quotation_detalle"})
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="requerimiento_id", type="integer", nullable=true)
     * @JMSS\Groups({"quotation_main", "quotation_detalle"})
     */
    private $requerimientoId;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=true)
     * @JMSS\Groups({"quotation_main", "quotation_detalle"})
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Quotation", inversedBy="quotationMain")
     * @ORM\JoinTable(name="quotation_main_has_quotation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="quotation_main_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="quotation_id", referencedColumnName="id")
     *   }
     * )
     * @JMSS\Groups({"quotation_main", "quotation_detalle"})
     */
    private $quotation;

    /**
     * @var \AppBundle\Entity\Proveedor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"quotation_main", "quotation_detalle"})
     */
    private $proveedor;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quotation = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return QuotationMain
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set requerimientoId
     *
     * @param integer $requerimientoId
     *
     * @return QuotationMain
     */
    public function setRequerimientoId($requerimientoId)
    {
        $this->requerimientoId = $requerimientoId;

        return $this;
    }

    /**
     * Get requerimientoId
     *
     * @return integer
     */
    public function getRequerimientoId()
    {
        return $this->requerimientoId;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return QuotationMain
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add quotation
     *
     * @param \AppBundle\Entity\Quotation $quotation
     *
     * @return QuotationMain
     */
    public function addQuotation(\AppBundle\Entity\Quotation $quotation)
    {
        $this->quotation[] = $quotation;

        return $this;
    }

    /**
     * Remove quotation
     *
     * @param \AppBundle\Entity\Quotation $quotation
     */
    public function removeQuotation(\AppBundle\Entity\Quotation $quotation)
    {
        $this->quotation->removeElement($quotation);
    }

    /**
     * Get quotation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuotation()
    {
        return $this->quotation;
    }


    /**
     * Set proveedor
     *
     * @param \AppBundle\Entity\Proveedor $proveedor
     *
     * @return Quotation
     */
    public function setProveedor(\AppBundle\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \AppBundle\Entity\Proveedor
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
}
