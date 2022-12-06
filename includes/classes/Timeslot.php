<?php namespace RS;

class Timeslot
{
    private int $day;
    private int $month;
    private int $year;
    private int $hour;
    private int $minute;
    private int $beginTime;
    private int $length;

    /**
     * Creates Timeslot.
     *
     * @param int $day
     * @param int $month
     * @param int $year
     * @param int $hour
     * @param int $minute
     * @param int $beginTime
     * @param int $length
     */
    public function __construct(int $day, int $month, int $year, int $hour, int $minute, int $beginTime, int $length) {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->hour = $hour;
        $this->minute = $minute;
        $this->beginTime = $beginTime;
        $this->length = $length;
    }

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