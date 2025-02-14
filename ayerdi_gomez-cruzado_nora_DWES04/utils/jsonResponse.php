<?php 

class JsonResponse{
    private array $response = [
        'status' => '',
        'code' => '',
        'message' => '',
        'data' => ''
    ];

    public function __construct($status, $code, $message, $data){
        $this -> response['status'] = $status;
        $this -> response['code'] = $code;
        $this -> response['message'] = $message;
        $this -> response['data'] = $data;
    }

    // get y set de status
    public function getStatus(){
        return $this -> response['status'];
    }
    public function setStatus($status){
        $this -> response['status'] = $status;
    }
    // get y set de code
    public function getCode(){
        return $this -> response['code'];
    }
    public function setCode($code){
        $this -> response['status'] = $code;
    }
    // get y set de message
    public function getMessage(){
        return $this -> response['message'];
    }
    public function setMessage($message){
        $this -> response['status'] = $message;
    }
    // get y set de data
    public function getData(){
        return $this -> response['data'];
    }
    public function setData($data){
        $this -> response['status'] = $data;
    }

    //get y set de response
    public function getResponse(){
        return $this -> response;
    }
    public function setResponse($response){
        $this -> response = $response;
    }


    public function toJSON() {
        return json_encode($this -> response);
    }
    
    function sendJsonResponse(){
        header('Content-Type: application/json');
        http_response_code($this->response['code']);
        echo $this->toJson();
    exit;
    }

}

?>