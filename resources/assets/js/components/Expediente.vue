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
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Codigo</th>
                                    <th>Tipo documento</th>
                                    <th>Cabecera Documento</th>
                                    <th>Asunto Tramite</th>
                                    <th>Nro folio</th>
                                     <th>Prioridad</th>
                                    <th>Fecha</th>
                                    <th>Observaciones</th>                                    
                                    
                                </tr>
                            </thead>
                            <!-- EN ESTE APARTADO MOSTRATREMOS LA BASE DE DATOS EN EL SIGUIENTE TABLA DINAMICA
                            DONDE NOS APOYAREMOS DE V-FOR PARA EMPEZAR -->
                            <tbody >
                                <tr v-for="expediente in arrayExpediente" :key="expediente.id">
                                    <td>
                                        <button type="button"  @click="abrirModal('expediente','actualizar',expediente)"  class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" >
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                            <!-- v-text `para mostrar las columna de los datos de la tabla dinamica -->
                                    <td v-text="expediente.codigo_expediente"></td>
                                    <td v-text="expediente.tipo_documento"></td>
                                    <td v-text="expediente.cabecera_documento"></td>
                                    <td v-text="expediente.asunto_tramite"></td>
                                    <td v-text="expediente.nro_folio"></td>
                                    <td v-text="expediente.prioridad"></td>
                                    <td v-text="expediente.fecha"></td>
                                    <td v-text="expediente.observaciones"></td>
                                 
                                </tr>
                               
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="fecha"  class="form-control" >
                                        
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Observaciones</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="observaciones"  class="form-control" placeholder="Coloca las observaciones">
                                        
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                           <button type="button"  v-if ="tipoAccion==1" class="btn btn-primary" @click="registrarExpediente()">Guardar</button>
                            <button type="button"  v-if ="tipoAccion==2" class="btn btn-primary">Actualizar</button>
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
                     errorMostrarMsjExpediente : []



            }
        },
        methods: {
            listarExpediente (){
                let me = this;
                axios.get('/expediente').then(function (response) { //obtener los valores del /ofcina
                me.arrayExpediente = response.data;
                })
                 .catch(function(error){ // si tenemos un error lo tapamos con un catch
                 console.log(error);
                    });
                },
                
            registrarExpediente(){
                let me = this;
                axios.post('/expediente/registrar',{
                    'codigo_expediente' : this.codigo_expediente,
                    'tipo_documento' : this.tipo_documento,
                    'cabecera_documento' : this.cabecera_documento,
                    'asunto_tramite' : this.asunto_tramite,
                    'nro_folio' :  this.nro_folio,
                    'prioridad' : this.prioridad,
                    'fecha' : this.fecha

                }).then(function (response) { //obtener los valores del /ofcina
                     me.cerrarModal();
                     me.listarExpediente();
                })
                 .catch(function(error){ // si tenemos un error lo tapamos con un catch
                 console.log(error);
                    });

            },

            validarExpediente(){
                this.errorExpediente=0;
                this.errorMostrarMsjExpediente = [];
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
                              this.fecha = '';
                              this.observaciones = '';
                              this.tipoAccion= 1;
                              break;

                            }
                            case 'actualizar':
                            {

                            }


                            

                        }
                    }
                }
            }
            
        },
        mounted() {
            this.listarExpediente();
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
    

   
</style>