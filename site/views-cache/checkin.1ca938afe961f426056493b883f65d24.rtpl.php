<?php if(!class_exists('Rain\Tpl')){exit;}?><body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
					<a href="/"><span class="login100-form-title-1">
						Sistema de Luta
                    </span></a>
                    <span style="color: #fff;">
                        Agendamento - Escolher a aula
                    </span>
                </div>
				<form action="/checkin/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Aula</span>
                        <select class="select100" name="id_class" id="id_class">
							<option value="">Escolha uma aula...</option>
							<?php $counter1=-1;  if( isset($class) && ( is_array($class) || $class instanceof Traversable ) && sizeof($class) ) foreach( $class as $key1 => $value1 ){ $counter1++; ?>
							<option value="<?php echo htmlspecialchars( $value1["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
							<?php } ?>
                        </select>
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Check-in
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	