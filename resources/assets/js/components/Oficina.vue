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
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="unidad_organica">Unidad Organica</option>
                                      <option value="responsable">Responsable</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarOficina(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarOficina(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                
                                    <th>Unidad Orgánica</th>
                                    <th>Responsable</th>
                                     <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- v-for PARA MOSTRAR LA LISTA DE LA BASE DE DATOS EN LA TABLA -->
                                <tr v-for="oficina in arrayOficina" :key="oficina.id">
                                  
                                <!-- v-text para mostrar las columnas de los datos para que la tabla sea dinamica  -->
                                    <td v-text="oficina.unidad_organica"></td>
                                    <td v-text="oficina.responsable"></td>  
                                    <td>
                                        <button type="button" @click="abrirModal('oficina','actualizar',oficina)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" @click="eliminarOficina(id)" class="btn btn-danger btn-sm" >
                                          <i class="icon-trash"></i>
                                        </button>
                                  
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
             :class="{'mostrar':modal }" agregamos esto para que lel fondo se vea opaco
                 v-model="unidad_organica"  este v-model realiza una conexion entre el
                 input y la capa de datos(la propiedad data de nuestr codigo javascript)
                 en otras palabras aver conectado el fronent con la capa de datos
                 MEJORAS DE TEXTO
                 <label class="col-md-3 h5 form-control-label font-weight-bold text-light bg-success text-center " for="text-input">Unidad organica</label>

            -->
            <div class="modal fade"  tabindex="-1"  :class="{'mostrar':modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-success modal-lg" role="document">
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
                                    <button type="button" class="btn btn-success btn-sm col-md-3" >                           
                                      <i class="fa fa-desktop fa-3x fa-lg" style="color:#FFFFFF;"> </i>
                                      </button>   
                                    <div class="col-md-9">
                                        <input type="text" v-model="unidad_organica" class="form-control" placeholder="Nombre de Unidad Organica">
                                      
                                    </div>
                                </div>                         


                                  <div class="form-group row">
                                    <button type="button" class="btn btn-success btn-sm col-md-3" >                           
                                      <i class="fa fa-user fa-3x fa-lg" style="color:#FFFFFF;"> </i>
                                      </button>   
                                    <div class="col-md-9">
                                        <input type="text" v-model="responsable" class="form-control" placeholder="Nombre del responsable">
                                      
                                    </div>
                                </div>

                                <div v-show="errorOficina" class="form-group row div-error  ">
                                    <div class="text-center text-error ">
                                        <div v-for="error in errorMostrarMsjOficina" :key="error" v-text="error">

                                        </div>

                                        </div>
                                </div>




                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button"  v-if ="tipoAccion==1" class="btn btn-info" @click="registrarOficina()">Guardar</button>
                            <button type="button"  v-if ="tipoAccion==2" class="btn btn-success" @click="actualizarOficina()">Actualizar</button>
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
                oficina_id: 0,
                unidad_organica :'',
                responsable: '',
                arrayOficina : [], //almacene todos los datos
                modal : 0, //esto es para ocultar o mostrar nuestra ventana modal
              tituloModal: '', //para determinar como se llamara el titulo q mostrara
              tipoAccion : 0,
              errorOficina : 0 ,
              errorMostrarMsjOficina : [],
              pagination : {

                  'total' : 0,   //total de registros
                  'current_page' :  0, //pagina actual
                  'per_page' : 0,  //numero de registros por pagina
                  'last_page' : 0,  //la ultima pagina
                  'from' : 0, // desde la pagina
                  'to' : 0, //hasta la pagina
              },
              offset : 3,
              criterio : 'unidad_organica',
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
            listarOficina (page,buscar,criterio){
                let me=this;
                var url ='/oficina?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) { //obtener los valores del /ofcina
                     var respuesta = response.data;
                     me.arrayOficina =  respuesta.oficinas.data;  // esto es para almacenar todo el contenido en el array
                     me.pagination= respuesta.pagination;
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });
                },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualiza la pagina actual
                me.pagination.current_page = page;
                me.listarOficina(page,buscar,criterio);
 
            },
         registrarOficina(){

             if (this.validarOficina()){
                 return;
             }

             let me=this;
                axios.post('/oficina/registrar',{
                    'unidad_organica' : this.unidad_organica,
                    'responsable' : this.responsable

                }).then(function (response) { //obtener los valores del /ofcina
                     me.cerrarModal();  // esto es para almacenar todo el contenido en el array
                     me.listarOficina(1,'','unidad_organica');
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });

         },
         actualizarOficina(){

             if (this.validarOficina()){
                 return;
             }

             let me=this;
                axios.put('/oficina/actualizar',{
                    'unidad_organica' : this.unidad_organica,
                    'responsable' : this.responsable,
                    'id': this.oficina_id

                }).then(function (response) { //obtener los valores del /ofcina
                     me.cerrarModal();  // esto es para almacenar todo el contenido en el array
                     me.listarOficina(1,'','unidad_organica');
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

        eliminarOficina(id){
               swal({
                title: 'Esta seguro de eliminar esta Oficina?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.destroy('/oficina/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },

         cerrarModal(){
             this.modal=0;
             this.tituloModal='';
             this.unidad_organica='';
             this.responsable='';
                this.errorOficina=0;

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
                              this.responsable = '';
                              this.tipoAccion = 1;
                              break;

                         }
                         case 'actualizar':
                         {

                            //  console.log(data);
                            //con data jalamos los datos de registrar

                            this.modal=1;
                            this.tituloModal='Actualizar Oficina';
                            this.tipoAccion=2;
                            this.oficina_id=data['id'];
                              this.unidad_organica= data['unidad_organica'];
                             this.responsable = data['responsable'];
                      
                            break;                  

                              

                            
                             

                         }
                         
                        }
                    }
                }
            }
            
        },
        mounted() {
            this.listarOficina(1,this.buscar,this.criterio);
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
         color:seagreen !important;
         font-weight: bold;


    }   

   
</style>

