<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PublicacionRepository")
 * @Vich\Uploadable
 */
class Publicacion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titulo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Arquitecto;

    /**
     * @ORM\Column(type="text")
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Imagen;

    /**
     * @Vich\UploadableField(mapping="imagenes_obra", fileNameProperty="Imagen")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Imagen", mappedBy="publicacion", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $imagenes;

    public function __construct()
    {
        $this->imagenes = new ArrayCollection();
    }


    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->Titulo;
    }

    public function setTitulo(string $Titulo): self
    {
        $this->Titulo = $Titulo;

        return $this;
    }

    public function getArquitecto(): ?string
    {
        return $this->Arquitecto;
    }

    public function setArquitecto(string $Arquitecto): self
    {
        $this->Arquitecto = $Arquitecto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->Imagen;
    }

    public function setImagen($Imagen): self
    {
        $this->Imagen = $Imagen;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Imagen[]
     */
    public function getImagenes(): Collection
    {
        return $this->imagenes;
    }

    public function addImagene(Imagen $imagene): self
    {
        if (!$this->imagenes->contains($imagene)) {
            $this->imagenes[] = $imagene;
            $imagene->setPublicacion($this);
        }

        return $this;
    }

    public function removeImagene(Imagen $imagene): self
    {
        if ($this->imagenes->contains($imagene)) {
            $this->imagenes->removeElement($imagene);
            // set the owning side to null (unless already changed)
            if ($imagene->getPublicacion() === $this) {
                $imagene->setPublicacion(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Titulo;
    }
}
