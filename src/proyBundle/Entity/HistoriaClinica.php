<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriaClinica
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\HistoriaClinicaRepository")
 */
class HistoriaClinica
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
     * @ORM\Column(name="tabaco", type="string", length=50)
     */
    private $tabaco;

    /**
     * @var string
     *
     * @ORM\Column(name="alcohol", type="string", length=50)
     */
    private $alcohol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaActualizacion", type="date")
     */
    private $fechaActualizacion;

    /**
    *   @ORM\OneToMany(targetEntity="Medicamentos", mappedBy="historiaClinica", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $medicamentos;


    /**
    *   @ORM\OneToMany(targetEntity="Alergias", mappedBy="historiaClinica", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $alergias;


    /**
    *   @ORM\OneToMany(targetEntity="Visitas", mappedBy="historiaClinica", cascade={"persist"}, orphanRemoval=true)
    *
    */
    protected $visitas;

    /**
     * @ORM\OneToOne(targetEntity="Paciente", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     **/
    private $paciente;

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
     * Set tabaco
     *
     * @param string $tabaco
     * @return HistoriaClinica
     */
    public function setTabaco($tabaco)
    {
        $this->tabaco = $tabaco;

        return $this;
    }

    /**
     * Get tabaco
     *
     * @return string 
     */
    public function getTabaco()
    {
        return $this->tabaco;
    }

    /**
     * Set alcohol
     *
     * @param string $alcohol
     * @return HistoriaClinica
     */
    public function setAlcohol($alcohol)
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    /**
     * Get alcohol
     *
     * @return string 
     */
    public function getAlcohol()
    {
        return $this->alcohol;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return HistoriaClinica
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * __toString
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->paciente->__toString();
    }

    public function setMedicamentos($medicamentos)
    {
        $this->medicamentos = $medicamentos;

        foreach ($medicamentos as $medicamento) {
            $medicamento->setHistoriaClinica($this);
        }
    }

        public function setAlergias($alergias)
    {
        $this->alergias = $alergias;

        foreach ($alergias as $alergia) {
            $alergia->setHistoriaClinica($this);
        }
    }

    public function setVisitas($visitas)
    {
        $this->visitas = $visitas;

        foreach ($visitas as $visita) {
            $visita->setHistoriaClinica($this);
        }
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medicamentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->alergias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visitas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medicamentos
     *
     * @param \proyBundle\Entity\Medicamentos $medicamento
     * @return HistoriaClinica
     */
    public function addMedicamentos(\proyBundle\Entity\Medicamentos $medicamento)
    {
        $medicamento->setHistoriaClinica($this);
        $this->medicamentos->add($medicamento);

        return $this;
    }

    /**
     * Remove medicamentos
     *
     * @param \proyBundle\Entity\Medicamentos $medicamentos
     */
    public function removeMedicamentos(\proyBundle\Entity\Medicamentos $medicamentos)
    {
        $this->medicamentos->removeElement($medicamentos);
    }

    /**
     * Get medicamentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicamentos()
    {
        return $this->medicamentos;
    }

    /**
     * Add alergias
     *
     * @param \proyBundle\Entity\Alergias $alergia
     * @return HistoriaClinica
     */
    public function addAlergia(\proyBundle\Entity\Alergias $alergia)
    {
        $alergia->setHistoriaClinica($this);
        $this->alergias->add($alergia);

        return $this;
    }

    /**
     * Remove alergias
     *
     * @param \proyBundle\Entity\Alergias $alergias
     */
    public function removeAlergia(\proyBundle\Entity\Alergias $alergias)
    {
        $this->alergias->removeElement($alergias);
    }

    /**
     * Get alergias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlergias()
    {
        return $this->alergias;
    }

    /**
     * Add visitas
     *
     * @param \proyBundle\Entity\Visitas $visitas
     * @return HistoriaClinica
     */
    public function addVisita(\proyBundle\Entity\Visitas $visitas)
    {
        $this->visitas[] = $visitas;

        return $this;
    }

    /**
     * Remove visitas
     *
     * @param \proyBundle\Entity\Visitas $visitas
     */
    public function removeVisita(\proyBundle\Entity\Visitas $visitas)
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
     * Set paciente
     *
     * @param \proyBundle\Entity\Paciente $paciente
     * @return HistoriaClinica
     */
    public function setPaciente(\proyBundle\Entity\Paciente $paciente)
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
}
