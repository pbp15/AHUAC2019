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
                        <button type="button"  @click="abrirModal('regexpediente','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <!-- INICIO tabla Listado de registro de expedientes -->
                    <div class="card-body">
                            <div class="form-group row">
                                   <div class="col-md-6">
                                                <div class="input-group">
                                                    <select class="form-control col-md-3" v-model="criterio">
                                                      <option value="idpersona">Solicitante</option>
                                                     <option value="idexpediente">Expediente</option>
                                                      <option value="idoficina">Destino Doc</option>
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
                                                    
                                                        <th>Codigo</th>
                                                        <th>Solicitante</th>
                                                        <th>Destino Doc</th>
                                                        <th>Fecha-Hora</th>
                                                        <th>Estado</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="regexpediente in arrayRegexpediente" :key="regexpediente.id">
                                                       
                                                        <td v-text="regexpediente.codigo_expediente"></td>
                                                        <td v-text="regexpediente.nombre"></td>
                                                        <td v-text="regexpediente.unidad_organica"></td>
                                                        <td v-text="regexpediente.fecha_tramite"></td>
                                                        <td v-text="regexpediente.estado_tramite"></td> 
                                                        <td>
                                                            
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
                         </div>      
                 </div>      
                  
                      <!--FIN  tabla Listado de registro de expedientes -->                         
                    <!--  INICIO DESARROLLO DEL registro de expedientes -->
                        
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
                                    <label class="col-md-3 form-control-label" for="text-input">Solicitante</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idpersona">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id" v-text="persona.nombre"></option>
                                       </select>   
                                        
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Destino Documento</label>
                                    <div class="col-md-9">
                                          <select class="form-control" v-model="idoficina">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="oficina in arrayOficina" :key="oficina.id" :value="oficina.id" v-text="oficina.unidad_organica"></option>
                                                </select>  
                                        
                                    </div>
                                </div>



                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Expediente</label>
                                    <div class="col-md-9">
                                           <select class="form-control" v-model="idexpediente">
                                                    <option value="0" disabled>Seleccione</option>
                                                    <option v-for="expediente in arrayExpediente" :key="expediente.id" :value="expediente.id" v-text="expediente.codigo_expediente"></option>
                                             </select>  
                                        
                                    </div>
                                </div>                                             
                               

                                  <div v-show="errorRegexpediente" class="form-group row div-error">
                                                    <div class="text-center text-error">
                                                         <div v-for="error in errorMostrarMsjRegexpediente" :key="error" v-text="error">

                                                        </div>
                                                    </div>
                                  </div>

                                 </form>
                            </div>
                             
                    

                          <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button"  v-if ="tipoAccion==1" class="btn btn-primary" @click="registrarRegexpediente()">Guardar</button>
                             
                            </div>       
               


                    
                        </div>
             
                    <!--  FIN DESARROLLO DEL registro de expedientes -->

                </div>
            </div>
         
        </main>
</template>

<script>

    export default {
        data (){
            return {
                regexpediente_id: 0,
                idexpediente:0,
                idoficina : 0,
                idpersona : 0,
                idexpediente : 0 ,
                arrayRegexpediente : [],
                arrayPersona:[],
                arrayOficina:[],
                arrayExpediente: [] ,
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
                criterio : 'idpersona',
                buscar : ''

            }
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
                var url= '/regexpediente?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayRegexpediente = respuesta.regexpedientes.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },


                    
                    selectPersona(search,loading){
                           let me=this;
                            var url= '/persona/selectPersona?page=';
                            axios.get(url).then(function (response) {
                               // console.log(response);
                                var respuesta= response.data;
                                me.arrayPersona = respuesta.personas;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });

                    },

                    selectOficina(search,loading){
                        let me=this;
                            var url= '/oficina/selectOficina?page=';
                            axios.get(url).then(function (response) {
                                //console.log(response);
                                var respuesta= response.data;
                                me.arrayOficina = respuesta.oficinas;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },
                  

                    selectExpediente(search,loading){
                        let me=this;
                            var url= '/expediente/selectExpediente?page=';
                            axios.get(url).then(function (response) {
                                //console.log(response);
                                var respuesta= response.data;
                                me.arrayExpediente = respuesta.expedientes;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },          
     

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarRegexpediente(page,buscar,criterio);
            },

            registrarRegexpediente(){
                if (this.validarRegexpediente()){
                    return;
                }
                
                let me = this;

                axios.post('/regexpediente/registrar',{
                    'idpersona': this.idpersona,
                    'idoficina': this.idoficina,
                    'idexpediente' : this.idexpediente

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarRegexpediente(1,'','idpersona');
                }).catch(function (error) {
                    console.log(error);
                });

            },


           
            validarRegexpediente(){
                this.errorRegexpediente=0;
                this.errorMostrarMsjRegexpediente =[];
                if (!this.idpersona) this.errorMostrarMsjRegexpediente.push("Seleccione el solicitante");
                if (!this.idexpediente) this.errorMostrarMsjRegexpediente.push("Seleccione un expediente.");
                if (!this.idoficina) this.errorMostrarMsjRegexpediente.push("Seleccione el destino Documento");
                if (this.errorMostrarMsjRegexpediente.length) this.errorRegexpediente = 1;

                return this.errorRegexpediente;
            },


            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                 this.idpersona= 0;
                this.idoficina = 0;
                this.idexpediente = 0;
            },
             desactivarRegexpediente(id){
               swal({
                title: 'Esta seguro de anular este registro?',
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

                    axios.put('/regexpediente/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarRegexpediente(1,'','idpersona');
                        swal(
                        'Anulado!',
                        'El registro ha sido anulado con éxito.',
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
     
            abrirModal(modelo,accion,data = []){
                switch(modelo){
                    case "regexpediente":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                              this.tituloModal = 'Registro de Expediente General';
                              this.idpersona=0;
                              this.idoficina=0;
                              this.idexpediente=0;
                              this.tipoAccion = 1;
                              break;

                            }
                           
                        }
                    }
                }
             
            }
            
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
