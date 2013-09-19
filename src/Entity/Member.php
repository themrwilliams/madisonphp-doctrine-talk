<?php

namespace Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="member")
 */
class Member
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=50)
     */
    protected $name;

    /**
     * @Column(type="datetime", name="created_on")
     */
    protected $createdOn;

    /**
     * @ManyToMany(targetEntity="Meetup", inversedBy="members", cascade={"all"})
     * @JoinTable(name="member_meetups")
     */
    protected $meetups;

    /**
     * @ManyToMany(targetEntity="Event", inversedBy="attendees", cascade={"all"})
     * @JoinTable(name="member_events")
     */
    protected $events;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdOn = new \DateTime();
        $this->meetups   = new ArrayCollection();
        $this->events    = new ArrayCollection();
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
     * @return Meetup
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param ArrayCollection $meetups
     */
    public function setMeetups(ArrayCollection $meetups)
    {
        $this->meetups = $meetups;
    }

    /**
     * @return ArrayCollection
     */
    public function getMeetups()
    {
        return $this->meetups;
    }

    /**
     * @param ArrayCollection $events
     */
    public function setEvents(ArrayCollection $events)
    {
        $this->events = $events;
    }

    /**
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }




}