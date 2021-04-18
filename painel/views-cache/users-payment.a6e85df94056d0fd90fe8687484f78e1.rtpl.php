<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Senha do Usuário
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Pagamento do Usuário</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <?php if( $msgError != '' ){ ?>
          <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <?php } ?>
          <?php if( $msgSuccess != '' ){ ?>
          <div class="alert alert-success alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo htmlspecialchars( $msgSuccess, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          </div>
          <?php } ?>

          <form role="form" action="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/payment" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="despassword">Aluno</label>
                <input type="hidden" name="id_aluno" value="<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="text" class="form-control" id="name_user" value="<?php echo htmlspecialchars( $user["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
              </div>
              <div class="form-group">
                <label for="despassword-confirm">Professor</label>
                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars( $idprofessor, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars( $professor, ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
              </div>
              <div class="form-group">
                <label for="despassword-confirm">Aula</label>
                <select class="form-control" name="id_class" id="id_class">
                  <option value="id_class">Escolha a hora uma aula...</option>
                  <?php $counter1=-1;  if( isset($aulas) && ( is_array($aulas) || $aulas instanceof Traversable ) && sizeof($aulas) ) foreach( $aulas as $key1 => $value1 ){ $counter1++; ?>
                  <option value="<?php echo htmlspecialchars( $value1["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="pagamento" value="1"> Mensalidade Atrasada
                </label>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->