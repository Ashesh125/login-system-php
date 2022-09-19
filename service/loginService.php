<?php
require_once("../modal/Client.php");


class LoginService
{
    public function checkLogin($data)
    {
        $client = new Client();
        $client->setEmail($data['email']);
        $client->setPassword($data['password']);

        if ($client->isClient()) {
            $client->setLogin("client");
            return array("id" => $client->getId(), "name" => $client->getName());
        } else {
            return array("id" => "0");
        }
    }
}
