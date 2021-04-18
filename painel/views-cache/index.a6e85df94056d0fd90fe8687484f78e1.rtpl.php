<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bem - vindo!
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo htmlspecialchars( $alunos, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

            <p>Alunos Registrados</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php $counter1=-1;  if( isset($aulas) && ( is_array($aulas) || $aulas instanceof Traversable ) && sizeof($aulas) ) foreach( $aulas as $key1 => $value1 ){ $counter1++; ?>
      <div class="col-lg-3 col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo htmlspecialchars( $value1["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo formatDate($value1["date_class"]); ?> - <?php echo htmlspecialchars( $value1["hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
            </h3>
          </div>
          <?php $aula=$value1["id_class"]; ?>
          <?php $hora=$value1["hour_class"]; ?>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <?php $counter2=-1;  if( isset($checkin) && ( is_array($checkin) || $checkin instanceof Traversable ) && sizeof($checkin) ) foreach( $checkin as $key2 => $value2 ){ $counter2++; ?>
              <?php if( $hora==$value2["hour_class"] ){ ?>
              <?php if( $aula==$value2["id_class"] ){ ?>
              <li class="item">
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title"><?php echo htmlspecialchars( $value2["name_user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                </div>
              </li>
              <?php } ?>
              <?php } ?>
              <?php } ?>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.box-footer -->
        </div>
      </div>
      <?php } ?>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->