<?php

namespace EntitasBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @var string
     *
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    private $githubID;

    /**
     * @var string
     *
     * @ORM\Column(name="namauser", type="string", length=255, nullable=true)
     */
    private $namauser;

    public function __construct()
    {
        parent::__construct();

    }

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
     * Set githubID
     *
     * @param string $githubID
     * @return User
     */
    public function setGithubID($githubID)
    {
        $this->githubID = $githubID;

        return $this;
    }

    /**
     * Get githubID
     *
     * @return string 
     */
    public function getGithubID()
    {
        return $this->githubID;
    }

    /**
     * Set namauser
     *
     * @param string $namauser
     * @return User
     */
    public function setNamauser($namauser)
    {
        $this->namauser = $namauser;

        return $this;
    }

    /**
     * Get namauser
     *
     * @return string 
     */
    public function getNamauser()
    {
        return $this->namauser;
    }


}
