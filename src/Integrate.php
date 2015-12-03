<?php

namespace Tohmua\IntegrationGate;

class Integrate
{
    private $package;

    public function __construct($packageName)
    {
        if (!$this->validatePackage($packageName)) {
            throw new \Exception(
                sprintf(
                    'Package  %s does not exsist or does not implement the correct interface!',
                    json_encode($packageName)
                )
            );
        }

        $this->package = new $packageName();
    }

    public function sendData(array $data = NULL)
    {
        // calls $this->package->postData($data);
    }

    public function getHtml()
    {
        // calls $this->package->getJson();
        // formats JSON as HTML
        // returns HTML
        $json = $this->package->getJson();
        return $json;
    }

    private function validatePackage($packageName)
    {
        if (class_exists($packageName) && in_array('Tohmua\IntegrationGate\IntegrationGate', class_implements($packageName))) {
            return true;
        }

        return false;
    }
}