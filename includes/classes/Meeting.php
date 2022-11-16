<?php

class Meeting
{
    private Client $client;
    private Timeslot $timeslot;
    private string $extraNote;
    /**
     * Creates new Meeting
     *
     * @param Client $client
     * @param Timeslot $timeslot
     * @param string $extraNote
     */
    public function __construct(Client $client, Timeslot $timeslot, string $extraNote) {
        $this->client = $client;
        $this->timeslot = $timeslot;
        $this->extraNote = $extraNote;
    }

    /**
     *  Finds meeting in database based on timeslot.
     *
     * @param Timeslot $timeslot
     * @return Meeting|null
     */
    public function readMeeting(Timeslot $timeslot) : ?Meeting {
        return null;
    }

    /**
     * Updates meeting from old timeslot to new timeslot
     *
     * @param Timeslot $oldTimeslot
     * @param Client $client
     * @param Timeslot $newTimeslot
     * @return void
     */
    public function updateMeeting(Timeslot $oldTimeslot, Client $client, Timeslot $newTimeslot) : void {

    }

    /**
     * Deletes meeting.
     *
     * @param Timeslot $timeslot
     * @return void
     */
    public function deleteMeeting(Timeslot $timeslot) : void {

    }
}