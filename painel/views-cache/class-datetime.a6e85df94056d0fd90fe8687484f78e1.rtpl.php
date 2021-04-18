<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Datas e Horarios da Aula <?php echo htmlspecialchars( $class["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/class">Aulas</a></li>
            <li><a href="/class/<?php echo htmlspecialchars( $class["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $class["name_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Todos os Dias e Horarios Disponíveis</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Novos Horarios</th>
                                    <th style="width: 240px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($dateNotRelated) && ( is_array($dateNotRelated) || $dateNotRelated instanceof Traversable ) && sizeof($dateNotRelated) ) foreach( $dateNotRelated as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td><?php echo formatDate($value1["date_class"]); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/class/<?php echo htmlspecialchars( $class["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/date/<?php echo htmlspecialchars( $value1["id_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/add"
                                            class="btn btn-primary btn-xs pull-right"><i class="fa fa-arrow-right"></i>
                                            Adicionar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datas e horarios cadastrados</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Horarios</th>
                                    <th style="width: 240px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($dateRelated) && ( is_array($dateRelated) || $dateRelated instanceof Traversable ) && sizeof($dateRelated) ) foreach( $dateRelated as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td><?php echo formatDate($value1["date_class"]); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/class/<?php echo htmlspecialchars( $class["id_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/date/<?php echo htmlspecialchars( $value1["id_date_hour_class"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/remove"
                                            class="btn btn-primary btn-xs pull-right"><i class="fa fa-arrow-left"></i>
                                            Remover</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->