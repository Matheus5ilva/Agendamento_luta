<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Usuários
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/users">Usuários</a></li>
        <li class="active"><a href="/users/create">Cadastrar</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Novo Usuário</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/users/create" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="desperson">Nome</label>
                  <input type="text" class="form-control" id="name_user" name="name_user" placeholder="Digite o nome">
                </div>
                <div class="form-group">
                  <label for="nrphone">Telefone</label>
                  <input type="tel" class="form-control" id="phone_user" name="phone_user" placeholder="Digite o telefone">
                </div>
                <div class="form-group">
                  <label for="desemail">E-mail</label>
                  <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Digite o e-mail">
                </div>
                <div class="form-group">
                  <label for="despassword">Senha</label>
                  <input type="password" class="form-control" id="password_user" name="password_user" placeholder="Digite a senha">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="type_user" value="1"> Professor
                  </label>
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