<template>
    <main class="main">
            <!-- Breadcrumb -->
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
      <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
            <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Registro de Expedientes                      
                    </div>
                    <!-- INICIO tabla Listado de registro de expedientes -->
                         <!-- Listado-->
          <template v-if="listado==1">
                            <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                                        <div class="input-group">
                                                            <select class="form-control col-md-3" v-model="criterio">
                                                            <option value="idsolicitante">Solicitante</option>
                                                            <option value="idexpediente">Expediente</option>
                                                            </select>
                                                            <input type="text" v-model="buscar" @keyup.enter="listarRegexpediente(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                                            <button type="submit" @click="listarRegexpediente(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                                        </div>
                                                    </div>
                                </div>
                                    
                                        <!--Inicio del modal GENERAL DE REGISTRO DE DE EXPEDIENTES -->
                                
                                    <table class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                            <tr>
                                                            
                                                                <th>Asunto Tramite</th>
                                                                <th>Solicitante</th>
                                                                <th>Destino Doc</th>
                                                                <th>Fecha-Hora</th>
                                                                <th>Estado</th>
                                                                <th>Opciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="regexpediente in arrayRegexpediente" :key="regexpediente.id">
                                                            
                                                                <td v-text="regexpediente.asunto_tramite"></td>
                                                                <td v-text="regexpediente.nombre"></td>
                                                                <td v-text="regexpediente.unidad_organica"></td>
                                                                <td v-text="regexpediente.fecha_tramite"></td>
                                                                <td v-text="regexpediente.estado_tramite"></td> 
                                                                <td>
                                                                    <button type="button" class="btn btn-info btn-sm" @click="pdfRegexpediente(regexpediente.id)">
                                                                            <i class="icon-doc"></i>
                                                                        </button>&nbsp;
                                                                      <button type="button" @click="verRegexpediente(regexpediente.id)" class="btn btn-success btn-sm">
                                                                    <i class="icon-eye"></i>
                                                                    </button> &nbsp;
                                                                    <template v-if="regexpediente.estado_tramite=='Registrado'">
                                                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarRegexpediente(regexpediente.id)">
                                                                            <i class="icon-trash"></i>
                                                                        </button>
                                                                    </template> 
                                                                                        
                                                            
                                                                </td>                                     
                                                            </tr>                                
                                                        </tbody>
                                        </table>
                                        
                                                <nav>
                                                    <ul class="pagination">
                                                        <li class="page-item" v-if="pagination.current_page > 1">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                                        </li>
                                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                                        </li>
                                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                                        </li>
                                                    </ul>
                                                </nav>

                                                
                                    </div>  
                 </template>                           
            
                  
                    <template v-else-if="listado==2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Solicitante</label>
                                    <p v-text="nombre"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Documento</label>
                                    <p v-text="tipo_documento"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Nro</label>
                                    <p v-text="num_documento"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Estado civil</label>
                                    <p v-text="estado_civil"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <p v-text="edad"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Oficina Destinataria</label>
                                <p v-text="unidad_organica"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="">Responsable</label>
                                <p v-text="responsable"></p>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Numero de Expediente</label>
                                    <p v-text="codigo_expediente"></p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Asunto Tramite</label>
                                    <p v-text="asunto_tramite"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prioridad</label>
                                    <p v-text="prioridad"></p>
                                </div>
                            </div>
                               <div class="col-md-9">
                                <div class="form-group">
                                    <label>Observaciones</label>
                                    <p v-text="observaciones"></p>
                                </div>
                            </div>
                        </div>
                     
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>                                    
                                </div>
                            </div>
                    </div>
                    </template>

                </div>
         </div>                 
                      
                    
        </main>
</template>

<script>
      import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';


    export default {
        data (){
            return {
                regexpediente_id: 0,
                idexpediente:0,
                idoficina : 0,
                idsolicitante : 0,
                idexpediente : 0 ,
                solicitante:'',
                oficina:'',
                expediente:'',
                arrayRegexpediente : [],
                arraySolicitante:[],
                arrayOficina:[],
                arrayExpediente: [] ,
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorRegexpediente : 0,
                errorMostrarMsjRegexpediente : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'idsolicitante',
                buscar : ''

            }
        },
        components: {
            vSelect
        },
       
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarRegexpediente (page,buscar,criterio){
                let me=this;
                var url= '/regexpediente/selectOficinaRecursos?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                   var respuesta= response.data;
                    me.arrayRegexpediente = respuesta.regexpedientes.data;
                    me.pagination= respuesta.pagination;
                  
                })
               
                .catch(function (error) {
                    console.log(error);
                });
            },            
                    
                           
             pdfRegexpediente(id){
                  window.open('http://127.0.0.1:8000/regexpediente/pdf/'+ id + ',' + '_blank');
             },

             

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarRegexpediente(page,buscar,criterio);
            },

                verRegexpediente(id){
                let me=this;
                me.listado=2;
                
                //Obtener los datos del ingreso
                var arrayRegexpedienteT=[];
                var url= '/regexpediente/obtenerVista?id=' + id;
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayRegexpedienteT = respuesta.regexpediente;

                    me.solicitante = arrayRegexpedienteT[0]['nombre'];
                    me.tipo_documento=arrayRegexpedienteT[0]['tipo_documento'];
                    me.num_documento=arrayRegexpedienteT[0]['num_documento'];
                    me.estado_civil=arrayRegexpedienteT[0]['estado_civil'];
                    me.edad=arrayRegexpedienteT[0]['edad'];
                    me.codigo_expediente=arrayRegexpedienteT[0]['codigo_expediente'];
                    me.asunto_tramite=arrayRegexpedienteT[0]['asunto_tramite'];
                    me.prioridad=arrayRegexpedienteT[0]['prioridad'];
                    me.fecha_tramite=arrayRegexpedienteT[0]['fecha_tramite'];
                    me.unidad_organica=arrayRegexpedienteT[0]['unidad_organica'];
                    me.responsable=arrayRegexpedienteT[0]['responsable'];
                     me.observaciones=arrayRegexpedienteT[0]['observaciones'];
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },

              mostrarDetalle(){
                let me=this;
                me.listado=0;
                me.idsolicitante=0;
                me.idexpediente=0;
                me.idoficina = 0;
            },
            ocultarDetalle(){
                this.listado=1;
            },
        },
     
        
         
        
        mounted() {
             this.listarRegexpediente(1,this.buscar,this.criterio);
        }
    }

















</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
