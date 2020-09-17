<template>
    <span>
        <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
        </div>

        <div class="container-fluid mt-1">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0 float-left">All Posts</h5>
                                <router-link to="/post-create" class="btn btn-success btn-outline-success float-right">Add New</router-link>
                            </div>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Title</th>
                                      <th scope="col">User</th>
                                      <th scope="col">Category</th>
                                      <th scope="col">Tag</th>
                                      <th scope="col">Description</th>
                                      <th scope="col">Image</th>
                                      <th scope="col">Views</th>
                                      <th scope="col">Date</th>
                                      <th scope="col" class="text-center">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr v-for="(post,index) in getAllPost" :key="post.id">
                                      <td scope="row">{{index + 1}}</td>
                                      <td scope="row">{{post.title |shortLength(40,'...')}}</td>
                                      <td scope="row" v-if="post.user">{{post.user.name}}</td>
                                      <td v-else></td>
                                      <td scope="row" v-if="post.categories">
                                          <span class="badge badge-success m-1" v-for="category in post.categories">{{category.categoryName}}</span>
                                      </td>
                                      <td v-else></td>
                                      <td scope="row" v-if="post.tags">
                                          <span class="badge badge-success m-1"  v-for="tag in post.tags">{{tag.tagName}}</span>
                                      </td>
                                      <td v-else></td>
                                      <td scope="row">{{post.body |shortLength(80,'...')}}</td>
                                      <td><img :src="post.postImage" height="45" width="45" alt="Icon"></td>
                                      <td>{{post.views}}</td>
                                      <td>{{post.created_at | timeformat}}</td>
                                      <td class="text-center">
                                        <router-link :to="{name: 'post-show', params:{id: post.id}}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'post-edit', params:{id: post.id}}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></router-link>
                                        <a @click.prevent="deletePost(post.id)" class="btn btn-sm btn-danger text-white"><i class="fas fa-trash"></i></a>
                                      </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </span>
</template>
<script>
    export default {
        computed:{
            getAllPost(){
                return this.$store.getters.getPost;
            }
        },
        mounted(){
            this.$store.dispatch('allPost')
        },
        methods:{
            deletePost(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/post/'+id)
                            .then((response) =>{
                                if(response.status == 200){
                                    this.$store.dispatch('allPost')
                                }

                            })
                            .catch(() => {
                                this.$route.push({name:'post'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Post has been deleted.',
                            'success'
                        )
                    }
                })
            }
        }
    }
</script>