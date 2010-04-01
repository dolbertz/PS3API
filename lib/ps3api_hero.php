<?php

require_once 'ps3api_config.php';
require_once 'ps3api_object.php';
require_once 'ps3api_game.php';

class Ps3ApiHero extends Ps3ApiObject {
    public $psnId;
    public $sidekicks;
    public $games;
    
    public function __construct($psnId) {
        $this->psnId = $psnId;
    }
    
    public function fetch() {
        $url = 'http://' . Ps3ApiConfig::$apiEndpoint . '/hero/' . $this->psnId;
        
        $response = self::httpRequest($url);
        $data = @json_decode($response['data'], true);
        
        $this->extractHere($data);
    }
    
    public function getSidekicks() {
        $url = 'http://' . Ps3ApiConfig::$apiEndpoint . '/hero/' . $this->psnId . '/sidekicks/';
        
        $response = self::httpRequest($url);
        $data = @json_decode($response['data'], true);
        
        foreach($data as $psnId) {
            $this->sidekicks[] = new Ps3ApiHero($psnId);
        }
    }
    
    public function getGames() {
        $url = 'http://' . Ps3ApiConfig::$apiEndpoint . '/hero/' . $this->psnId . '/games/';
        
        $response = self::httpRequest($url);
        $data = @json_decode($response['data'], true);
        
        foreach($data as $item) {
            $game = new Ps3ApiGame($item['id']);
            $game->name = $item['name'];
            $game->url = $item['url'];
            $game->img = $item['img'];
            $game->trophies = $item['trophies'];
            
            $this->games[] = $game;
        }
    }
}