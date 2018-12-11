<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border center">
            <h3 class="box-title">Resumen de Ejecución de Viviendas 2018</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="">
              
            {!! $chartjs_resumeneje->render() !!}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border center">
            <h3 class="box-title">Porcentaje en relación al Total Planificado</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="">
            {!! $chartjs_porcentajeplan->render() !!}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>
