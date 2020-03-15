<?php


namespace App;


class WhichBrowserAdapter implements AdapterUserAgentInterface
{
    protected  $data;

    public function parse(string $http_user_agent)
    {
        $this->data = new \WhichBrowser\Parser($http_user_agent);
    }

    public function getBrowser()
    {
        return $this->data->browser->toString();
    }
    public function getEngine()
    {
        return $this->data->engine->toString();
    }
    public function getOs()
    {
        return $this->data->os->toString();
    }
    public function getDevice()
    {
        return $this->data->device->type;
    }
}
