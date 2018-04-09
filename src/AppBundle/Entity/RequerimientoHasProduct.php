<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * RequerimientoHasProduct
 *
 * @ORM\Table(name="requerimiento_has_product", indexes={@ORM\Index(name="fk_requerimiento_has_product_product1_idx", columns={"product_id"}), @ORM\Index(name="fk_requerimiento_has_product_requerimiento1_idx", columns={"requerimiento_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RequerimientoHasProductRepository")
 */
class RequerimientoHasProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMSS\Groups({"requerimiento_has_product"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="stock", type="string", length=45, nullable=true)
     *
     * @JMSS\Groups({"requerimiento_has_product"})
     */
    private $stock;

    /**
     * @var \AppBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id_increment")
     * })
     *
     * @JMSS\Groups({"product", "requerimiento_has_product"})
     */
    private $product;

    /**
     * @var \AppBundle\Entity\Requerimiento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Requerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="requerimiento_id", referencedColumnName="id_increment")
     * })
     *
     * @JMSS\Groups({"requerimiento_has_product"})
     */
    private $requerimiento;



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
     * Set stock
     *
     * @param string $stock
     *
     * @return RequerimientoHasProduct
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return string
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return RequerimientoHasProduct
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set requerimiento
     *
     * @param \AppBundle\Entity\Requerimiento $requerimiento
     *
     * @return RequerimientoHasProduct
     */
    public function setRequerimiento(\AppBundle\Entity\Requerimiento $requerimiento = null)
    {
        $this->requerimiento = $requerimiento;

        return $this;
    }

    /**
     * Get requerimiento
     *
     * @return \AppBundle\Entity\Requerimiento
     */
    public function getRequerimiento()
    {
        return $this->requerimiento;
    }
}
