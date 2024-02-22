<?php

class HttpUtilClient
{
    private $headers;
    private $url;

    public function __construct($url, $headers)
    {
        $this->headers = $headers;
        $this->url = $url;
    }

    public function getToken()
    {
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp, true);
    }

    public function getMaskedNumber()
    {
        try {
            $curl = curl_init($this->url);
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            if ($this->headers != null && sizeof($this->headers) > 0) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
            }

            $resp = curl_exec($curl);
            curl_close($curl);
            return json_decode($resp, true);
        } catch (Exception $exception) {
            echo "Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString();
            return null;
        }
    }
}


