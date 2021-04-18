<?php if(!class_exists('Rain\Tpl')){exit;}?><body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
					<a href="/"><span class="login100-form-title-1">
						Sistema de Luta
                    </span></a>
                    <span style="color: #fff;">
                        Agendamento - Escolher a horario
                    </span>
				</div>
				<?php if( $msgError != '' ){ ?>
                <div class="alert alert-danger alert-dismissible" style="margin:10px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
                <?php } ?>
				<form action="/checkin/<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $lession, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="POST" class="login100-form validate-form">
					<input type="hidden" name="id_user" value="<?php echo htmlspecialchars( $user["id_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Nome</span>
						<input class="input100" type="text" disabled name="name_user" value="<?php echo htmlspecialchars( $user["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
						<span class="focus-input100"></span>
					</div>
					<?php $counter1=-1;  if( isset($class) && ( is_array($class) || $class instanceof Traversable ) && sizeof($class) ) foreach( $class as $key1 => $value1 ){ $counter1++; ?>
					<input type="hidden" name="id_class" value="<?php echo htmlspecialchars( $value1["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Aula</span>
						<input class="input100" type="text" disabled name="name_class" value="<?php echo htmlspecialchars( $value1["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
						<span class="focus-input100"></span>
					</div>
					<?php } ?>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Horario</span>
                        <select class="select100" name="id_date_hour_class" id="id_date">
							<option value="id_date_hour_class">Escolha a hora uma aula...</option>
							<?php $counter1=-1;  if( isset($date) && ( is_array($date) || $date instanceof Traversable ) && sizeof($date) ) foreach( $date as $key1 => $value1 ){ $counter1++; ?>
							<option value="<?php echo htmlspecialchars( $value1["id_date_hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo formatDate($value1["date_class"]); ?> - <?php echo htmlspecialchars( $value1["hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
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
	