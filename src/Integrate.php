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
        $this->package->postData($data);
    }

    public function getHtml()
    {
        $json = $this->package->getJson();
        return $this->format(json_decode($json));
    }

    private function validatePackage($packageName)
    {
        if (class_exists($packageName) && in_array('Tohmua\IntegrationGate\IntegrationGate', class_implements($packageName))) {
            return true;
        }

        return false;
    }

    private function format($data)
    {
        $html = '<form method="POST">';

        foreach ($data as $field) {
            if (isset($field->type)) {
                switch($field->type) {
                    case 'select':
                        $html .= '<select name="' . $field->name . '" id="' . $field->name . '">';
                        foreach($field->options as $option) {
                            $html .= '<option value="' . $option . '">' . $option . '</option>';
                        }
                        $html .= '</select><br />';
                        break;
                }
            }
        }

        if (isset($data->messages) && is_array($data->messages)) {
            foreach ($data->messages as $message) {
                $html .= $message . '<br />';
            }
        } else {
            $html .= '<br /><br /><button type="submit" class="btn btn-md btn-primary" name="Migrate Database">';
        }

        return $html .= '</form>';
    }
}