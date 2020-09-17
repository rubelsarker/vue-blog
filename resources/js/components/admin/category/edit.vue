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
                <div class="col-8 offset-2">
                  <div class="card">
                    <form class="form-horizontal"  @submit.prevent ="updateCategory" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title p-2">
                                <strong>Update Category</strong>
                                <router-link to="/category" class="btn btn-success btn-outline-success float-right">All Category</router-link>
                            </h4>
                            <div class="border-top mb-4"></div>

                            <div class="form-group row">
                                <label for="categoryName" class="col-sm-2 offset-1 text-right control-label col-form-label">Category Name</label>
                                <div class="col-sm-8">
                                    <input v-model="form.categoryName" name="categoryName" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('categoryName') }" id="categoryName" placeholder="Category Name Here">
                                    <has-error :form="form" field="categoryName"></has-error>
                                </div>
                             </div>
                             <div class="form-group row">
                                    <label class="col-sm-2 offset-1 text-right">Category Image</label>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <input name="newCategoryImage" type="file" class="custom-file-input" :class="{ 'is-invalid': form.errors.has('newCategoryImage') }"  id="validatedCustomFile"  @change="onFileSelected">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <has-error :form="form" field="newCategoryImage"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <img :src="form.newCategoryImage" height="70" width="70" alt="Upload Image" title="uploaded image">
                                        <img :src="`/`+image" height="70" width="70" alt="Upload Image" title="old image">
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
                    categoryName: '',
                    categoryImage:'',
                    newCategoryImage:''

                }),
                image: '',
            }
        },
        mounted(){
            let id = this.$route.params.id;
            axios.get('/api/category/'+id)
                .then((res)=>{
                    this.form.fill(res.data.row);
                    this.image = res.data.row.categoryImage;
                })
                .catch((e)=>{
                    console.log(e);
                })
        },
        methods:{
            updateCategory(){
                let id = this.$route.params.id;
                this.form.patch('/api/category/'+id)
                    .then((response) => {
                        if(response.status == 200){
                            this.$router.push({name: 'category'});
                            Toast.fire({
                                icon: 'success',
                                title: 'Category updated successfully'
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
                        this.form.newCategoryImage = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>