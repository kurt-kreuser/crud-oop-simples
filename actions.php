<?php
session_start();
//alterar status do botão update/cadastrar
$status_button = ( !isset($_GET['id']) ? 'enviar' : 'atualizar' );
//alterar status do botão update/cadastrar
$status_title = ( !isset($_GET['id']) ? 'CADASTRAR VAGA' : 'ATUALIZAR VAGA' );

//insert
if(isset($_POST['enviar'])){
  $f['titulo'] = $_POST['titulo'];
  $f['descricao'] = $_POST['descricao'];
  $f['ativo'] = $_POST['ativo'];
  $f['data'] = date('Y/m/d H:i:s');

  if(!in_array('', $f)){
    $cadastrar = new Process;
    $cadastrar->insert($f);
    $_SESSION['errorMsg'] = $cadastrar->errorMsg;
    unset($f);
    header('location: index.php?success=insert'); exit;
    }else{
      $success = 'warning';
      $err = 'Contem dados em branco!';
    }
}

//delete
if( isset($_POST['excluir']) and is_numeric($_GET['id']) ){
  $id = $_GET['id'];
  $excluir = new Process;
  $excluir->delete($id);
  $_SESSION['errorMsg'] = $excluir->errorMsg;
  unset($f);
  header('location: index.php?success=delete'); exit;
}

//select dados
if( isset($_POST['editar']) and is_numeric($_GET['id']) ){
  $id = $_GET['id'];
  $listar = new Process;
  //listar dados do update
  $listar->getSelect($id);
  foreach ($listar->executar as $v2);
}

//update
if(isset($_POST['atualizar'])){
  $id = $_GET['id'];
  $f['titulo'] = $_POST['titulo'];
  $f['descricao'] = $_POST['descricao'];
  $f['ativo'] = $_POST['ativo'];
  $f['data'] = date('Y/m/d H:i:s');

  if(!in_array('',$f) ){
    $update = new Process;
    $update->update($f,$id);
    $_SESSION['errorMsg'] = $update->errorMsg;
    unset($f);
    header('location: index.php?success=update');
  }else{
    $success = 'warning';
    $err = 'Contem dados em branco!';
    }
}

//mostrar error mensagens
if( isset($_GET['success']) and !empty($_GET['success']) ){
    $err = $_SESSION['errorMsg'];
  if( !empty($err) ){
    switch ($_GET['success']){
      case 'insert': $success = 'success';
        break;
      case 'update': $success = 'info';
        break;
      case 'delete': $success = 'danger';
        break;
    }//if
  }else{
    header('location: index.php'); exit;
  }
}

?>
