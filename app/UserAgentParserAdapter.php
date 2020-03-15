<?php


namespace App;

use UAParser\Parser;

class UserAgentParserAdapter implements AdapterUserAgentInterface
{
    protected  $data;

    public function parse(string $http_user_agent)
    {
        $parser = Parser::create();
        $this->data = $parser->parse($http_user_agent);
    }

    public function getBrowser()
    {
        return $this->data->ua->toString();
    }
    public function getEngine()
    {
        return 'Blink';
    }
    public function getOs()
    {
        return $this->data->os->toString();
    }
    public function getDevice()
    {
        return $this->data->device->toString();
    }
}
