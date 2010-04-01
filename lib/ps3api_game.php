<?php

require_once 'ps3api_config.php';
require_once 'ps3api_object.php';

class Ps3ApiGame extends Ps3ApiObject {
    public $id;
    public $name;
    public $url;
    public $img;
    public $trophies;
    
    public function __construct($id) {
        $this->id = $id;
    }
    
    public function fetch() {
        $url = 'http://' . Ps3ApiConfig::$apiEndpoint . '/game/' . $this->id;
        
        $response = self::httpRequest($url);
        $data = @json_decode($response['data'], true);
        
        $this->extractHere($data);
    }
}