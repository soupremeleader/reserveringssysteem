<?php

class Client
{
    private string $name;
    private int $phoneNumber;
    private string $email;
    private array $meetings;

    /**
     * Creates client.
     *
     * @param string $name
     * @param int $phoneNumber
     * @param string $email
     */
    public function __construct(string $name, int $phoneNumber, string $email) {
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->meetings = [];
    }

    /**
     * Finds client in the database.
     *
     * @param string $name
     * @return Client|null
     */
    public function readClient(string $name): ?Client {
        return null;
    }

    /**
     * Updates client.
     *
     * @param string $name
     * @param int $phoneNumber
     * @param string $email
     * @return void
     */
    public function updateClient(string $name, int $phoneNumber, string $email): void {

    }

    /**
     * Finds client in database using name and deletes it.
     * @param string $name
     * @return void
     */
    public function deleteClient(string $name): void {

    }
}
