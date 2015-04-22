<?php

namespace proyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NumerosPaciente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="proyBundle\Entity\NumerosPacienteRepository")
 */
class NumerosPaciente
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
     * @ORM\Column(name="tipo", type="string", length=12)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=12)
     */
    private $numero;

        /**
     * @ORM\ManyToOne(targetEntity="Paciente", inversedBy="numerosPaciente")
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
     * Set tipo
     *
     * @param string $tipo
     * @return NumerosPaciente
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return NumerosPaciente
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
     * Set paciente
     *
     * @param \proyBundle\Entity\Paciente $paciente
     * @return NumerosPaciente
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

    /**
     * __toString
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getPaciente().__toString()." ". $this->getTipo(). " ".$this->getNumero();
    }
}
