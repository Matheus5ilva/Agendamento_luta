<?php if(!class_exists('Rain\Tpl')){exit;}?><body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
					<a href="/"><span class="login100-form-title-1">
						Sistema de Luta
                    </span></a>
                    <span style="color: #fff;">
                        <?php $counter1=-1;  if( isset($checkin) && ( is_array($checkin) || $checkin instanceof Traversable ) && sizeof($checkin) ) foreach( $checkin as $key1 => $value1 ){ $counter1++; ?>
                        Quantidade de lutas do dia <?php echo formatDate($value1["date_class"]); ?> - <?php echo htmlspecialchars( $value1["hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        
                    </span>
                </div>
                
                <form action="/quedas/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["id_check_in"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/create" method="POST" class="login100-form validate-form">
					<input type="hidden" name="id_check_in" value="<?php echo htmlspecialchars( $value1["id_check_in"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Quantidades de Lutas hoje</span>
						<input class="input100" type="text" name="qtd_lutas">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Salvar
						</button>
					</div>
                </form>
                <?php } ?>
			</div>
		</div>
	</div>
	