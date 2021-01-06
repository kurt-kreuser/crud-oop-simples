<?php
  require 'Process.php';
  require 'actions.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>CRUD</title>

  </head>
  <body>
    <div class="container">
      <h1 class="mt-5 mb-5"><?= $status_title; ?></h1>
      <form action="" method="post">

        <div class="form-group">
          <label>TÍTULO DA VAGA: </label>
          <input type="text" class="form-control" name="titulo" value="<?= isset($v2['titulo']) ? $v2['titulo'] :''; ?>" />
        </div>

        <div class="form-group mt-3">
          <label>DESCRIÇÃO DA VAGA: </label><input type="text" class="form-control" name="descricao" value="<?=isset($v2['descricao']) ? $v2['descricao'] : ''; ?>" />
        </div>

        <div class="form-group mt-3">
          <input type="radio" class="form-check-input" name="ativo" value="s" checked />
          <label class="form-check-label">ATIVO: </label>
          <input type="radio" class="form-check-input" name="ativo" value="n" <?php if( !empty($v2['ativo']) and$v2['ativo'] == 'n' ){ echo 'checked'; } ?> />
          <label class="form-check-label">INATIVO: </label>
        </div>

        <div class="form-group">
          <input type="submit" class="mt-3 mb-3 btn btn-primary" name="<?= $status_button; ?>" value="<?=$status_button; ?>" />
        </div>

        <?php if(isset($err)){ echo "<div class='alert alert-{$success}' role='alert'>$err</div>"; } ?>

      </form>
    </div>

    <div class="container">
        <h1 class="mt-5">LISTAR VAGAS CADASTRADAS</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">TÍTULO</th>
              <th scope="col">DESCRIÇÃO</th>
              <th scope="col">STATUS</th>
              <th scope="col">DATA</th>
              <th scope="col">EDITAR</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $listar = new Process;
              $listar->select(/*especifique aqui limite de linhas*/);
                if($listar->linhas > 0){
                  foreach ($listar->executar as $v):
                    $status = ( $v['ativo'] == 'n' ? 'INATIVO' : 'ATIVO');
                    echo "
                      <tr>
                        <th scope='row'>{$v['id']}</th>
                        <td>{$v['titulo']}</td>
                        <td>{$v['descricao']}</td>
                        <td>{$status}</td>
                        <td>{$v['data']}</td>
                        <td>
                          <form method='post' action='index.php?id={$v['id']}'>
                            <a href='index.php?id={$v['id']}'>
                              <input type='submit' class='btn btn-success' name='editar' value='editar' />
                            </a>
                            <a href='index.php?id={$v['id']}'>
                              <input type='submit' class='btn btn-danger' name='excluir' value='excluir' />
                            </a>
                          </form>
                        </td>
                      </tr>
                      ";
                  endforeach;
                }else{
                  echo "
                  <tr>
                    <th scope='row'>Não há vagas cadastradas!</th>
                  </tr>
                  ";
                }
            ?>
          </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
