<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamentos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\MedicamentosRepository")
 */
class Medicamentos
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
     * @ORM\Column(name="medicamento", type="string", length=20)
     */
    private $medicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", length=20)
     */
    private $condicion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaActualizacion", type="date")
     */
    private $fechaActualizacion;

    /**
     * @ORM\ManyToOne(targetEntity="HistoriaClinica", inversedBy="medicamentos")
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
     * Set medicamento
     *
     * @param string $medicamento
     * @return Medicamentos
     */
    public function setMedicamento($medicamento)
    {
        $this->medicamento = $medicamento;

        return $this;
    }

    /**
     * Get medicamento
     *
     * @return string 
     */
    public function getMedicamento()
    {
        return $this->medicamento;
    }

    /**
     * Set condicion
     *
     * @param string $condicion
     * @return Medicamentos
     */
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;

        return $this;
    }

    /**
     * Get condicion
     *
     * @return string 
     */
    public function getCondicion()
    {
        return $this->condicion;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Medicamentos
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
     * Set historiaClinica
     *
     * @param \proyBundle\Entity\HistoriaClinica $historiaClinica
     * @return Medicamentos
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
