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
                <div class="col-10 offset-1">
                  <div class="card">
                    <form class="form-horizontal"  @submit.prevent ="addPost" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title p-2">
                                <strong>Add New Post</strong>
                                <router-link to="/post" class="btn btn-success btn-outline-success float-right">All Post</router-link>
                            </h4>
                            <div class="border-top mb-4"></div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 offset-1 text-right control-label col-form-label">Title</label>
                                <div class="col-sm-8">
                                    <input v-model="form.title" name="title" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" id="title" placeholder="Title Here">
                                    <has-error :form="form" field="title"></has-error>
                                </div>
                             </div>
                            <div class="form-group row">
                                    <label class="col-sm-2 offset-1">Select Category</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="categories[]" multiple=""  :class="{ 'is-invalid': form.errors.has('categories[]') }" v-model="form.categories">
                                             <option disabled selected>Select Category</option>
                                             <option v-for="category in getAllCategory" :key="category.id" :value="category.id">{{category.categoryName}}</option>
                                        </select>
                                          <has-error :form="form" field="categories[]"></has-error>
                                    </div>
                            </div>
                              <div class="form-group row">
                                    <label class="col-sm-2 offset-1">Select Tag</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="tags[]" multiple=""  :class="{ 'is-invalid': form.errors.has('tags[]') }" v-model="form.tags">
                                             <option disabled selected>Select Tag</option>
                                             <option v-for="tag in getAllTag" :key="tag.id" :value="tag.id">{{tag.tagName}}</option>
                                        </select>
                                          <has-error :form="form" field="tags[]"></has-error>
                                    </div>
                            </div>
                            <div class="form-group row">
                                        <label class="col-sm-2 offset-1 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-8">
                                             <v-md-editor  :class="{ 'is-invalid': form.errors.has('categories[]') }"  name="body" v-model="form.body" height="400px"></v-md-editor>

                                            <has-error :form="form" field="body"></has-error>
                                        </div>
                                    </div>
                             <div class="form-group row">
                                    <label class="col-sm-2 offset-1 text-right">Post Image</label>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <input name="postImage" type="file" class="custom-file-input" :class="{ 'is-invalid': form.errors.has('postImage') }"  id="validatedCustomFile"  @change="onFileSelected">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <has-error :form="form" field="postImage"></has-error>
                                        </div>
                                    </div>
                                    <div>
                                        <img :src="form.postImage" height="100" width="100" alt="Upload Image">
                                    </div>
                            </div>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </span>
</template>
<script>
    export default {
        data () {
            return {
                // Create a new form instance
                form: new Form({
                    title: '',
                    postImage:'',
                    categories:[],
                    tags:[],
                    body:''
                })
            }
        },

        computed:{
            getAllCategory(){
                return this.$store.getters.getCategory;
            },
            getAllTag(){
                return this.$store.getters.getTag;
            }
        },
        mounted(){
            this.$store.dispatch('allCategory');
            this.$store.dispatch('allTag');
        },
        methods:{

            addPost(){
                    this.form.post('/api/post/')
                    .then((response) => {
                        if(response.status == 200){
                            this.$router.push({name: 'post'});
                            Toast.fire({
                                icon: 'success',
                                title: 'Post added successfully'
                            })
                        }
                    })
                    .catch((error) =>{
                         console.log(error.response.data.errors)
                    })

            },
            onFileSelected(event){
                let file = event.target.files[0];
                if(file.size > 1048770){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'File size too large!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }
                else {
                    let reader = new FileReader();
                    reader.onload = (event) =>{
                        this.form.postImage = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>