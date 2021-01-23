<?php 

class Guitar( ){
    public $id;
    public $g_name;
    public $g_price;
    public $code;

    public function __construct($id,$g_name,$g_price,$code){  
            $this->id= $id;
            $this->g_name=$g_name;
            $this->g_price=$g_price;
            $this->code=$code;
    }

    public function getGuitar(){
        
    }
}

