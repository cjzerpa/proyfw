<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recetas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\RecetasRepository")
 */
class Recetas
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="instrucciones", type="string", length=255)
     */
    private $instrucciones;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Recetas
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set instrucciones
     *
     * @param string $instrucciones
     * @return Recetas
     */
    public function setInstrucciones($instrucciones)
    {
        $this->instrucciones = $instrucciones;

        return $this;
    }

    /**
     * Get instrucciones
     *
     * @return string 
     */
    public function getInstrucciones()
    {
        return $this->instrucciones;
    }

    /**
     * Set visita
     *
     * @param \proyBundle\Entity\Visitas $visita
     * @return Recetas
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
        return $this->getNombre() . " ". $this->getInstrucciones();
    }
}
