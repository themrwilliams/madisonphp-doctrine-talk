<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="event")
 */
class Event
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=50)
     */
    protected $title;

    /**
     * @Column(name="`when`", type="datetime")
     */
    protected $when;

    /**
     * @Column(name="`where`", type="string")
     */
    protected $where;

    /**
     * @ManyToOne(targetEntity="Meetup", inversedBy="events")
     * @JoinColumn(name="meetup_id", referencedColumnName="id")
     */
    protected $meetup;

    /**
     * @ManyToMany(targetEntity="Member", mappedBy="events", cascade={"persist"})
     */
    protected $attendees;

    /**
     * @ManyToOne(targetEntity="Member")
     * @JoinColumn(name="speaker_id", referencedColumnName="id")
     */
    protected $speaker;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return Meetup
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $meetup
     */
    public function setMeetup($meetup)
    {
        $this->meetup = $meetup;
    }

    /**
     * @return mixed
     */
    public function getMeetup()
    {
        return $this->meetup;
    }

    /**
     * @param $attendees
     */
    public function setAttendees($attendees)
    {
        $this->attendees = $attendees;
    }

    /**
     * @return ArrayCollection
     */
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * @param \DateTime $when
     */
    public function setWhen(\DateTime $when)
    {
        $this->when = $when;
    }

    /**
     * @return \DateTime
     */
    public function getWhen()
    {
        return $this->when;
    }

    /**
     * @param $where
     */
    public function setWhere($where)
    {
        $this->where = $where;
    }

    /**
     * @return mixed
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param Member $speaker
     */
    public function setSpeaker(Member $speaker)
    {
        $this->speaker = $speaker;
    }

    /**
     * @return mixed
     */
    public function getSpeaker()
    {
        return $this->speaker;
    }
}