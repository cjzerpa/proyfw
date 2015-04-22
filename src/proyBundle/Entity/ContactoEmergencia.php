<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactoEmergencia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ContactoEmergencia
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=12)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="relacion", type="string", length=10)
     */
    private $relacion;

    /**
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="contactosEmergencia")
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     */
    protected $paciente; 


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
     * @return ContactoEmergencia
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
     * Set apellido
     *
     * @param string $apellido
     * @return ContactoEmergencia
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return ContactoEmergencia
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set relacion
     *
     * @param string $relacion
     * @return ContactoEmergencia
     */
    public function setRelacion($relacion)
    {
        $this->relacion = $relacion;

        return $this;
    }

    /**
     * Get relacion
     *
     * @return string 
     */
    public function getRelacion()
    {
        return $this->relacion;
    }

    /**
     * Set paciente
     *
     * @param \proyBundle\Entity\Paciente $paciente
     * @return ContactoEmergencia
     */
    public function setPaciente(\proyBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \proyBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    public function __toString()
    {
        return $this->nombre. " ".$this->apellido. " ". $this->numero. " ". $this->relacion." de ". $this->getPaciente().__toString();
    }
}
