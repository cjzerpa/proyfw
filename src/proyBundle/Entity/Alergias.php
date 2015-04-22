<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alergias
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\AlergiasRepository")
 */
class Alergias
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
     * @ORM\Column(name="alergia", type="string", length=255)
     */
    private $alergia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="HistoriaClinica", inversedBy="alergias")
     * @ORM\JoinColumn(name="HistoriaClinica_id", referencedColumnName="id")
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
     * Set alergia
     *
     * @param string $alergia
     * @return Alergias
     */
    public function setAlergia($alergia)
    {
        $this->alergia = $alergia;

        return $this;
    }

    /**
     * Get alergia
     *
     * @return string 
     */
    public function getAlergia()
    {
        return $this->alergia;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Alergias
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
     * Set historiaClinica
     *
     * @param \proyBundle\Entity\HistoriaClinica $historiaClinica
     * @return Alergias
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

    /**
     * __toString
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getAlergia . " " . $this->getDescripcion;
    }
}
