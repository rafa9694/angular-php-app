<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");
$policies = [];
$sql = "SELECT id, usuario, senha FROM policies";

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
    // Validate.
  if(trim($request->login) === '' || trim($request->senha) === '')
  {
    return http_response_code(400);
  }

  if($result = mysqli_query($con,$sql))
  {
  
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $policies[$i]['id'] = $row['id'];
      $policies[$i]['usuario'] = $row['usuario'];
      $policies[$i]['senha'] = $row['senha'];
      $i++;
    }
    
    if($policies[0]['usuario'] == $request->login && $policies[0]['senha'] == $request->senha){

      return http_response_code(200);
    
    }else{
      
      return http_response_code(400);
    
    }
    
    
  }
}
  // Sanitize.
//   $usuario = mysqli_real_escape_string($con, trim($request->usuario));
//   $senha = mysqli_real_escape_string($con, trim($request->senha));

//   // Create.
//   $sql = "INSERT INTO `policies`(`id`,`usuario`,`senha`) VALUES (null,'{$usuario}','{$senha}')";

//   if(mysqli_query($con,$sql))
//   {
//     http_response_code(201);
//     $policy = [
//       'usuario' => $usuario,
//       'senha' => $senha,
//       'id'    => mysqli_insert_id($con)
//     ];
//     echo json_encode($policy);
//   }
//   else
//   {
//     http_response_code(422);
//   }
// }