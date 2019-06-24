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
                        <i class="fa fa-align-justify"></i> Personas
                        <button type="button" @click="abrirModal('persona','registrar')"  class="btn btn-secondary" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                       <option value="nombre">Nombre</option>
                                      <option value="num_documento">Nº Doc</option>
                                       <option value="email">Email</option>
                                    <option value="telefono">Teléfono</option>

                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click=" listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>



    

                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                 
                                    <th>Nombre</th>
                                    <th>Tipo documento</th>
                                    <th>Numero Doc</th>
                                    <th>Direccion</th>
                                    <th> Telefono</th>
                                    <th>Email</th>
                                     <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--  EN ESTE APARTADO MOSTRAREMOS LOS DATOS DE LA BD EN LA TABLA DINAMICA
                                APOYANDONOS DE LA DIRECTIVA V-FOR-->
                                <tr  v-for ="persona in arrayPersona" :key="persona.id">
                                   
                                <!-- utilizaremos v-text para mostrar los datos de la columnas siguientes -->
                                 <td v-text="persona.nombre"></td>
                                  <td v-text="persona.tipo_documento"></td>
                                  <td v-text="persona.num_documento"></td>
                                  <td v-text="persona.direccion"></td>
                                  <td v-text="persona.telefono"></td>
                                  <td v-text="persona.email"></td>       
                                     <td>
                                        <button type="button" @click="abrirModal('persona','actualizar',persona)"  class="btn btn-warning btn-sm" >
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
                                    <label class="col-md-3 form-control-label" for="email-input">Teléfono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono" class="form-control" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>             

                                                       


                                
                              <div v-show="errorPersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

                                        </div>

                                        </div>
                                </div>
                                
                            </form>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button"  v-if ="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                                <button type="button"  v-if ="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
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
                persona_id : 0,
                nombre :'',
             tipo_documento : 'DNI' ,
              num_documento: '',
                direccion: '',
                telefono : '',
                email : '',
                arrayPersona : [],
                     modal : 0,
                     tituloModal : '',
                       tipoAccion : 0 ,
                       errorPersona : 0 ,
                       errorMostrarMsjPersona : [],
                       pagination : {

                  'total' : 0,   //total de registros
                  'current_page' :  0, //pagina actual
                  'per_page' : 0,  //numero de registros por pagina
                  'last_page' : 0,  //la ultima pagina
                  'from' : 0, // desde la pagina
                  'to' : 0, //hasta la pagina
              },
              offset : 3,
               criterio : 'num_documento',
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
            listarPersona (page,buscar,criterio){
                let me = this;
                var url ='/persona?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) { //obtener los valores del /ofcina
                   var respuesta = response.data; 
                    me.arrayPersona = respuesta.personas.data;
                  me.pagination= respuesta.pagination;
               })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });
                },

            cambiarPagina(page,buscar,criterio){ //ESTE METODO RECIBE EL PARAMETRO PAGE
                let me = this;
                //actualiza la pagina actual
                me.pagination.current_page =page;
                me.listarPersona(page,buscar,criterio);
            },

            registrarPersona(){
                if (this.validarPersona()){
                                return;
                            }                           
                 let me = this;
                axios.post('/persona/registrar',{
                    'nombre' : this.nombre ,
                    'tipo_documento' : this.tipo_documento,
                    'num_documento' : this.num_documento,
                     'direccion' : this.direccion,
                     ' telefono ' : this. telefono ,
                     ' email ' : this. email 

                }).then(function (response) { //obtener los valores del /ofcina
                    me.cerrarModal();
                    me.listarPersona(1,'','num_documento');
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });

            },
            actualizarPersona(){

                if (this.validarPersona()){
                                return;
                            }


                 let me = this;
                axios.put('/persona/actualizar',{
                    'nombre' : this.nombre ,
                    'tipo_documento' : this.tipo_documento,
                    'num_documento' : this.num_documento,
                     'direccion' : this.direccion,
                     'telefono' : this.telefono,
                     'email' : this.email ,
                     'id' : this.persona_id

                }).then(function (response) { //obtener los valores del /ofcina
                    me.cerrarModal();
                    me.listarPersona(1,'','num_documento');
                })
                .catch(function(error){ // si tenemos un error lo tapamos con un catch
                console.log(error);
                    });



            },
            validarPersona(){
                this.errorPersona= 0;
                this.errorMostrarMsjPersona=[];
                
                if(!this.nombre) this.errorMostrarMsjPersona.push("El Nombre no puede estar vacio");
                if(!this.num_documento) this.errorMostrarMsjPersona.push("El Numero de Documento no puede estar vacio");
 
                        
                  if(this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;  
                },




          cerrarModal(){
             this.modal=0;
             this.tituloModal='';
             this.nombre='';
             this.tipo_documento = 'DNI';
             this.num_documento = '';
             this.direccion = '';
             this.telefono= '';
             this.email = '';
              this.errorPersona=0;

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
                              this.telefono ='';
                              this.email= '';
                              this.tipoAccion = 1;
                              break;

                            }
                            case 'actualizar':
                            {
                             this.modal=1;
                            this.tituloModal='Actualizar Persona';
                            this.tipoAccion=2;
                            this.persona_id=data['id'];
                              this.nombre= data['nombre'];
                              this.tipo_documento = data['tipo_documento'];
                              this.num_documento = data['num_documento'];
                              this.direccion = data['direccion'];
                              this.telefono= data['telefono'];
                              this.email = data['email'];
                              break;

                            }
                        }
                    }
                }
            }
            
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
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