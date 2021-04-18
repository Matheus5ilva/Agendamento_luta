<?php if(!class_exists('Rain\Tpl')){exit;}?><body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
					<span class="login100-form-title-1">
						Sistema de Luta
					</span>
					<span style="color: #fff;">
                        Recuperar senha
                    </span>
				</div>

                <form  action="/forgot" method="post" class="login100-form validate-form">
                   
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">E-mail</span>
						<input class="input100" type="email" name="email_user" placeholder="E-mail de recuperação">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Enviar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	