    @extends('principal')
    @section('contenido')
        <template v-if="menu==0">
        <h1>Contenido   General </h1>
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
            <persona></persona>
        </template>

        <template v-if="menu==5">
            <regexpediente></regexpediente>
        </template>

  

        <template v-if="menu==6">
            <h1>Contenido del menú 6</h1>
        </template>

        <template v-if="menu==7">
            <user></user>
        </template>

        <template v-if="menu==8">
            <rol></rol>
        </template>

        <template v-if="menu==9">
            <h1>Contenido del menú 9</h1>
        </template>

        <template v-if="menu==10">
            <h1>Contenido del menú 10</h1>
        </template>

        <template v-if="menu==11">
            <h1>Contenido del menú 11</h1>
        </template>

        <template v-if="menu==12">
            <h1>Contenido del menú 12</h1>
        </template>
        
    @endsection