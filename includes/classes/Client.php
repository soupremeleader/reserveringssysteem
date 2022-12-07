<?php namespace RS;

class Client
{

    public string $name;
    public int $phoneNumber;
    public string $email;

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
