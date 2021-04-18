<?php if(!class_exists('Rain\Tpl')){exit;}?><body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
                    <a href="/"><span class="login100-form-title-1">
                            Sistema de Luta
                        </span></a>
                    <span style="color: #fff;">
                        Editar Cadastro
                    </span>
                </div>


                <form action="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST" class="login100-form validate-form">
                    <div class="wrap-input100  m-b-26">
                        <span class="label-input100">Nome</span>
                        <input class="input100" type="text" name="name_user" value="<?php echo htmlspecialchars( $user["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 m-b-26">
                        <span class="label-input100">Telefone</span>
                        <input class="input100" type="number" name="phone_user" value="<?php echo htmlspecialchars( $user["phone_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="flex-sb-m w-full menu-form p-b-30">
                        <div class="wrap-input100 m-b-26">
                            <span class="label-input100">E-mail</span>
                            <input class="input100" type="email" name="email_user" value="<?php echo htmlspecialchars( $user["email_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="m-b-26">
                            <a href="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/password" style="color: #fff;"
                                class="btn btn-sm bg-primary">
                                Alterar senha
                            </a>
                        </div>
                    </div>
                    <input type="hidden" name="type_user" value="0">

                    <div class="flex-sb-m w-full menu-form p-b-30">
                        <div class="botom"> <button class="login100-form-btn">
                                Salvar
                            </button></div>

                        <div>
                            <div>
                                <div> <a href="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" style="color: #fff;"
                                        class="btn btn-sm bg-danger">
                                        Apagar Conta
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>