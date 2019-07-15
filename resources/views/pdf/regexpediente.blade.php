<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Expediente </title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }

        #imagen{
        width: 100px;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #solicitante{
        text-align: left;
        }

        #fasolicitante{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }

        #fasolicitante thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facoficina{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facoficina thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facexpediente{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facexpediente thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #gracias{
        text-align: center; 
        }
    </style>
    <body>
        @foreach ($regexpediente as $r)
        <header>
            <div id="logo">
                <img src="img/logo1.jpg" alt="ahuac" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>MUNICIPALIDAD DISTRITAL DE AHUAC</b><br>Gestion Edil 2018-2022<br>AHUAC-CHUPACA-JUNIN<br>
                </p>
            </div>
            <div id="fact">
                <p>{{$r->fecha_tramite}}<br>
                {{$r->estado_tramite}}<br>
                </p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="fasolicitante">
                    <thead>                        
                        <tr>
                            <th id="fac">Solicitante</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <tr>
                            <td><p id="solicitante">Sr(a). {{$r->nombre}}<br>
                            {{$r->tipo_documento}}: {{$r->num_documento}}<br>
                            Dirección: {{$r->direccion}}<br> 
                            Edad: {{$r->edad}}<br> 
                            Estado Civil: {{$r->estado_civil}}<br> 
                            </p></td>              

                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
 
        <br>
        <br>

        <section>

            <div>
                <table id="facoficina">
                    <thead>
                        <tr id="fv">
                            <th>DESTINO DOCUMENTO</th>                      
                            <th>RESPONSABLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$r->unidad_organica}} </td>
                            <td>{{$r->responsable}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
       
        </section>
        <br>
        <br>

        <section>

            <div>
                <table id="facexpediente">
                    <thead>
                        <tr id="fa">
                            <th>CODIGO</th>
                            <th>ASUNTO</th>
                            <th>PRIORIDAD</th>
                            <th>OBSERVACIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$r->codigo_expediente}}</td>
                            <td>{{$r->asunto_tramite}}</td>
                            <td>{{$r->prioridad}}</td>
                            <td>{{$r->observaciones}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
         
        </section>      
        
        @endforeach 
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br> 


        <footer>
            <div id="gracias">
                <h3>GESTION EDIL 2018-2022</h3>
            </div>
        </footer>

    </body>
</html>