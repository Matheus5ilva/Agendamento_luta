<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Usuários
      </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Usuário</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                      <label for="desperson">Nome</label>
                      <input type="text" class="form-control" id="name_user" name="name_user" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="form-group">
                      <label for="nrphone">Telefone</label>
                      <input type="tel" class="form-control" id="phone_user" name="phone_user" placeholder="Digite o telefone" value="<?php echo htmlspecialchars( $user["phone_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="form-group">
                      <label for="desemail">E-mail</label>
                      <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $user["email_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="type_user" value="1" <?php if( $user["type_user"] == 1 ){ ?>checked<?php } ?>> Professor
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