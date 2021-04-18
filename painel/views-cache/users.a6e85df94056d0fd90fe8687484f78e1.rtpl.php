<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Usuários
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/users">Usuários</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                
                <div class="box-header">
                  <a href="/users/create" class="btn btn-success">Cadastrar Aluno / Professor</a>
                </div>
    
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th style="width: 60px"></th>
                        <th style="width: 240px">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                      <?php if( $value1["type_user"] == 2 ){ ?>
                      <?php }else{ ?>
                      <tr>
                        <td><?php echo htmlspecialchars( $value1["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo htmlspecialchars( $value1["email_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo htmlspecialchars( $value1["phone_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php if( $value1["type_user"] == 1 ){ ?>Professor<?php }else{ ?>Aluno<?php } ?></td>
                        <?php if( $value1["type_user"] == 1 ){ ?><td>
                          <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                          <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/password" class="btn btn-default btn-xs"><i class="fa fa-unlock"></i> Alterar Senha</a>
                          <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                        </td><?php }else{ ?><td>
                          <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                          <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/payment" class="btn btn-default btn-xs"><i class="fa fa-unlock"></i> Mensalidade</a>
                          <a href="/users/<?php echo htmlspecialchars( $value1["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                        </td><?php } ?>
                        
                        <?php } ?>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
          </div>
      </div>
    
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->