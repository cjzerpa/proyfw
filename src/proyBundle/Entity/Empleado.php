<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Empleado
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\EmpleadoRepository")
 */
class Empleado
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_seguro", type="string", length=10)
     */
    private $numeroSeguro;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=12)
     */
    private $telefono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=10)
     */
    private $cargo;


    /**
    *@ORM\ManyToMany(targetEntity="Visitas", mappedBy="empleados", cascade={"persist"}, orphanRemoval=true)
    */
    protected $visitas;

    /**
     * @ORM\OneToOne(targetEntity="User", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;


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
     * @return Empleado
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
     * @return Empleado
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
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Empleado
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set numeroSeguro
     *
     * @param string $numeroSeguro
     * @return Empleado
     */
    public function setNumeroSeguro($numeroSeguro)
    {
        $this->numeroSeguro = $numeroSeguro;

        return $this;
    }

    /**
     * Get numeroSeguro
     *
     * @return string 
     */
    public function getNumeroSeguro()
    {
        return $this->numeroSeguro;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Empleado
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Empleado
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Empleado
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return Empleado
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
    * Costructor
    */
    public function __construct()
    {
        $this->visitas = new ArrayCollection();
        
    }

    /**
     * Add visitas
     *
     * @param \proyBundle\Entity\Visutas $visitas
     * @return Empleado
     */
    public function addVisita(\proyBundle\Entity\Visutas $visitas)
    {
        $this->visitas[] = $visitas;

        return $this;
    }

    /**
     * Remove visitas
     *
     * @param \proyBundle\Entity\Visutas $visitas
     */
    public function removeVisita(\proyBundle\Entity\Visutas $visitas)
    {
        $this->visitas->removeElement($visitas);
    }

    /**
     * Get visitas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisitas()
    {
        return $this->visitas;
    }

    /**
     * __toString
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getNombre() . " " . $this->getApellido()." - ".$this->getCargo();
    }

    /**
     * Set user
     *
     * @param \proyBundle\Entity\User $user
     * @return Empleado
     */
    public function setUser(\proyBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \proyBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
