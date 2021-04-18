<?php if(!class_exists('Rain\Tpl')){exit;}?><body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
					<span class="login100-form-title-1">
						Sistema de Luta
					</span>
					<span style="color: #fff;">
                        Login
                    </span>
				</div>

                <form action="/login" method="POST" class="login100-form validate-form">
                    <?php if( $error != '' ){ ?>
                    <div class="alert alert-danger">
                      <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                    <?php } ?>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">E-mail</span>
						<input class="input100" type="email" name="email_user" placeholder="E-mail cadastrado">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Senha</span>
						<input class="input100" type="password" name="password_user" placeholder="Digite a senha">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<a href="/forgot" class="txt1">
								Esqueci a senha.
							</a>
						</div>

						<div>
							<a href="/users/create" class="txt1">
								Não possui conta.
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	