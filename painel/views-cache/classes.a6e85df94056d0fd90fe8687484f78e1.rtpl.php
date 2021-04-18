<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Aulas
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/class">Aulas</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header">
                  <a href="/class/create" class="btn btn-success">Cadastrar Aula</a>
                </div>
    
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Nome da Aula</th>
                        <th>Qtd. Alunos</th>
                        <th style="width: 240px">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter1=-1;  if( isset($class) && ( is_array($class) || $class instanceof Traversable ) && sizeof($class) ) foreach( $class as $key1 => $value1 ){ $counter1++; ?>
                      <tr>
                        <td><?php echo htmlspecialchars( $value1["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td><?php echo htmlspecialchars( $value1["qtd"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                        <td>
                          <a href="/class/<?php echo htmlspecialchars( $value1["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/date" class="btn btn-default btn-xs"><i class="fa fa-edit"></i>Data / Hora</a>
                          <a href="/class/<?php echo htmlspecialchars( $value1["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                          <a href="/class/<?php echo htmlspecialchars( $value1["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                        </td>
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