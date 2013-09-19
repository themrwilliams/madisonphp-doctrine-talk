<?php

namespace Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="meetup")
 */
class Meetup
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;

    /**
     * @Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @Column(type="datetime", name="date_created")
     */
    protected $dateCreated;

    /**
     * @ManyToOne(targetEntity="Member")
     * @JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @ManyToMany(targetEntity="Member", mappedBy="meetups", cascade={"all"})
     */
    protected $members;

    /**
     * @OneToMany(targetEntity="event", mappedBy="meetup")
     */
    protected $events;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
        $this->members     = new ArrayCollection();
        $this->events      = new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner(Member $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return \Entity\Member
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param ArrayCollection $members
     */
    public function setMembers(ArrayCollection $members)
    {
        $this->members = $members;
    }

    /**
     * @return ArrayCollection
     */
    public function getMembers()
    {
        return $this->members;
    }
}