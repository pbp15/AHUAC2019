    @extends('principal')
    @section('contenido')

    @if(Auth::check())
          @if(Auth::user()->idrol == 1)               
          
                <template v-if="menu==0">
                <h1>Escritorio </h1>
                </template>

                <template v-if="menu==1">
                    <oficina></oficina>
                </template>

                <template v-if="menu==2">
                    <h1>Contenido del menú 2</h1>
                </template>

                <template v-if="menu==3">
                    <expediente></expediente>
                </template>

                <template v-if="menu==4">
                    <solicitante></solicitante>
                </template>

                <template v-if="menu==5">
                    <regexpediente></regexpediente>
                </template>      

                <template v-if="menu==6">
                    <h1>Contenido del menú 6</h1>
                </template>
                <template v-if="menu==13">
                    <persona></persona>
                </template>

                <template v-if="menu==7">
                    <user></user>
                </template>

                <template v-if="menu==8">
                    <rol></rol>
                </template>

                <template v-if="menu==9">
                    <h1>Reporte Solicitantes</h1>
                </template>

                <template v-if="menu==10">
                    <consultaregistro></consultaregistro> 
                    </template>
                    
             <template v-if="menu==11">
                    <h1>Ayuda</h1>
                </template>

                <template v-if="menu==12">
                    <h1>Acerca de</h1>
                </template>
         @elseif (Auth::user()->idrol == 2)
             @include('plantilla.sidebarsecretaria')

             <template v-if="menu==0">
                <h1>Escritorio </h1>
                </template>

                <template v-if="menu==1">
                    <oficina></oficina>
                </template>

                <template v-if="menu==2">
                    <h1>Contenido del menú 2</h1>
                </template>

                <template v-if="menu==3">
                    <expediente></expediente>
                </template>

                <template v-if="menu==4">
                    <solicitante></solicitante>
                </template>

                <template v-if="menu==5">
                    <regexpediente></regexpediente>
                </template>        

                <template v-if="menu==6">
                    <h1>Contenido del menú 6</h1>
                </template>
                <template v-if="menu==13">
                    <persona></persona>
                </template>                

                <template v-if="menu==9">
                    <h1>Reporte Solicitantes</h1>
                </template>

                <template v-if="menu==10">
                <consultaregistro></consultaregistro>  
                </template>

                <template v-if="menu==11">
                    <h1>Ayuda</h1>
                </template>

                <template v-if="menu==12">
                    <h1>Acerca de</h1>
                </template>


                @elseif (Auth::user()->idrol == 3)


                    <template v-if="menu==10">
                    <consultaregistro></consultaregistro>  
                    </template>

                    <template v-if="menu==11">
                        <h1>Ayuda</h1>
                    </template>

                    <template v-if="menu==12">
                        <h1>Acerca de</h1>
                    </template>
                @else


           @endif

          @endif



    @endsection