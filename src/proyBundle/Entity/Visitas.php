<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Visitas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\VisitasRepository")
 */
class Visitas
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time")
     */
    private $hora;

    /**
     * @var float
     *
     * @ORM\Column(name="altura", type="float")
     */
    private $altura;

    /**
     * @var float
     *
     * @ORM\Column(name="peso", type="float")
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="presion_arterial", type="string", length=10)
     */
    private $presionArterial;

    /**
     * @var string
     *
     * @ORM\Column(name="frecuencia_cardiaca", type="string", length=10)
     */
    private $frecuenciaCardiaca;

    /**
     * @var float
     *
     * @ORM\Column(name="temperatura", type="float")
     */
    private $temperatura;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico", type="string", length=255)
     */
    private $diagnostico;

    /**
     * @var string
     *
     * @ORM\Column(name="medico", type="string", length=100)
     */
    private $medico;

    /**
    *   @ORM\OneToMany(targetEntity="Referencias", mappedBy="visita", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $referencias;

    /**
    *   @ORM\OneToMany(targetEntity="Recetas", mappedBy="visita", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $recetas;


    /**
    *   @ORM\ManyToMany(targetEntity="Empleado", inversedBy="visitas", cascade={"persist"}, orphanRemoval=true)
    *   @ORM\JoinTable(name="visitas_empleados")
    */
    protected $empleados;

    /**
     * @ORM\ManyToOne(targetEntity="HistoriaClinica", inversedBy="visitas")
     * @ORM\JoinColumn(name="historiaClinica_id", referencedColumnName="id")
     */
    protected $historiaClinica;

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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Visitas
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
     * Set hora
     *
     * @param \DateTime $hora
     * @return Visitas
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set altura
     *
     * @param float $altura
     * @return Visitas
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get altura
     *
     * @return float 
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set peso
     *
     * @param float $peso
     * @return Visitas
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return float 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set presionArterial
     *
     * @param string $presionArterial
     * @return Visitas
     */
    public function setPresionArterial($presionArterial)
    {
        $this->presionArterial = $presionArterial;

        return $this;
    }

    /**
     * Get presionArterial
     *
     * @return string 
     */
    public function getPresionArterial()
    {
        return $this->presionArterial;
    }

    /**
     * Set frecuenciaCardiaca
     *
     * @param string $frecuenciaCardiaca
     * @return Visitas
     */
    public function setFrecuenciaCardiaca($frecuenciaCardiaca)
    {
        $this->frecuenciaCardiaca = $frecuenciaCardiaca;

        return $this;
    }

    /**
     * Get frecuenciaCardiaca
     *
     * @return string 
     */
    public function getFrecuenciaCardiaca()
    {
        return $this->frecuenciaCardiaca;
    }

    /**
     * Set temperatura
     *
     * @param float $temperatura
     * @return Visitas
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;

        return $this;
    }

    /**
     * Get temperatura
     *
     * @return float 
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * Set diagnostico
     *
     * @param string $diagnostico
     * @return Visitas
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return string 
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * Set medico
     *
     * @param string $medico
     * @return Visitas
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;

        return $this;
    }

    /**
     * Get medico
     *
     * @return string 
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
    * Costructor
    */
    public function __construct()
    {
        $this->referencias = new ArrayCollection();
        $this->recetas = new ArrayCollection();
        $this->empleados = new ArrayCollection();
    }

    /**
     * __toString
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getHistoriaClinica()->__toString();
    }

    public function setReferencias($referencias)
    {
        $this->referencias = $referencias;

        foreach ($referencias as $referencia) {
            $referencia->setVisita($this);
        }
    }

    public function setRecetas($recetas)
    {
        $this->recetas = $recetas;

        foreach ($recetas as $receta) {
            $receta->setVisita($this);
        }
    }

    public function setEmpleados($empleados)
    {
        $this->empleados = $empleados;

        foreach ($empleados as $empleado) {
            $empleado->setVisita($this);
        }
    }

    /**
     * Add referencias
     *
     * @param \proyBundle\Entity\Referencias $referencia
     * @return Visitas
     */
    public function addReferencia(\proyBundle\Entity\Referencias $referencia)
    {
        $referencia->setVisita($this);
        $this->referencias->add($referencia);

        return $this;
    }

    /**
     * Remove referencias
     *
     * @param \proyBundle\Entity\Referencias $referencias
     */
    public function removeReferencia(\proyBundle\Entity\Referencias $referencias)
    {
        $this->referencias->removeElement($referencias);
    }

    /**
     * Get referencias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReferencias()
    {
        return $this->referencias;
    }

    /**
     * Add recetas
     *
     * @param \proyBundle\Entity\Recetas $receta
     * @return Visitas
     */
    public function addReceta(\proyBundle\Entity\Recetas $receta)
    {
        $receta->setVisita($this);
        $this->recetas-> add($receta);

        return $this;
    }

    /**
     * Remove recetas
     *
     * @param \proyBundle\Entity\Recetas $recetas
     */
    public function removeReceta(\proyBundle\Entity\Recetas $recetas)    
    {

        $this->recetas->removeElement($recetas);
    }

    /**
     * Get recetas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecetas()
    {
        return $this->recetas;
    }

    /**
     * Add empleados
     *
     * @param \proyBundle\Entity\Empleado $empleados
     * @return Visitas
     */
    public function addEmpleado(\proyBundle\Entity\Empleado $empleados)
    {
        $this->empleados[] = $empleados;

        return $this;
    }

    /**
     * Remove empleados
     *
     * @param \proyBundle\Entity\Empleado $empleados
     */
    public function removeEmpleado(\proyBundle\Entity\Empleado $empleados)
    {
        $this->empleados->removeElement($empleados);
    }

    /**
     * Get empleados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpleados()
    {
        return $this->empleados;
    }

    /**
     * Set historiaClinica
     *
     * @param \proyBundle\Entity\HistoriaClinica $historiaClinica
     * @return Visitas
     */
    public function setHistoriaClinica(\proyBundle\Entity\HistoriaClinica $historiaClinica = null)
    {
        $this->historiaClinica = $historiaClinica;

        return $this;
    }

    /**
     * Get historiaClinica
     *
     * @return \proyBundle\Entity\HistoriaClinica 
     */
    public function getHistoriaClinica()
    {
        return $this->historiaClinica;
    }
}
