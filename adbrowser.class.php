<?php

class Adbrowser {
    
    public $_accessToken = "";  //API key
    public $_systemLogin = "";  //Adbrowser user login / domain name
    
    
    /**
     * Returns generated request key
     * @param array $params
     * @return string
     */
    private function generateRequestKey($params) {
     $requestString = $this->_accessToken;
        foreach ($params as $value) {
                $requestString .= $value;
        }
       return md5($requestString);
    }
    
    /**
     * Returns API call domain
     * @return string
     */
    private function getApiDomain() {
        return "http://api.".$this->_systemLogin.".adbrowser.net";
    }
    
    /**
     * Performs API call and returns response array
     * @param string $functionCall
     * @param array $params
     * @param string $method
     * @return array
     */
    public function getQuery($functionCall = "", $params = array(), $method = "get"){
        switch($method){
            case 'post':
                $response = $this->getCurlCall($functionCall, $params);
            break;
            default:
                $response = $this->getQueryCall($functionCall, $params);
            break;
        }
        return $response;
    }
    
    
    /**
     * Performs GET call and returns response array
     * @param string $functionCall
     * @param array $params
     * @return array
     */
    private function getQueryCall($functionCall, $params){
        $prepareKeys = array("?key=".$this->generateRequestKey($params));
        foreach ($params as $key => $value) {
           $prepareKeys[] =  $key."=".urlencode($value);
        }
        $prepareKeysString = $this->getApiDomain()."/".$functionCall."/".implode("&", $prepareKeys);
        $performCall = file_get_contents($prepareKeysString);

        return json_decode($performCall, true);
    }
    
    /**
     * Performs POST call and returns response array
     * @param string $functionCall
     * @param array $params
     * @return array
     */
    private function getCurlCall($functionCall, $params){
        $prepareCallUrl = $this->getApiDomain()."/".$functionCall."/";
        $params['key'] = $this->generateRequestKey($params);
        $request = curl_init($prepareCallUrl);
        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt($request, CURLOPT_SAFE_UPLOAD, true);
        curl_setopt(
            $request, CURLOPT_POSTFIELDS, $params);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($request);

        curl_close($request);
        
        return json_decode($response, true);
    }

}

?>
