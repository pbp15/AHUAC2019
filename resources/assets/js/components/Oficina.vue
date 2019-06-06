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
                        <i class="fa fa-align-justify"></i> Oficinas
                        <button type="button" @click="abrirModal('oficina','registrar')" class="btn btn-secondary" >
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
                                    <th>Unidad Orgánica</th>
                                    <th>División</th>
                                    <th>Responsable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- v-for PARA MOSTRAR LA LISTA DE LA BASE DE DATOS EN LA TABLA -->
                                <tr v-for="oficina in arrayOficina" :key="oficina.id">
                                    <td>
                                        <button type="button" @click="abrirModal('oficina','actualizar',oficina)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" >
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                <!-- v-text para mostrar las columnas de los datos para que la tabla sea dinamica  -->
                                    <td v-text="oficina.unidad_organica"></td>
                                    <td v-text="oficina.division"></td>
                                    <td v-text="oficina.responsable"></td>                                    
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
             :class="{'mostrar':modal }" agregamos esto para que lel fondo se vea opaco
                 v-model="unidad_organica"  este v-model realiza una conexion entre el
                 input y la capa de datos(la propiedad data de nuestr codigo javascript)
                 en otras palabras aver conectado el fronent con la capa de datos

            -->
            <div class="modal fade"  tabindex="-1"  :class="{'mostrar':modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4> <!-- para que se vea el titulo de la accion  -->
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Unidad organica</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="unidad_organica" class="form-control" placeholder="Nombre de Unidad Organica">
                                      
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">División</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="division" class="form-control" placeholder="Nombre de la division">
                                      
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Responsable</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="responsable" class="form-control" placeholder="Nombre del responsable">
                                      
                                    </div>
                                </div>

                                <div v-show="errorOficina" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjOficina" :key="error" v-text="error">

                                        </div>

                                        </div>
                                </div>




                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button"  v-if ="tipoAccion==1"class="btn btn-primary" @click="registrarOficina()">Guardar</button>
                            <button type="button"  v-if ="tipoAccion==2"class="btn btn-primary">Actualizar</button>
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
                            <h4 class="modal-title">Eliminar Oficina </h4>
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
                unidad_organica :'',
                division : '' ,
                responsable: '',
                arrayOficina : [], //almacene todos los datos
                modal : 0, //esto es para ocultar o mostrar nuestra ventana modal
              tituloModal: '', //para determinar como se llamara el titulo q mostrara
              tipoAccion : 0,
              errorOficina : 0 ,
              errorMostrarMsjOficina : []

   }
        },
        methods: {
            listarOficina (){
                let me=this;
                axios.get('/oficina').then(function (response) { //obtener los valores del /ofcina
                     me.arrayOficina =  response.data;  // esto es para almacenar todo el contenido en el array
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });
                },
         registrarOficina(){

             if (this.validarOficina()){
                 return;
             }

             let me=this;
                axios.post('/oficina/registrar',{
                    'unidad_organica' : this.unidad_organica,
                    'division' : this.division,
                    'responsable' : this.responsable

                }).then(function (response) { //obtener los valores del /ofcina
                     me.cerrarModal();  // esto es para almacenar todo el contenido en el array
                     me.listarOficina();
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });

         },

         validarOficina(){
             this.errorOficina = 0;
             this.errorMostrarMsjOficina= [];
            
            if(!this.unidad_organica) this.errorMostrarMsjOficina.push("La Unidad Organica no puede estar vacio");
            if(!this.responsable) this.errorMostrarMsjOficina.push("El responsable no puede estar vacio");
            if(this.errorMostrarMsjOficina.length) this.errorOficina = 1;

            return this.errorOficina;  
         },
         cerrarModal(){
             this.modal=0;
             this.tituloModal='';
             this.unidad_organica='';
             this.division='';
             this.responsable='';

         },
         abrirModal(modelo, accion , data=[]){
             switch(modelo){
                 case "oficina":
                 {
                     switch(accion){
                         case 'registrar':
                         {
                              this.modal = 1;
                              this.tituloModal = 'Registrar Oficina';
                              this.unidad_organica='';
                              this.division = '';
                              this.responsable = '';
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
            this.listarOficina();
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

