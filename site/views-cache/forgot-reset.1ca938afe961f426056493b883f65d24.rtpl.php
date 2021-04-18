<?php if(!class_exists('Rain\Tpl')){exit;}?><body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image: url(/res/images/bg.jpg);">
          <span class="login100-form-title-1">
            Sistema de Luta
          </span>
          <span style="color: #fff;">
            Olá <?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?>, digite uma nova senha:
          </span>
        </div>

        <form action="/forgot/reset" method="post" class="login100-form validate-form">
          <input type="hidden" name="code" value="<?php echo htmlspecialchars( $code, ENT_COMPAT, 'UTF-8', FALSE ); ?>">

          <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
            <span class="label-input100">Senha</span>
            <input class="input100" type="password" name="password_user" placeholder="Digite a nova senha">
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Alterar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>