<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Referencias
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\ReferenciasRepository")
 */
class Referencias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_doctor", type="string", length=100)
     */
    private $nombreDoctor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Visitas", inversedBy="referencias")
     * @ORM\JoinColumn(name="visita_id", referencedColumnName="id")
     */
    protected $visita;

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
     * Set nombreDoctor
     *
     * @param string $nombreDoctor
     * @return Referencias
     */
    public function setNombreDoctor($nombreDoctor)
    {
        $this->nombreDoctor = $nombreDoctor;

        return $this;
    }

    /**
     * Get nombreDoctor
     *
     * @return string 
     */
    public function getNombreDoctor()
    {
        return $this->nombreDoctor;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Referencias
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Referencias
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set visita
     *
     * @param \proyBundle\Entity\Visitas $visita
     * @return Referencias
     */
    public function setVisita(\proyBundle\Entity\Visitas $visita = null)
    {
        $this->visita = $visita;

        return $this;
    }

    /**
     * Get visita
     *
     * @return \proyBundle\Entity\Visitas 
     */
    public function getVisita()
    {
        return $this->visita;
    }

    /**
     * __toString
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getNombreDoctor() . " ". $this->getFecha();
    }
}
