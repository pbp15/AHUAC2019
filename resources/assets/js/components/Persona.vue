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
                        <i class="fa fa-align-justify"></i> Solicitantes
                        <button type="button" @click="abrirModal('persona','registrar')"  class="btn btn-secondary" >
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
                                    <th>Nombre</th>
                                    <th>tipo_documento</th>
                                    <th>num_documento</th>
                                    <th>direccion</th>
                                    <th> distrito</th>
                                    <th>provincia</th>
                                    <th>edad</th>
                                    <th>estado_civil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--  EN ESTE APARTADO MOSTRAREMOS LOS DATOS DE LA BD EN LA TABLA DINAMICA
                                APOYANDONOS DE LA DIRECTIVA V-FOR-->
                                <tr  v-for ="persona in arrayPersona" :key="persona.id">
                                    <td>
                                        <button type="button" @click="abrirModal('oficina','actualizar',persona)"  class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                <!-- utilizaremos v-text para mostrar los datos de la columnas siguientes -->
                                 <td v-text="persona.nombre"></td>
                                  <td v-text="persona.tipo_documento"></td>
                                  <td v-text="persona.num_documento"></td>
                                  <td v-text="persona.direccion"></td>
                                  <td v-text="persona.distrito"></td>
                                  <td v-text="persona.provincia"></td>
                                  <td v-text="persona.edad"></td>
                                  <td v-text="persona.estado_civil"></td>                                                      
                                                                      
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
            :class="{'mostrar':modal }" para que se muestre la pantalla de fondo opaca
          la directiva vaint que anexa un resultado al atributo class de html
            y diremos que el modal anexara la clase mostrar si la variable modal 
            es verdadero
  
         
         
         -->
            <div class="modal fade"  tabindex="-1"  :class="{'mostrar':modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"  v-text="tituloModal" ></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre y Apellidos</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="nombre"  class="form-control" placeholder="Nombres y Apellidos">
                                        
                                    </div>
                                </div>

                           

                             <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Documento</label>
                                    <div class="col-md-9">
                                        <select v-model="tipo_documento" class="form-control">
                                            <option value="DNI">DNI</option>
                                            <option value="RUC">RUC</option>
                                            <option value="PASS">PASS</option>
                                        </select>                                    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">num_documento</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="num_documento"  class="form-control" placeholder="Numero doc">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">direccion</label>
                                    <div class="col-md-9">
                                        <input type="text"  v-model="direccion"  class="form-control" placeholder="Nombre Direccion">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">distrito</label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="distrito"  class="form-control" placeholder="Nombre Distrito">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">provincia</label>
                                    <div class="col-md-9">
                                        <input type="text"  v-model="provincia"  class="form-control" placeholder="Nombre Provincia">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">edad </label>
                                    <div class="col-md-9">
                                        <input type="text"   v-model="edad"  class="form-control" placeholder="¿cual es tu edad?">
                                        
                                    </div>
                                </div>

                              
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Estado Civil</label>
                                    <div class="col-md-9">
                                        <select v-model="tipo_documento" class="form-control">
                                            <option value="SOLTERO">SOLTERO(A)</option>
                                            <option value="CASADO">CASADO(A)</option>
                                            <option value="DIVORCIADO">DIVORCIADO(A)</option>
                                           <option value="VIUDO">VIUDO(A)</option>
                                        </select>                                    
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button"  v-if ="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button"  v-if ="tipoAccion==2" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
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
                nombre :'',
             tipo_documento : '' ,
              num_documento: '',
                 direccion: '',
                  distrito: '',
                   provincia: '',
                    edad : '',
                     estado_civil : '',
                     arrayPersona : [],
                     modal : 0,
                     tituloModal : '',
                       tipoAccion : 0 ,
                       errorPersona : 0 ,
                       errorMostrarMsjPersona : []


            }
        },
        methods: {
            listarPersona (){
                let me = this;
                axios.get('/persona').then(function (response) { //obtener los valores del /ofcina
                    me.arrayPersona = response.data;
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });
                },

            registrarPersona(){
                 let me = this;
                axios.post('/persona/registrar',{
                    'nombre' : this.nombre ,
                    'tipo_documento' : this.tipo_documento,
                    'num_documento' : this.num_documento,
                     'direccion' : this.direccion,
                     'distrito' : this.distrito,
                     'provincia' : this.provincia,
                     'edad'  : this.edad,
                     'estado_civil' : this.estado_civil

                }).then(function (response) { //obtener los valores del /ofcina
                    me.cerrarModal();
                    me.listarPersona();
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });

            },
            validarPersona(){
                this.errorPersona= 0;
                this.errorMostrarMsjPersona=[];
            },

          cerrarModal(){
             this.modal=0;
             this.tituloModal='';
             this.nombre='';
             this.tipo_documento = 'DNI';
             this.num_documento = '';
             this.direccion = '';
             this.distrito= '';
             this.provincia = '';
             this.edad = '';
             this.estado_civil = 'SOLTERO(A)';
         },

            abrirModal(modelo,accion,data = []){
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                              this.tituloModal = 'Registrar Persona';
                              this.nombre='';
                              this.tipo_documento = 'DNI';
                              this.num_documento = '';
                              this.direccion = '';
                              this.distrito= '';
                              this.provincia = '';
                              this.edad = '';
                              this.estado_civil = 'SOLTERO(A)';
                              this.tipoAccion = 1;
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
            this.listarPersona();
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