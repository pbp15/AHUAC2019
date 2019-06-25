<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Expedientes
                        <button type="button" @click="abrirModal('expediente','registrar')" class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <button type="button" @click="cargarPdf()" class="btn btn-info" >
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="codigo_expediente">Codigo Doc</option>
                                      <option value="asunto_tramite">Asunto</option>
                                      <option value="tipo_documento">Tipo Doc</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarExpediente(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarExpediente(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                 
                                    <th>Codigo</th>
                                    <th>Tipo documento</th>
                                    <th>Cabecera Documento</th>
                                    <th>Asunto Tramite</th>
                                    <th>Nro folio</th>
                                     <th>Prioridad</th>
                                    <th>Fecha</th>
                                    <th>Observaciones</th> 
                                     <th>Opciones</th>                                   
                                    
                                </tr>
                            </thead>
                            <!-- EN ESTE APARTADO MOSTRATREMOS LA BASE DE DATOS EN EL SIGUIENTE TABLA DINAMICA
                            DONDE NOS APOYAREMOS DE V-FOR PARA EMPEZAR -->
                            <tbody >
                                <tr v-for="expediente in arrayExpediente" :key="expediente.id">
                                    
                            <!-- v-text `para mostrar las columna de los datos de la tabla dinamica -->
                                    <td v-text="expediente.codigo_expediente"></td>
                                    <td v-text="expediente.tipo_documento"></td>
                                    <td v-text="expediente.cabecera_documento"></td>
                                    <td v-text="expediente.asunto_tramite"></td>
                                    <td v-text="expediente.nro_folio"></td>
                                    <td v-text="expediente.prioridad"></td>
                                    <td v-text="expediente.fecha"></td>
                                    <td v-text="expediente.observaciones"></td>
                                    <td>
                                        <button type="button"  @click="abrirModal('expediente','actualizar',expediente)"  class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                     
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
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar
            :class="{'mostrar':modal }"  para que semuestre la pantalla opaca
            ,la directiva vaint que anexa un resultado al atributo class de html
            y diremos que el modal anexara la clase mostrar si la variable modal 
            es verdadero
            -->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar':modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"  v-text="tituloModal" ></h4>
                            <button type="button" class="close"  @click="cerrarModal()"  aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                     </div>
                

                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">codigo_expediente</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="codigo_expediente" class="form-control" >
                                        
                                    </div>
                                </div>

                           <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Doc Expediente</label>
                                    <div class="col-md-9">
                                        <select v-model="tipo_documento" class="form-control">
                                            <option value="SOLICITUD">SOLICITUD</option>
                                            <option value="INVITACION">INVITACION</option>
                                            <option value="PERMISO">PERMISO</option>
                                        </select>                                    
                                    </div>
                          </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">cabecera_documento</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="cabecera_documento"  class="form-control" placeholder="Nombre de cabecera">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">asunto_tramite</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model=" asunto_tramite"  class="form-control" placeholder="Nombre de asunto">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">nro_folio</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="nro_folio"  class="form-control" placeholder="Numero Folios">
                                        
                                    </div>
                                </div>

                                
                             <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Prioridad</label>
                                    <div class="col-md-9">
                                        <select v-model="prioridad" class="form-control">
                                            <option value="Urgente">Urgente</option>
                                            <option value="Aplazable">Aplazable</option>
                                        </select>                                    
                                    </div>
                                </div>
                               
                             <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Observaciones</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="observaciones"  class="form-control" placeholder="Coloca las observaciones">
                                        
                                    </div>
                                </div>

                           <div v-show="errorExpediente" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjExpediente" :key="error" v-text="error">

                                        </div>

                                        </div>
                                </div>


                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                           <button type="button"  v-if ="tipoAccion==1" class="btn btn-primary" @click="registrarExpediente()">Guardar</button>
                            <button type="button"  v-if ="tipoAccion==2" class="btn btn-primary" @click="actualizarExpediente()">Actualizar</button>
                        </div>

                    </div>
                   
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
        </main>
</template>

<script>

    export default {
        data() {
            return{
                expediente_id : 0,
                codigo_expediente :'',
             tipo_documento : '' ,
              cabecera_documento: '',
                 asunto_tramite: '',
                  nro_folio: '',
                   prioridad: '',
                    fecha: '',
                     observaciones: '',
                     arrayExpediente : [],
                     modal: 0 ,
                     tituloModal : '',
                     tipoAccion : 0 ,
                     errorExpediente : 0 ,
                     errorMostrarMsjExpediente : [],
                    pagination : {

                  'total' : 0,   //total de registros
                  'current_page' :  0, //pagina actual
                  'per_page' : 0,  //numero de registros por pagina
                  'last_page' : 0,  //la ultima pagina
                  'from' : 0, // desde la pagina
                  'to' : 0, //hasta la pagina
              },
              offset : 3,
               criterio : 'codigo_expediente',
              buscar:''

           }
        },

         computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula el numero de los elementos de la paginación
            pagesNumber: function() {
                //si la pagina es diferente de to(ultimo elemento de la pagina) 
                //voy a returnar una array vacio
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
        methods: {
            listarExpediente (page,buscar,criterio){
                let me = this;
                var url ='/expediente?page=' + page  + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) { //obtener los valores del /ofcina
                var respuesta = response.data;
                me.arrayExpediente = respuesta.expedientes.data;
                me.pagination= respuesta.pagination;
                })
                 .catch(function(error){ // si tenemos un error lo tapamos con un catch
                 console.log(error);
                    });
                },

            cambiarPagina(page,buscar,criterio){
                 let me = this;
                 //actualiza la pagina actula
                 me.pagination.current_page = page;
                 me.listarExpediente(page,buscar,criterio);
            },

            cargarPdf(){
                window.open('http://127.0.0.1:8000/expediente/listarPdf','_blank');

            },
                
            registrarExpediente(){

                  if (this.validarExpediente()){
                 return;
             }



                let me = this;
                axios.post('/expediente/registrar',{
                    'codigo_expediente' : this.codigo_expediente,
                    'tipo_documento' : this.tipo_documento,
                    'cabecera_documento' : this.cabecera_documento,
                    'asunto_tramite' : this.asunto_tramite,
                    'nro_folio' :  this.nro_folio,
                    'prioridad' : this.prioridad,
                    'observaciones' : this.observaciones

                }).then(function (response) { //obtener los valores del /ofcina
                     me.cerrarModal();
                     me.listarExpediente(1,'','codigo_expediente');
                })
                 .catch(function(error){ // si tenemos un error lo tapamos con un catch
                 console.log(error);
                    });

            },
            actualizarExpediente(){

                
                  if (this.validarExpediente()){
                 return;
             }



                let me = this;
                axios.put('/expediente/actualizar',{
                    'codigo_expediente' : this.codigo_expediente,
                    'tipo_documento' : this.tipo_documento,
                    'cabecera_documento' : this.cabecera_documento,
                    'asunto_tramite' : this.asunto_tramite,
                    'nro_folio' :  this.nro_folio,
                    'prioridad' : this.prioridad,                    
                    'observaciones' : this.observaciones,
                    'id' : this.expediente_id

                }).then(function (response) { //obtener los valores del /ofcina
                     me.cerrarModal();
                     me.listarExpediente(1,'','codigo_expediente');
                })
                 .catch(function(error){ // si tenemos un error lo tapamos con un catch
                 console.log(error);
                    });



            },

            validarExpediente(){
                this.errorExpediente=0;
                this.errorMostrarMsjExpediente = [];
                 
                if(!this.codigo_expediente) this.errorMostrarMsjExpediente.push("El Codigo  no puede estar vacio");
                if(!this.tipo_documento) this.errorMostrarMsjExpediente.push("El Tipo de Documento no puede estar vacio");
                if(!this.asunto_tramite) this.errorMostrarMsjExpediente.push("El Asunto de Tramite no puede estar vacio");
                if(!this.nro_folio) this.errorMostrarMsjExpediente.push("El numero de folios no puede estar vacio");
                if(!this.prioridad) this.errorMostrarMsjExpediente.push("La prioridad no puede estar vacio");
                        
                if(this.errorMostrarMsjExpediente.length) this.errorExpediente = 1;

                return this.errorExpediente; 

                },
            cerrarModal(){
             this.modal=0;
             this.tituloModal='';
             this.codigo_expediente='MDA00000001';
             this.tipo_documento = 'SOLICITUD';
             this.cabecera_documento = '';
              this.asunto_tramite = '';
               this.nro_folio= '';
               this.prioridad = 'Urgente';
               this.fecha = '';
               this.errorExpediente=0;
         },
            

            abrirModal(modelo, accion , data =[]){
                switch(modelo){
                    case "expediente":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                             this.modal = 1;
                              this.tituloModal = 'Registrar Expediente';
                              this.codigo_expediente='MDA00000001';
                              this.tipo_documento = 'SOLICITUD';
                              this.cabecera_documento = '';
                              this.asunto_tramite = '';
                              this.nro_folio= '';
                              this.prioridad = 'Urgente';
                              this.observaciones = '';
                              this.tipoAccion= 1;
                              break;

                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                              this.tituloModal = 'Actualizar Expediente';
                                  this.tipoAccion= 2;
                                  this.expediente_id= data['id'];
                                 this.codigo_expediente=data['codigo_expediente'];
                              this.tipo_documento = data['tipo_documento'];
                              this.cabecera_documento = data['cabecera_documento'];
                              this.asunto_tramite = data['asunto_tramite'];
                              this.nro_folio= data['nro_folio'];
                              this.prioridad = data['prioridad'];
                              this.observaciones = data['observaciones'];
                              break;


                            }


                            

                        }
                    }
                }
            }
            
        },
        mounted() {
            this.listarExpediente(1,this.buscar,this.criterio);
        }
    }
</script>


<style>

        .modal-content {
            width : 100% !important;
            position :absolute !important;
            }
        .mostrar {
            display: list-item !important;
            opacity: 1 !important;
            position: absolute !important;
            background-color: #3c29297a !important;
          }   
        
        .div-error{
            display:flex;
            justify-content:center;


         }
        .text-error{
            color: red !important;
            font-weight: bold;
        }
  
</style>