<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
/**
 * Posts
 *
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="kategori", columns={"kategori"}), @ORM\Index(name="penulis", columns={"penulis"})})
 * @ORM\Entity
 */
class Posts
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
     * @ORM\Column(name="judul", type="string", length=255, nullable=false)
     */
    private $judul;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="isi", type="text", nullable=false)
     */
    private $isi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="date", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date", nullable=true)
     */
    private $updateAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean", nullable=false)
     */
    private $visible;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="penulis", referencedColumnName="id")
     * })
     */
    private $penulis;

    /**
     * @var \Kategori
     *
     * @ORM\ManyToOne(targetEntity="Kategori")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kategori", referencedColumnName="id")
     * })
     */
    private $kategori;

    /**
     * @var int
     *
     * @ORM\Column(name="hits", type="integer", nullable=true)
     */
    private $hits;
    

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
     * Set judul
     *
     * @param string $judul
     * @return Posts
     */
    public function setJudul($judul)
    {
        $this->judul = $judul;

        return $this;
    }

    /**
     * Get judul
     *
     * @return string 
     */
    public function getJudul()
    {
        return $this->judul;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Posts
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set isi
     *
     * @param string $isi
     * @return Posts
     */
    public function setIsi($isi)
    {
        $this->isi = $isi;

        return $this;
    }

    /**
     * Get isi
     *
     * @return string 
     */
    public function getIsi()
    {
        return $this->isi;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return Posts
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime 
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Posts
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Posts
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set penulis
     *
     * @param \EntitasBundle\Entity\User $penulis
     * @return Posts
     */
    public function setPenulis(\EntitasBundle\Entity\User $penulis = null)
    {
        $this->penulis = $penulis;

        return $this;
    }

    /**
     * Get penulis
     *
     * @return \EntitasBundle\Entity\User 
     */
    public function getPenulis()
    {
        return $this->penulis;
    }

    /**
     * Set kategori
     *
     * @param \EntitasBundle\Entity\Kategori $kategori
     * @return Posts
     */
    public function setKategori(\EntitasBundle\Entity\Kategori $kategori = null)
    {
        $this->kategori = $kategori;

        return $this;
    }

    /**
     * Get kategori
     *
     * @return \EntitasBundle\Entity\Kategori 
     */
    public function getKategori()
    {
        return $this->kategori;
    }



    /**
     * Set hits
     *
     * @param integer $hits
     * @return Posts
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits
     *
     * @return integer 
     */
    public function getHits()
    {
        return $this->hits;
    }
}
