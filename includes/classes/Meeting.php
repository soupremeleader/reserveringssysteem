<?php namespace RS;

class Meeting
{
    public int $id;
    public Client $client;
    public Timeslot $timeslot;
    public string $extraNote;

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