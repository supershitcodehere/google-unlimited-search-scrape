<?php
namespace koulab\google;

use GuzzleHttp\Client;

class GoogleCustomSearchEngine{

    private $client;
    private $params;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    public function __construct(Client $client = null)
    {
        if($client == null){
            $this->setClient(new Client(
                [
                    'connect_timeout'=>10,
                    'timeout'=>10,
                    'http_errors'=>false,
                    'verify'=>false,
                    'cookies' => true,
                    'allow_redirects'=>true,
                    'headers' => [
                        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                        'Accept-Encoding'=>'gzip, deflate, sdch',
                        'Accept-Language' => 'ja,en-US;q=0.8,en;q=0.6',
                        'Cache-Control'=>'max-age=0',
                        'Connection'=>'close',
                        'User-Agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.79 Safari/537.36',
                    ],
                ]
            ));
        }
    }

    public function setParams(GoogleCustomSearchEngineRequestParams $params){
        $this->params = $params;

    }


    /**
     * @return mixed
     */
    public function getParams() : GoogleCustomSearchEngineRequestParams
    {
        return $this->params;
    }

    public static function parseJson($contents){
        preg_match('/google\.search\.cse\.api\((.*?)\);/mis',$contents,$m);
        if(empty($m[1])){
            throw new GoogleCustomSearchEngineException("Failed to parse json");
        }
        return $m[1];
    }

    public function getToken(){
        $contents = $this->getClient()->request('GET','https://cse.google.com/cse.js',[
            'query'=>[
                'cx'=>$this->getParams()->getCx(),
            ]
        ])->getBody()->getContents();
        preg_match("/cse_token\":.*?\"(.*?)\"/mi",$contents, $m);
        if(empty($m[1])){
            throw new GoogleCustomSearchEngineException("Failed to get cse_token,please check your cx key");
        }
        return $m[1];
    }

    public function get(){
        return $this->getClient()->request('GET','https://cse.google.com/cse/element/v1',[
            'query'=>$this->getParams()->build()
        ])->getBody()->getContents();
    }
}