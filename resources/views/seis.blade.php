<div class="row">
    <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border center">
                <h3 class="box-title">Cantidad de Viviendas Planificadas, Culminadas y en Ejecución por Departamento</h3>
    
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="">
                {!! $chartjsdptos->render() !!}
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header center" >
            <h3 class="box-title">Cantidad de Viviendas Planificadas, Culminadas y en Ejecución por Departamento</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table">
                <tbody><tr>
                <th>Departamento</th>
                <th class="center">Viviendas Planificadas</th>
                <th class="center">Viviendas Culminadas</th>
                <th class="center">Viviendas En Ejecución</th>
                <th class="center">Viviendas A Iniciar</th>
                </tr>
                @foreach($tabger03 as $tabdpto)  
                    <tr>
                        <td>{{ utf8_encode($tabdpto->TabGer03DptoNom) }}</td>
                        <td class="center">{{ number_format($tabdpto->TabGer03VivPla,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tabdpto->TabGer03VivCul,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tabdpto->Tabger03VivEje,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tabdpto->TabGer03VivIni,0,'.','.') }}</td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                            <th>Total General</th>
                            <th class="center">{{ number_format($tabger03->sum('TabGer03VivPla'),0,'.','.') }}</th>
                            <th class="center">{{ number_format($tabger03->sum('TabGer03VivCul'),0,'.','.') }}</th>
                            <th class="center">{{ number_format($tabger03->sum('Tabger03VivEje'),0,'.','.') }}</th>
                            <th class="center">{{ number_format($tabger03->sum('TabGer03VivIni'),0,'.','.') }}</th>
                </tfoot>
            </tbody></table>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header center">
            <h3 class="box-title">Ejecución por Proyecto en base al Plan Financiero a Oct. 2018</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="">
            <table class="table">
                <tbody><tr>
                <th>Programa</th>
                <th class="center">Presupuesto Vigente 2018</th>
                <th class="center">Plan financiero 2018</th>
                <th class="center">Obligado</th>
                <th class="center">%</th>
                </tr>
                @foreach($tabger02 as $tab)  
                    <tr>
                        <td>{{ utf8_encode($tab->TabGer02PrgPry) }}</td>
                        <td class="center">{{ number_format($tab->TabGer02Presup,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tab->TabGer02PlanFin,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tab->TabGer02Oblig,0,'.','.') }}</td>
                        <td class="center">{{ number_format( ($tab->TabGer02Oblig * 100) / $tab->TabGer02PlanFin) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="total">Total</td>
                    <td class="center total">{{ number_format($tabger02->sum('TabGer02Presup'),0,'.','.') }}</td>
                    <td class="center total">{{ number_format($tabger02->sum('TabGer02PlanFin'),0,'.','.') }}</td>
                    <td class="center total">{{ number_format($tabger02->sum('TabGer02Oblig'),0,'.','.') }}</td>
                    <td class="center total">{{ number_format( ($tabger02->sum('TabGer02Oblig') * 100) / $tabger02->sum('TabGer02PlanFin')) }}</td>
                </tr>
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>