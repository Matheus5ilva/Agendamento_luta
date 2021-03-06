<?php if(!class_exists('Rain\Tpl')){exit;}?><body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
                    <a href="/"><span class="login100-form-title-1">
						Sistema de Luta
                    </span></a>
                    <span style="color: #fff;">
                        Olá <?php echo htmlspecialchars( $user["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </span>
                </div>

                <div class="menu100-form  validate-form">
                    <div class="flex-sb-m w-full menu-form p-b-30">
                        <div class="botom">
                            <a href="/checkin" style="color: #fff;" class="menu100-form-btn bg-primary">
                                Agendamento
                            </a>
                        </div>
                        <div > <a href="/list-lesson/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="color: #fff;" class="menu100-form-btn bg-primary">
                                Proximas Aulas
                            </a></div>

                    </div>
                    <div class="flex-sb-m w-full menu-form p-b-30">
                        
                            <div class="botom"> <a href="/quedas/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="color: #fff;" class="menu100-form-btn bg-primary">
                                Quedas
                            </a></div>
                        <div>
                            <div class="botom"> <a href="/users/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" style="color: #fff;" class="menu100-form-btn bg-primary">
                                Alterar Dados
                            </a></div>
                        </div>
                    </div>
                    <div class="flex-sb-m w-full menu-form p-b-30">
                        <div>
                            <div > <a href="/logout" style="color: #fff;" class="menu100-form-btn bg-danger">
                                    Sair
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
