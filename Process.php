<?php
require 'Config.php';

class Process extends Config{

  //insert
  public function insert($array){
    $this->conect();
    $values = "'" . implode("', '", $array) . "'";
    $query = "INSERT INTO vagas (titulo, descricao, ativo, data) VALUES ({$values})";
    $executar = $this->pdo->exec($query);
    if($executar){
      $last = $this->pdo->lastInsertId();
      $this->errorMsg = 'Cadastro com ID: <b>' .$last. ' </b>efetuado com sucesso!';
    }else{
      $this->errorMsg = 'Falha ao cadastrar!';
    }
  }//end insert

  //delete
  public function delete($id){
    $this->conect();
    $query = "DELETE FROM vagas WHERE id = '{$id}'";
    $executar = $this->pdo->exec($query);
    if($executar){
      $this->errorMsg = 'Cadastro com ID: <b>' .$id. ' </b> deletado com sucesso!';
    }else{
      $this->errorMsg = 'Erro ao deletar!';
    }
  }//end delete

  //update
  public function update($array, $id){
    $this->conect();
    //formata dados p/ query update
    foreach($array as $key => $v){
      $dados[] = $key . ' = ' . "'$v', ";
    }
    //retira última vírgula
    $dados = mb_substr(implode('', $dados), 0, -2);
    $query = "UPDATE vagas SET {$dados} WHERE id = '{$id}'";
    $executar = $this->pdo->exec($query);
    if($executar){
      $this->errorMsg = 'Cadastro com ID: <b>' .$id. ' </b> editado com sucesso!';
    }else{
      $this->errorMsg = 'Erro ao editar!';
    }
  }//end update

  //select
  public function select($par = null){
    $this->conect();
    $limite = ( is_numeric($par) ? " LIMIT {$par}" : $par = '' );
    $query = "SELECT * FROM vagas{$limite}";
    $this->executar = $this->pdo->query($query)->fetchAll();
    $this->linhas = $this->pdo->query($query)->rowCount();
  }//end select

  //getid
  public function getSelect($id){
    $this->conect();
    $query = "SELECT * FROM vagas WHERE id = '{$id}'";
    $this->executar = $this->pdo->query($query)->fetchAll();
    $this->linhas = $this->pdo->query($query)->rowCount();
  }//end select

}//end Process

?>
