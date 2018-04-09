<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Requerimiento
 *
 * @ORM\Table(name="requerimiento",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="code_UNIQUE", columns={"code"})
 *      },
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RequerimientoRepository")
 * @UniqueEntity(
 *     fields={"code"},
 *     message="El code fue registrado anteriormente."
 * )
 */
class Requerimiento
{

    const ESTADO_APROBADO = 'APROBADO';
    const ESTADO_NO_APROBADO = 'NO_APROBADO';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="compania", type="string", length=45, nullable=true)
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $compania;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=45, nullable=true)
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=45, nullable=true)
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $prioridad;

    /**
     * @var string
     *
     * @ORM\Column(name="almacen", type="string", length=45, nullable=true)
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $almacen;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_requerida", type="date", length=45, nullable=true)
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $fechaRequerida;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=true)
     * @JMSS\Groups({"requerimiento", "requerimiento_has_product"})
     */
    private $estado;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     * @JMSS\Groups({"requerimiento"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=150, nullable=true)
     * @JMSS\Groups({"requerimiento", "product"})
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"requerimiento", "product"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var \AppBundle\Entity\Requerimiento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Requerimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"requerimiento"})
     */
    private $requerimiento;


    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"requerimiento"})
     */
    private $nameBox;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=true)
     * })
     *
     * @JMSS\Groups({"requerimiento"})
     */
    private $user;


    public function __toString() {
        return sprintf('%s - %s', $this->idIncrement, $this->name);
    }


    /**
     * Get idIncrement
     *
     * @return integer
     */
    public function getIdIncrement()
    {
        return $this->idIncrement;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Category
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Category
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Category
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
     * @return string
     */
    public function getCompania()
    {
        return $this->compania;
    }

    /**
     * @param string $compania
     */
    public function setCompania($compania)
    {
        $this->compania = $compania;
    }

    /**
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * @param string $prioridad
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;
    }

    /**
     * @return string
     */
    public function getAlmacen()
    {
        return $this->almacen;
    }

    /**
     * @param string $almacen
     */
    public function setAlmacen($almacen)
    {
        $this->almacen = $almacen;
    }

    /**
     * @return \Date
     */
    public function getFechaRequerida()
    {
        return $this->fechaRequerida;
    }

    /**
     * @param \Date $fechaRequerida
     */
    public function setFechaRequerida($fechaRequerida)
    {
        $this->fechaRequerida = $fechaRequerida;
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
     * @return Requerimiento
     */
    public function getRequerimiento()
    {
        return $this->requerimiento;
    }

    /**
     * @param Requerimiento $requerimiento
     */
    public function setRequerimiento(\AppBundle\Entity\Requerimiento $requerimiento = null)
    {
        $this->requerimiento = $requerimiento;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getNameBox()
    {
        return sprintf('%s', $this->name);
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Requerimiento
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
