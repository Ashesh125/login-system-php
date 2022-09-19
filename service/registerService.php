<?php
require_once("../modal/Client.php");


class RegisterService
{
    public function registerNewUser($data)
    {
        $client = new Client();
        $client->setEmail($data['email']);
        $client->setPassword($data['password']);

        return $client->insert();
    }

    public function checkUserExists($data)
    {
        $client = new Client();
        $client->setEmail($data['email']);

        return $client->checkExists();
    }
}
