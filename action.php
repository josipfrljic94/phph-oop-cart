<?php 

require_once 'db.php';
require_once 'util.php';
$db=new Database;
$util= new Util;

if(isset($_GET['read'])){
    $result=$db->read();
   
   $output='';
   foreach($result as $guitar){

    $output .= 
   
    '<div class= "col-sm-8 col-md-5  col-lg-3   p-0  mb-2    mb-1 ">
    <div class="card mx-1 rounded-0 shadow-sm border-0 " style="height:350px;">
            <div class="card-body  p-0" style=" height: 250px;">

                <img class="card-img w-100 h-100 " src="img/'.$guitar['g_image'].'"></img>
            </div>
            <div class="card-footer p-0 px-1 bg-white" style=" height:100px;">
            <div class="row mx-auto  h-50 p-0">
                <div class="col col-lg-8 col-md-8 my-auto ">  
                <p class=" text-center">'.$guitar['g_name'].'</p>
                </div>
                <div class=" col col-lg-4 col-md-4 my-auto text-center">
                <p class="text-right">'.$guitar['g_price'].' kn</p>
                </div>
         
            </div>
            
            
           
                <a type="submit" href="SingleProduct.php?id='.$guitar['id'].'" class="btn btn-dark  w-100 rounded-0 col-lg-6 col-md-8  mx-auto addcartbtn"  id='.$guitar['id'].'  value='.$guitar['id'].'>Buy</a>   
           
         
          </div>
            </div> 
         
            </div> ';
           
            
   }
   
echo $output;
}


// if(isset($_POST['addcart'])){
//     $id= $util->testInput($_POST['id']);
//     echo 'tuje id'. $id;
//     $gname=$util->testInput($_POST['g_name']);
//     $gprice= $util->testInput($_POST['g_price']);
//     $gimg= $util->testInput($_POST['g_image']);
//     $quantity= $util->testInput($_POST['quantity']);
//     $total= $util->testInput($_POST['total_price']);
//     $gcode= $util->testInput($_POST['g_code']);

//     if ($db->insertincart($gname,$gprice,$gimg,$quantity,$total,$gcode)) {
//         echo $util->showMessage('success', 'User inserted successfully!');
//       } else {
//         echo $util->showMessage('danger', 'Something went wrong!');
//       }
// }


// get single guitar

function getProduct($id){
  $db=new Database;

$output= '';
  $result=$db->getguitar($id);

  $output.=
  '<div class="col-lg-6 mx-auto  text-center pt-5 my-auto" style="max-height:70vh;">
    <img src="img/'.$result['g_image'].'" class="h-75 w-75" alt='.$result['g_image'].'></img>
  </div>
  <div class="col-lg-6 mx-auto  text-center pt-5 my-auto" style="max-height:70vh;">
 <div class="my-auto  ">
  <h4  id="g-name" class="my-4 display-4 font-weight-bold border-bottom border-dark">'.$result['g_name'].'</h4>
  <h5 id="g-price" class="  my-4 text-success" style="font-size:1.3rem;font-weight:400;"><small class="text-dark">Price : </small> '.$result['g_price'].'HRK</h5>
  <p class=" my-4  text-center" style="font-size:1.6rem;"><small style="font-size:1.2rem;">Description: </small>  Lorem ipsum dolor sit amet consectetur adipisicing.</p>
      <form class="form-data">
          <input class="form-control" type="hidden" name="id" value='.$result['id'].' id="id">
          <input class="form-control" type="hidden" name="g_name" value='.$result['g_name'].' id="name" >
          <input class="form-control" type="hidden" name="g_price" value='.$result['g_price'].' >
          <input class="form-control" type="hidden" name="g_image" value='.$result['g_image'].' >
          <input class="form-control" type="hidden" name="g_code" value='.$result['g_code'].'>
          <button   class=" btn btn-dark rounded-0 my-4 addtocartbtn" id='.$result['id'].'>ADD TO CART</button>
      </form>
  
  </div>
  </div>
 '
;
  echo $output;
}

if (isset($_POST['gcode']) ) {
  
 
  $gcode= $util->testInput($_POST['gcode']);

  if($db->IncreasValue($gcode)){
    echo $util->showMessage('success', 'User increas value!');
  }else{
    echo $util->showMessage('danger', 'Something went wrong!');
  }
 
 
}

if (isset($_POST['g_name']) ) {
  
  $gname = $util->testInput($_POST['g_name']);
  $gprice = $util->testInput($_POST['g_price']);
  $gimage = $util->testInput($_POST['g_image']);
  $quantity=$util->testInput(1);
  $total= $util->testInput($quantity*$gprice);
  $gcode= $util->testInput($_POST['g_code']);

  if($db->CheckProductExist($gcode)){
    if($db->IncreasValue($gcode)){
      echo $util->showMessage('success', 'User increas value!');
    }else{
      echo $util->showMessage('danger', 'Something went wrong!');
    }
  }else{

  if ($db->addToCart($gname,$gprice,$gimage,$quantity,$total,$gcode)) {
    echo $util->showMessage('success', 'User inserted successfully!');
    
  } else {
    echo $util->showMessage('danger', 'Something went wrong!');
    
  }
}
}

// Handle Fetch All Users Ajax Request
if (isset($_GET['cart'])) {
  $users = $db->cartRead();
  $output = '';
  if ($users) {
    foreach ($users as $result) {
      $output .= '
      <div class="card col-lg-3 col-md-5 col-sm-8 m-1 p-3 border-0 shadow-sm" >
      <img src="img/'.$result['g_image'].'" class="h-75 w-75" alt='.$result['g_image'].'></img>
      <div class="card-body">
      <input type="hidden" value='.$result['quantity'].' class="g-code"/>
      <input type="hidden" value='.$result['g_code'].' class="g-code"/>
        <h5 class="card-title">'.$result['g_name'].'</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk.</p>
        <button href="#" class="btn btn-secondary addBtn">+</button>
        <h6 class="card-title">'.$result['quantity'].'</h6>
        <button href="#" class="btn btn-danger deleteBtn">-</button>
      </div>
    </div>';
    }
    echo $output;
  } else {
    echo '<tr>
            <td colspan="6">No Users Found in the Database!</td>
          </tr>';
  }
}




?>


