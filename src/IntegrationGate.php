<?php

namespace Tohmua\IntegrationGate;

interface IntegrationGate
{
    /**
     * Takes an array of data and processes it as required
     * @param  array|null $data 
     * @return bool
     */
    public function postData(array $data = null);


    /**
     * Returns json form template
     * {
     *     "<field_name>": {
     *         "<name>": "",
     *         "<id>": "",
     *         "<type>": "",
     *         "<options>": "",
     *     }
     * }
     * @return string JSON
     */
    public function getJson();
}