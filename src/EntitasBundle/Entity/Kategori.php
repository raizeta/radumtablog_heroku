<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kategori
 *
 * @ORM\Table(name="kategori")
 * @ORM\Entity
 */
class Kategori
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nama_kategori", type="string", length=50, nullable=false)
     */
    private $namaKategori;



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
     * Set namaKategori
     *
     * @param string $namaKategori
     * @return Kategori
     */
    public function setNamaKategori($namaKategori)
    {
        $this->namaKategori = $namaKategori;

        return $this;
    }

    /**
     * Get namaKategori
     *
     * @return string 
     */
    public function getNamaKategori()
    {
        return $this->namaKategori;
    }
}
