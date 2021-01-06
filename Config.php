<?php

  class Config{

    const HOST = 'localhost';
    const DBNAME = 'wdev_vagas';
    const USER = 'root';
    const PASS = '';

    public function conect(){
      try{
        $this->pdo = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME.';charset=utf8',self::USER,self::PASS);
      }catch(PDOException $e){
        echo 'Erro: ' . $e->getMessage() . '<hr />';
        echo 'Código de erro: ' . $e->getCode() . '<hr />';
        echo 'Linha: ' . $e->getLine() . '<hr />';
        echo 'Arquivo: ' . $e->getFile() . '<hr />';
      }
    }//end conect

  }//end config

?>
