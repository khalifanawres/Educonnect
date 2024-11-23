<?php

class Participation
{
    private $id;
    private $user_id;
    private $competition_id;
    private $date_participation;

    // Constructor
    public function __construct($user_id, $competition_id, $date_participation = null)
    {
        $this->user_id = $user_id;
        $this->competition_id = $competition_id;
        $this->date_participation = $date_participation ? $date_participation : date("Y-m-d H:i:s"); // Default to current timestamp
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getCompetitionId()
    {
        return $this->competition_id;
    }

    public function getDateParticipation()
    {
        return $this->date_participation;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setCompetitionId($competition_id)
    {
        $this->competition_id = $competition_id;
    }

    public function setDateParticipation($date_participation)
    {
        $this->date_participation = $date_participation;
    }
}
