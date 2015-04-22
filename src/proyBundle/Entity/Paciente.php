<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
/**
 * Paciente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\PacienteRepository")
 */
class Paciente
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
     * @ORM\Column(name="cedula", type="string", length=100)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="seguro_social", type="string", length=10)
     */
    private $seguroSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=20)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="medico_preferido", type="string", length=100)
     */
    private $medicoPreferido;

    /**
    *   @ORM\OneToMany(targetEntity="NumerosPaciente", mappedBy="paciente", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $numerosPaciente;

    /**
    *   @ORM\OneToMany(targetEntity="ContactoEmergencia", mappedBy="paciente", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $contactosEmergencia;

    /**
    *   @ORM\OneToMany(targetEntity="Citas", mappedBy="paciente", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $citas;

    /**
     * @ORM\OneToOne(targetEntity="HistoriaClinica", mappedBy="paciente", cascade={"persist"}, orphanRemoval=true)
     **/
    private $historia_clinica;




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
     * Set apellido
     *
     * @param string $apellido
     * @return Paciente
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
     * Set nombre
     *
     * @param string $nombre
     * @return Paciente
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
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Paciente
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
     * Set direccion
     *
     * @param string $direccion
     * @return Paciente
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
     * Set seguroSocial
     *
     * @param string $seguroSocial
     * @return Paciente
     */
    public function setSeguroSocial($seguroSocial)
    {
        $this->seguroSocial = $seguroSocial;

        return $this;
    }

    /**
     * Get seguroSocial
     *
     * @return string 
     */
    public function getSeguroSocial()
    {
        return $this->seguroSocial;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Paciente
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
     * Set medicoPreferido
     *
     * @param string $medicoPreferido
     * @return Paciente
     */
    public function setMedicoPreferido($medicoPreferido)
    {
        $this->medicoPreferido = $medicoPreferido;

        return $this;
    }

    /**
     * Get medicoPreferido
     *
     * @return string 
     */
    public function getMedicoPreferido()
    {
        return $this->medicoPreferido;
    }

    /**
    * Costructor
    */
    public function __construct()
    {
        $this->numerosPaciente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactosEmergencia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->citas = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * __toString
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getNombre() . " " . $this->getApellido();
    }

    

    public function setNumerosPaciente($numerosPaciente)
    {
        $this->numerosPaciente = $numerosPaciente;

        foreach ($numerosPaciente as $numeroPaciente) {
            $numeroPaciente->setPaciente($this);
        }
    }


    public function setContactosEmergencia($contactosEmergencia)
    {
        $this->contactosEmergencia = $contactosEmergencia;

        foreach ($contactosEmergencia as $contactoEmergencia) {
            $contactoEmergencia->setPaciente($this);
        }
    }

    public function setCitas($citas)
    {
        $this->citas = $citas;

        foreach ($citas as $cita) {
            $cita->setPaciente($this);
        }
    }

    /**
     * Add numerosPaciente
     *
     * @param \proyBundle\Entity\NumerosPaciente $numeroPaciente
     * @return Paciente
     */
    public function addNumerosPaciente(\proyBundle\Entity\NumerosPaciente $numeroPaciente)
    {
        $numeroPaciente->setPaciente($this);
        $this->numerosPaciente-> add ($numeroPaciente);

        return $this;
    }

    /**
     * Remove numerosPaciente
     *
     * @param \proyBundle\Entity\NumerosPaciente $numerosPaciente
     */
    public function removeNumerosPaciente(\proyBundle\Entity\NumerosPaciente $numeroPaciente)
    {
        $this->numerosPaciente->removeElement($numeroPaciente);
    }

    /**
     * Get numerosPaciente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNumerosPaciente()
    {
        return $this->numerosPaciente;
    }

    /**
     * Add contactosEmergencia
     *
     * @param \proyBundle\Entity\ContactoEmergencia $contactoEmergencia
     * @return Paciente
     */
    public function addContactosEmergencium(\proyBundle\Entity\ContactoEmergencia $contactoEmergencia)
    {
        $contactoEmergencia->setPaciente($this);
        $this->contactosEmergencia->add($contactoEmergencia);

        return $this;
    }

    /**
     * Remove contactosEmergencia
     *
     * @param \proyBundle\Entity\ContactoEmergencia $contactosEmergencia
     */
    public function removeContactosEmergencium(\proyBundle\Entity\ContactoEmergencia $contactosEmergencia)
    {
        $this->contactosEmergencia->removeElement($contactosEmergencia);
    }

    /**
     * Get contactosEmergencia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactosEmergencia()
    {
        return $this->contactosEmergencia;
    }

    /**
     * Add citas
     *
     * @param \proyBundle\Entity\Citas $citas
     * @return Paciente
     */
    public function addCita(\proyBundle\Entity\Citas $citas)
    {
        $this->citas[] = $citas;

        return $this;
    }

    /**
     * Remove citas
     *
     * @param \proyBundle\Entity\Citas $citas
     */
    public function removeCita(\proyBundle\Entity\Citas $citas)
    {
        $this->citas->removeElement($citas);
    }

    /**
     * Get citas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCitas()
    {
        return $this->citas;
    }

    /**
     * Set historia_clinica
     *
     * @param \proyBundle\Entity\HistoriaClinica $historiaClinica
     * @return Paciente
     */
    public function setHistoriaClinica(\proyBundle\Entity\HistoriaClinica $historiaClinica = null)
    {
        $this->historia_clinica = $historiaClinica;

        return $this;
    }

    /**
     * Get historia_clinica
     *
     * @return \proyBundle\Entity\HistoriaClinica 
     */
    public function getHistoriaClinica()
    {
        return $this->historia_clinica;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     * @return Paciente
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string 
     */
    public function getCedula()
    {
        return $this->cedula;
    }
}
