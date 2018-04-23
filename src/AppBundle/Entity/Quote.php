<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Quote
 *
 * @ORM\Table(name="quote", indexes={@ORM\Index(name="fk_quote_requerimiento1_idx", columns={"requerimiento_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuoteRepository")
 */
class Quote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMSS\Groups({"quote"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     *
     * @JMSS\Groups({"quote"})
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     *
     * @JMSS\Groups({"quote"})
     */
    private $isActive = '1';

    /**
     * @var \AppBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id_increment")
     * })
     *
     * @JMSS\Groups({"quote"})
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
     * @JMSS\Groups({"quote"})
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
     * Set description
     *
     * @param string $description
     *
     * @return Quote
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Quote
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
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Quote
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
     * @return Quote
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
