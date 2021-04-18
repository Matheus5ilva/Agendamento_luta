<?php if(!class_exists('Rain\Tpl')){exit;}?><body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
                    <a href="/"><span class="login100-form-title-1">
                            Sistema de Luta
                        </span></a>
                    <span style="color: #fff;">
                        Suas Aulas - Quedas
                    </span>
                    <span style="color: #fff;">
                        Total de <?php echo htmlspecialchars( $total, ENT_COMPAT, 'UTF-8', FALSE ); ?> lutas
                    </span>
                </div>


                <div class="menu100-form validate-form">
                    <?php $counter1=-1;  if( isset($class) && ( is_array($class) || $class instanceof Traversable ) && sizeof($class) ) foreach( $class as $key1 => $value1 ){ $counter1++; ?>
                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <a href="#" class="txt1">
                                <?php echo htmlspecialchars( $value1["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                            </a>
                        </div>

                        <div>
                            <a href="#" class="txt1">
                                <?php echo formatDate($value1["date_class"]); ?> - <?php echo htmlspecialchars( $value1["hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                            </a>
                        </div>
                        <div>
                            <a href="#" class="txt1">
                                <?php echo htmlspecialchars( $value1["qtd_lutas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                            </a>
                        </div>
                        <div>
                            <a href="/quedas/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["id_check_in"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/create" class="btn btn-sm bg-success" style="color: #fff;">
                                Adicionar Lutas
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>