<?php 

require_once 'config.php';


class Database extends Config{


 public  function read(){
        $sql= 'SELECT * FROM guitars';
        $sth= $this->conn->prepare($sql);
        $sth->execute();
        $result= $sth->fetchAll();
        return $result;
    }

 public  function cartRead(){
        $sql= 'SELECT * FROM cart';
        $sth= $this->conn->prepare($sql);
        $sth->execute();
        $result= $sth->fetchAll();
        if($result){
         return $result;
        }else{
            return false;
        }
    }



// ADD TO CART FUNCTION 
public function addToCart($gname,$gprice,$gimg,$quantity,$total,$gcode){
   
        $sql='INSERT INTO cart(g_name,g_price,g_image,quantity,total_price,g_code)';
        $sql.='VALUES(:gname,:gprice,:gimage,:quantity,:total,:gcode)';
        $sth=$this->conn->prepare($sql);
        $sth->bindValue(":gname",$gname);
        $sth->bindValue(":gprice",$gprice);
        $sth->bindValue(":gimage",$gimg);
        $sth->bindValue(":quantity",$quantity);
        $sth->bindValue(":total",$total);
        $sth->bindValue(":gcode",$gcode);
        $result=$sth->execute();
       
        if($result){
            return true;
        }else{
            return false;
        }
}
// FUNCTION CHECK USER EXIST
public function CheckProductExist($gcode){
    $sql="SELECT id FROM cart WHERE g_code=:g_code";
    $sth=$this->conn->prepare($sql);
    $sth->bindValue(":g_code",$gcode);
    $sth->execute();
    $Result= $sth->rowcount();

    if($Result>=1){
      return true;
    }
    else{
      return false;
    }
  }

 
  public function IncreasValue($gcode){
    $sql= "UPDATE cart SET quantity=quantity+1 WHERE g_code=:g_code";
    $sth=$this->conn->prepare($sql);
    $sth->bindValue(":g_code",$gcode);
    $Result=$sth->execute();
    if($Result>=1){
      return true;
    }
    else{
      return false;
    }
  }
  


public function getguitar($id){
    $sql='SELECT * FROM guitars WHERE id=:id';
    $sth=$this->conn->prepare($sql);
    $sth->execute([
        ':id'=>$id
    ]);
    $result=$sth->fetch();
    return $result;
}


}
?>