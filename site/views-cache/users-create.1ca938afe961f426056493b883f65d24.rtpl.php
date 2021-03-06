<?php if(!class_exists('Rain\Tpl')){exit;}?><body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
					<span class="login100-form-title-1">
						Sistema de Luta
                    </span>
                    <span style="color: #fff;">
                        Cadastro
                    </span>
                </div>
                
				<?php if( $msgError != '' ){ ?>
                <div class="alert alert-danger alert-dismissible" style="margin:10px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
                <?php } ?>
				<form action="/users/create" method="POST" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Nome</span>
						<input class="input100" type="text" name="name_user" placeholder="Digite seu nome">
						<span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Telefone</span>
						<input class="input100" type="number" name="phone_user" placeholder="Digite seu telefone">
						<span class="focus-input100"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">E-mail</span>
						<input class="input100" type="email" name="email_user" placeholder="Digite seu e-mail">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Senha</span>
						<input class="input100" type="password" name="password_user" placeholder="Digite sua senha">
						<span class="focus-input100"></span>
                    </div>
                    
                    <input type="hidden" name="type_user" value="0">

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Cadastrar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>