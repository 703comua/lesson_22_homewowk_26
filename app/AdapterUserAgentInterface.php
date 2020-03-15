<?php


namespace App;


interface AdapterUserAgentInterface
{
    public function parse(string $http_user_agent);
    public function getBrowser();
    public function getEngine();
    public function getOs();
    public function getDevice();
}
