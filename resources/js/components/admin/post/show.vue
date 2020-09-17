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
                        <div class="card-title p-4"><strong>Post Details</strong></div>
                        <div class="card-body">
                             <div class="row">
                                       <div class="col-7">
                                            <div class="comment-text w-100">
                                                <h3 class="font-medium">{{post.title}}</h3>
                                                <span class="m-b-15 d-block text-justify text-muted">{{post.body}} </span>
                                                <div class="comment-footer">
                                                    <router-link to="/post"
                                                                 class="btn btn-sm btn-info text-white">
                                                        Back
                                                    </router-link>
                                                    <router-link :to="{name: 'post-edit', params:{id: post.id}}"
                                                     class="btn btn-cyan btn-sm">Update</router-link>
                                                         <a @click.prevent="deletePost(post.id)"
                                                            class="btn btn-sm btn-danger text-white">Delete</a>

                                                </div>
                                             </div>
                                       </div>
                                       <div class="col-5">
                                            <span title="category" v-for="category in post.categories"
                                                  class="badge badge-success p-2 m-2">{{category.categoryName}}</span>
                                            <span title="tag" v-for="tag in post.tags"
                                                  class="badge badge-secondary p-2 m-2">{{tag.tagName}}</span>
                                            <img :src="post.postImage" width="200" height="200"
                                                 class="float-right img-thumbnail ">
                                             <div class="clearfix my-2"></div>
                                           <div class="text-right">
                                                <h4 class="text-muted ">{{post.created_at |timeformat}}</h4>
                                                <h4 class="text-muted ">{{userName}}</h4>
                                           </div>
                                       </div>
                                   </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>
<script>
    export default {
        data() {
            return {
                post: [],
                userName:''
            }
        },

        mounted() {
            let id = this.$route.params.id;
            axios.get('/api/post/' + id)
                .then((res) => {
                    this.post = res.data.row;
                    this.userName = res.data.row.user.name
                })
                .catch((e) => {
                    console.log(e);
                })
        },
        methods: {
            deletePost(id) {
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
                        axios.delete('/api/post/' + id)
                            .then((response) => {
                                if (response.status == 200) {
                                    this.$router.push('/post')
                                }
                            })
                            .catch(() => {
                                this.$route.push({name: 'post'})
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