<?php

namespace acanales\equipoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Para que funcione la subida de archivos
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Equipo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Equipo
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
     * @ORM\Column(name="Nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Division", type="string", length=100)
     */
    private $division;

    /**
     * @var integer
     *
     * @ORM\Column(name="PJ", type="integer")
     */
    private $pJ;

    /**
     * @var integer
     *
     * @ORM\Column(name="PG", type="integer")
     */
    private $pG;

    /**
     * @var integer
     *
     * @ORM\Column(name="PE", type="integer")
     */
    private $pE;

    /**
     * @var integer
     *
     * @ORM\Column(name="PP", type="integer")
     */
    private $pP;

    /**
     * @var integer
     *
     * @ORM\Column(name="PTS", type="integer")
     */
    private $pTS;
	
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
	


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
     * @return Equipo
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
     * Set division
     *
     * @param string $division
     * @return Equipo
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return string 
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set pJ
     *
     * @param integer $pJ
     * @return Equipo
     */
    public function setPJ($pJ)
    {
        $this->pJ = $pJ;

        return $this;
    }

    /**
     * Get pJ
     *
     * @return integer 
     */
    public function getPJ()
    {
        return $this->pJ;
    }

    /**
     * Set pG
     *
     * @param integer $pG
     * @return Equipo
     */
    public function setPG($pG)
    {
        $this->pG = $pG;

        return $this;
    }

    /**
     * Get pG
     *
     * @return integer 
     */
    public function getPG()
    {
        return $this->pG;
    }

    /**
     * Set pE
     *
     * @param integer $pE
     * @return Equipo
     */
    public function setPE($pE)
    {
        $this->pE = $pE;

        return $this;
    }

    /**
     * Get pE
     *
     * @return integer 
     */
    public function getPE()
    {
        return $this->pE;
    }

    /**
     * Set pP
     *
     * @param integer $pP
     * @return Equipo
     */
    public function setPP($pP)
    {
        $this->pP = $pP;

        return $this;
    }

    /**
     * Get pP
     *
     * @return integer 
     */
    public function getPP()
    {
        return $this->pP;
    }

    /**
     * Set pTS
     *
     * @param integer $pTS
     * @return Equipo
     */
    public function setPTS($pTS)
    {
        $this->pTS = $pTS;

        return $this;
    }

    /**
     * Get pTS
     *
     * @return integer 
     */
    public function getPTS()
    {
        return $this->pTS;
    }
	
	/*PATH*/
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben
        // guardar los archivos cargados
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // se deshace del __DIR__ para no meter la pata
        // al mostrar el documento/imagen cargada en la vista.
        return 'uploads/images/equipo';
    }	
	
	/*** FILE ***/
	
	/**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
	
	/*Subir archivo*/
	
	public function upload()
	{
		// the file property can be empty if the field is not required
		if (null === $this->getFile()) {
			return;
		}
	
		// aquí usa el nombre de archivo original pero lo debes
		// sanear al menos para evitar cualquier problema de seguridad
	
		// move takes the target directory and then the
		// target filename to move to
		$this->getFile()->move(
			$this->getUploadRootDir(),
			$this->getFile()->getClientOriginalName()
		);
	
		// set the path property to the filename where you've saved the file
		$this->path = $this->getFile()->getClientOriginalName();
	
		// limpia la propiedad «file» ya que no la necesitas más
		$this->file = null;
	}
	
	
}
