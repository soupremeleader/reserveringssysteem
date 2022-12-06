<?php namespace RS;

class Agenda
{
    private array $meetings;
    private array $timeslots;

    /**
     * Creates an Agenda.
     *
     * @param Meeting[] $meetings
     * @param Timeslot[] $timeslots
     */
    public function __construct(array $meetings, array $timeslots) {
        $this->meetings = $meetings;
        $this->timeslots = $timeslots;
    }

    /**
     * Returns all meetings during a certain time period.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param string $form
     * @return Meeting[]
     */
    public function readMeetings(int $year, int $month, int $day, string $form): array {
        return $this->meetings;
    }

    /**
     * Returns all available timeslots during a certain time period.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @param string $form
     * @return Timeslot[]
     */
    public function readTimeslots(int $year, int $month, int $day, string $form): array {
        return $this->timeslots;
    }

    /**
     * Finds meeting of client.
     *
     * @param string $name
     * @return Meeting|null
     */
    public function findMeeting(string $name): ?Meeting {
        return null;
    }

    /**
     * Sort meetings based on date.
     *
     * @param array $meetings
     * $return Meeting[]
     */
    public function sortMeetings(array $meetings): array {
        return $meetings;
    }

    /**
     * Sort timeslots based on date.
     * @param array $timeslots
     * @return array
     */
    public function sortTimeslots(array $timeslots): array {
        return $timeslots;
    }
}