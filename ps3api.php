<?php

require_once 'lib/ps3api_config.php';
require_once 'lib/ps3api_object.php';
require_once 'lib/ps3api_hero.php';

final class Ps3Api extends Ps3ApiObject{
 
    protected static $instance;
    protected $Tools;
    
    public static function getInstance()  {
        if(self::$instance === null) {
            self::$instance = new self();
      }
      
      return self::$instance;
    }
    
    public function getHero($psnId) {
        $hero = new Ps3ApiHero($psnId);
        $hero->fetch();
        
        return $hero;
    }
    
    
    private function __construct() {
        if(!function_exists('curl_init')) {
            Ps3ApiConfig::$useCurl = false;
            if(!ini_get('allow_url_fopen')) {
                throw new RuntimeException('allow_url_fopen disabled and curl not available - No possibility to fetch external resources.');
            }
        }
        
        Ps3ApiConfig::$userAgent = sprintf(Ps3ApiConfig::$userAgent, Ps3ApiConfig::$serverUrl);        
    }
    
    private function __clone() {}
}