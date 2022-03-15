<template >
    <div>
        <div>
            <button class="bg-green-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black "
            @click="showPostModal(null)"
            >

                <span class="material-icons">account_box</span>
            </button>
            <table class="min-w-full mt-4 table-auto">
                <thead class="justify-between">
                <tr class="bg-gray-800">
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Título</span>
                    </th>
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Descripción</span>
                    </th>
                    <th class="px-16 py-2">
                        <span class="text-gray-300">Acciones</span>
                    </th>

                </tr>
                </thead>
                <tbody class="bg-gray-200">
                <tr class="bg-white border-4 border-gray-200" v-for="(post,index) in arrayPosts" :key="index">
                    <td>
                        <span class="text-center ml-2 font-semibold">{{post.title}}</span>
                    </td>
                    <td>
                        <span class="text-center ml-2 font-semibold">{{post.description}}</span>
                    </td>
                    <td class="px-16 py-2">
                        <button class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black "
                            @click="seePost(post)"
                        >
                            <span class="material-icons">remove_red_eye</span>
                        </button>
                        <button class="bg-yellow-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black "
                                @click="showPostModal(post)"
                        >
                            <span class="material-icons">edit</span>
                        </button>
                        <button class="bg-red-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black "
                        @click="showDeleteModal(post.id)"
                        >
                            <span class="material-icons">delete</span>
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <div>
            <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
                <modal-post :post="post"
                            @closeModal="closeModal"
                            @getPostList="getPostList"
                ></modal-post>
            </div>
            <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
        </div>
    </div>
</template>
<script>
import ModalPost from "./ModalPost";
    export default {
        el:'#app',
        data(){
            return {
                arrayPosts:[],
                post:'',
                showModal:false,
            }
        },
        components:{
          ModalPost
        },
        methods:{
            getPostList(){
                axios.get('/api/postList')
                    .then(response=>{
                        this.arrayPosts = response.data
                    })
            },
            seePost(data){
                this.$swal({
                    title: data.title,
                    icon: 'info',
                    html: data.description,
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText:'Cerrar',

                });
            },
            showPostModal(data){
                  this.post = data;
                  this.showModal = true;
            },
            closeModal(){
                this.showModal = false;
            },
            showDeleteModal(id){
                this.$swal({
                    title: 'Deseas eliminar este registro?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Borrar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = '/api/destroyPost/'+id
                        axios.post(url).then(response=>{
                            this.getPostList()
                            this.$swal(
                                'Eliminado',
                                'El registro ha sido eliminado',
                                'success'
                            )
                        })

                    }
                })
            }
        },
        mounted(){
            this.getPostList();
        }
    }
</script>
<style>

</style>
