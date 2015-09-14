<?php

namespace EntitasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Komentar
 *
 * @ORM\Table(name="komentar", indexes={@ORM\Index(name="pengkomen", columns={"pengkomen"}), @ORM\Index(name="postingan", columns={"postingan"})})
 * @ORM\Entity
 */
class Komentar
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
     * @var integer
     *
     * @ORM\Column(name="isikomen", type="text",nullable=false)
     */
    private $isikomen;

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
     * @var \Posts
     *
     * @ORM\ManyToOne(targetEntity="Posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="postingan", referencedColumnName="id")
     * })
     */
    private $postingan;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pengkomen", referencedColumnName="id")
     * })
     */
    private $pengkomen;


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
     * Set isikomen
     *
     * @param string $isikomen
     * @return Komentar
     */
    public function setIsikomen($isikomen)
    {
        $this->isikomen = $isikomen;

        return $this;
    }

    /**
     * Get isikomen
     *
     * @return string 
     */
    public function getIsikomen()
    {
        return $this->isikomen;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return Komentar
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
     * @return Komentar
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
     * Set postingan
     *
     * @param \EntitasBundle\Entity\Posts $postingan
     * @return Komentar
     */
    public function setPostingan(\EntitasBundle\Entity\Posts $postingan = null)
    {
        $this->postingan = $postingan;

        return $this;
    }

    /**
     * Get postingan
     *
     * @return \EntitasBundle\Entity\Posts 
     */
    public function getPostingan()
    {
        return $this->postingan;
    }

    /**
     * Set pengkomen
     *
     * @param \EntitasBundle\Entity\User $pengkomen
     * @return Komentar
     */
    public function setPengkomen(\EntitasBundle\Entity\User $pengkomen = null)
    {
        $this->pengkomen = $pengkomen;

        return $this;
    }

    /**
     * Get pengkomen
     *
     * @return \EntitasBundle\Entity\User 
     */
    public function getPengkomen()
    {
        return $this->pengkomen;
    }
}
