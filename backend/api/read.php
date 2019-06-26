<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

$policies = [];
$sql = "SELECT id, usuario, senha FROM policies";

if($result = mysqli_query($con,$sql))
{
  
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']    = $row['id'];
    $policies[$i]['usuario'] = $row['usuario'];
    $policies[$i]['senha'] = $row['senha'];
    $i++;
  }

  echo json_encode($policies);
}
else
{
  http_response_code(404);
  echo "aki";
}

?>