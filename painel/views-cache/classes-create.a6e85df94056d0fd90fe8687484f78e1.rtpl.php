<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Categorias
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/class">Categorias</a></li>
        <li class="active"><a href="/class/create">Cadastrar</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nova Aula</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/class/create" method="post">
              <input type="hidden" name="id_user" value="<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="descategory">Nome da aula</label>
                  <input type="text" class="form-control" id="name_class" name="name_class" placeholder="Digite o nome da aula">
                </div>
                <div class="form-group">
                    <label for="descategory">Quantidade de alunos</label>
                    <input type="number" class="form-control" id="qtd" name="qtd" placeholder="Números de Alunos">
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-success">Cadastrar</button>
              </div>
            </form>
          </div>
          </div>
      </div>
    
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->