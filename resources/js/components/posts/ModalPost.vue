<template>
    <div>
            <div class="relative w-auto my-6 mx-auto max-w-sm">
                <!--content-->
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            {{titleLabel}}
                        </h3>
                        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" >
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Título
                            </label>
                            <input v-model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Título">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Descripción
                            </label>
                            <input v-model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" placeholder="Descripción">
                        </div>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                        <button @click="closeModal()" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                            Cerrar
                        </button>
                        <button class="text-green-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" @click="createUpdatePost()">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
export default{
    props:{
        post:{
            type:Object,
            default: null
        }
    },
    data(){
        return {
            titleLabel: 'Crear Usuario',
            title:'',
            description:'',
        }
    },
    methods:{
        createUpdatePost(){
            let url = "/api/storePost"
            if(this.post){
                url = "/api/updatePost/" + this.post.id
            }
            axios.post(url,{
                title:this.title,
                description:this.description
            }).then(response=>{
                this.closeModal()
                this.$emit('getPostList');
            })
        },
        closeModal(){
            this.$emit('closeModal');
        }

    },
    watch:{
        post:{
            handler:function(value){
                this.title = value ? value.title : '';
                this.description = value ? value.description : ''
                this.titleLabel = value ? 'Editar Usuario' : 'Crear Usuario'
                console.log(value)
            },
            immediate:true
        }
    }
}
</script>
