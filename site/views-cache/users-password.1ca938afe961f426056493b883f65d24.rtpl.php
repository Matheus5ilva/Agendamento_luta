<?php if(!class_exists('Rain\Tpl')){exit;}?><body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
                    <a href="/"><span class="login100-form-title-1">
						Sistema de Luta
                    </span></a>
                    <span style="color: #fff;">
                        Alterar Senha
                    </span>
                </div>

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
                <form action="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/password" method="post" class="login100-form validate-form">
                    <div class="wrap-input100  m-b-26">
                        <span class="label-input100">Nova Senha</span>
                        <input class="input100" type="password" name="password_user">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 m-b-26">
                        <span class="label-input100">Confirme a senha</span>
                        <input class="input100" type="password" name="password_user-confirm">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="flex-sb-m w-full menu-form p-b-30">
                        <div class="botom"> <button class="login100-form-btn">
                                Salvar
                            </button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>