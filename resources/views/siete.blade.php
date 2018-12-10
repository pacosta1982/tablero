<div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border center">
                    <h3 class="box-title">Total de Viviendas en Ejecución clasificados según el porcentaje de Avance</h3>
        
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" style="">
                    {!! $chartjsavance->render() !!}
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
            <h3 class="box-title">Total de Viviendas en Ejecución clasificados según el % de Avance</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table">
                <tbody>
                <tr>
                <th>Programa</th>
                <th class="center">0% - 25%</th>
                <th class="center">26% - 50%</th>
                <th class="center">51% - 75%</th>
                <th class="center">76% - 100%</th>
                <th class="center">Total</th>
                </tr>
                @foreach($tabger01 as $tabavance)
                @if(!$loop->last)  
                    <tr>
                        <td>{{ utf8_encode($tabavance->TabGer01Prog) }}</td>
                        <td class="center">{{ number_format($tabavance->TabGer01Ava25,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tabavance->TabGer01Ava50,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tabavance->TabGer01Ava75,0,'.','.') }}</td>
                        <td class="center">{{ number_format($tabavance->TabGer01Ava100,0,'.','.') }}</td>
                        <td class="center"><strong>{{ number_format(
                            ($tabavance->TabGer01Ava100+$tabavance->TabGer01Ava75+$tabavance->TabGer01Ava50+$tabavance->TabGer01Ava25)
                            ,0,'.','.') }}</strong></td>
                    </tr>
                @else
                <tfoot>
                    <tr>
                        <th>{{ $tabavance->TabGer01Prog }}</th>
                        <th class="center">{{ number_format($tabavance->TabGer01Ava25,0,'.','.') }}</th>
                        <th class="center">{{ number_format($tabavance->TabGer01Ava50,0,'.','.') }}</th>
                        <th class="center">{{ number_format($tabavance->TabGer01Ava75,0,'.','.') }}</th>
                        <th class="center">{{ number_format($tabavance->TabGer01Ava100,0,'.','.') }}</th>
                        <th class="center">{{ number_format(
                                ($tabavance->TabGer01Ava100+$tabavance->TabGer01Ava75+$tabavance->TabGer01Ava50+$tabavance->TabGer01Ava25)
                                ,0,'.','.') }}</th>
                </tfoot>
                @endif
                @endforeach
                
            </tbody></table>
            </div>

        </div>
    </div>
</div>
