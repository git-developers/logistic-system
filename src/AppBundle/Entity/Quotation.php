<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Quotation
 *
 * @ORM\Table(name="quotation", indexes={@ORM\Index(name="fk_quotation_proveedor1_idx", columns={"proveedor_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuotationRepository")
 */
class Quotation
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
     * @JMSS\Groups({"quotation", "quotation_main", "quotation_detalle"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="requerimiento_id", type="integer", nullable=false)
     * @JMSS\Groups({"quotation", "quotation_main", "quotation_detalle"})
     */
    private $requerimientoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * @JMSS\Groups({"quotation", "quotation_detalle"})
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="forma_pago", type="string", length=45, nullable=true)
     * @JMSS\Groups({"quotation"})
     */
    private $formaPago;

    /**
     * @var string
     *
     * @ORM\Column(name="monto_total", type="string", nullable=true)
     * @JMSS\Groups({"quotation", "quotation_main"})
     */
    private $montoTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_unitario", type="string", nullable=true)
     * @JMSS\Groups({"quotation"})
     */
    private $precioUnitario;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_pedida", type="integer", nullable=true)
     * @JMSS\Groups({"quotation"})
     */
    private $cantidadPedida;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var \AppBundle\Entity\Proveedor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"quotation", "quotation_main", "quotation_detalle"})
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=true)
     * @JMSS\Groups({"quotation"})
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\QuotationMain", mappedBy="quotation")
     */
    private $quotationMain;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quotationMain = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set requerimientoId
     *
     * @param integer $requerimientoId
     *
     * @return Quotation
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
     * Set productId
     *
     * @param integer $productId
     *
     * @return Quotation
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set formaPago
     *
     * @param string $formaPago
     *
     * @return Quotation
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return string
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set montoTotal
     *
     * @param string $montoTotal
     *
     * @return Quotation
     */
    public function setMontoTotal($montoTotal)
    {
        $this->montoTotal = $montoTotal;

        return $this;
    }

    /**
     * Get montoTotal
     *
     * @return string
     */
    public function getMontoTotal()
    {
        return $this->montoTotal;
    }

    /**
     * Set precioUnitario
     *
     * @param string $precioUnitario
     *
     * @return Quotation
     */
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;

        return $this;
    }

    /**
     * Get precioUnitario
     *
     * @return string
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * Set cantidadPedida
     *
     * @param integer $cantidadPedida
     *
     * @return Quotation
     */
    public function setCantidadPedida($cantidadPedida)
    {
        $this->cantidadPedida = $cantidadPedida;

        return $this;
    }

    /**
     * Get cantidadPedida
     *
     * @return integer
     */
    public function getCantidadPedida()
    {
        return $this->cantidadPedida;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Quotation
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

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Add quotationMain
     *
     * @param \AppBundle\Entity\QuotationMain $quotationMain
     *
     * @return Quotation
     */
    public function addQuotationMain(\AppBundle\Entity\QuotationMain $quotationMain)
    {
        $this->quotationMain[] = $quotationMain;

        return $this;
    }

    /**
     * Remove quotationMain
     *
     * @param \AppBundle\Entity\QuotationMain $quotationMain
     */
    public function removeQuotationMain(\AppBundle\Entity\QuotationMain $quotationMain)
    {
        $this->quotationMain->removeElement($quotationMain);
    }

    /**
     * Get quotationMain
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuotationMain()
    {
        return $this->quotationMain;
    }
}
