<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicionar Dia
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/classes">Data</a></li>
        <li class="active"><a href="/date/create">Cadastrar</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nova Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if( $error != '' ){ ?>
            <div class="alert alert-danger">
              <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </div>
            <?php } ?>
            <form role="form" action="/date/create" method="post">
             
              <div class="box-body">
                <div class="form-group">
                  <label for="descategory">Data</label>
                  <input type="date" class="form-control" id="date_class" name="date_class" placeholder="Digite a data da aula">
                </div>
                <div class="form-group">
                  <label for="descategory">Hora</label>
                  <input type="time" class="form-control" id="hour_class" name="hour_class" placeholder="Digite a hora da aula">
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