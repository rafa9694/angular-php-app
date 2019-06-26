<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Validate.
  if(trim($request->usuario) === '' || trim($request->senha) == '')
  {
    return http_response_code(400);
  }

  // Sanitize.
  $usuario = mysqli_real_escape_string($con, trim($request->usuario));
  $senha = mysqli_real_escape_string($con, trim($request->senha));

  // Create.
  $sql = "INSERT INTO `policies`(`id`,`usuario`,`senha`) VALUES (null,'{$usuario}','{$senha}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'usuario' => $usuario,
      'senha' => $senha,
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}