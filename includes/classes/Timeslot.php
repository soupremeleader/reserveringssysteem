<?php namespace RS;

class Timeslot
{
    public int $id;
    public int $beginTime;
    public int $endTime;



    /**
     * Finds timeslot in database.
     *
     * @return Timeslot|null
     */
    public function readTimeslot(): ?Timeslot {
        return null;
    }

    /**
     * Updates old timeslot to new timeslot.
     *
     * @param Timeslot $oldTimeslot
     * @param int $day
     * @param int $month
     * @param int $year
     * @param int $hour
     * @param int $minute
     * @param int $beginTime
     * @param int $length
     * @return void
     */
    public function updateTimeslot(Timeslot $oldTimeslot, int $day, int $month, int $year, int $hour, int $minute, int $beginTime, int $length): void {

    }

    /**
     * Delete old timeslot.
     *
     * @param Timeslot $timeslot
     * @return void
     */
    public function deleteTimeslot(Timeslot $timeslot): void {

    }


}