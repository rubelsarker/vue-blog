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
                    <form class="form-horizontal"  @submit.prevent ="addCategory" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title p-2">
                                <strong>Add New Category</strong>
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
                                            <input name="categoryImage" type="file" class="custom-file-input" :class="{ 'is-invalid': form.errors.has('categoryImage') }"  id="validatedCustomFile"  @change="onFileSelected">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <has-error :form="form" field="categoryImage"></has-error>
                                        </div>
                                    </div>
                                    <div>
                                        <img :src="form.categoryImage" height="100" width="100" alt="Upload Image">
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
                    categoryImage:''
                })
            }
        },
        methods:{
            addCategory(){
                    this.form.post('/api/category/',this.form)
                    .then((response) => {
                        if(response.status == 200){
                            console.log('okk');
                        }
                        // this.$router.push({name: 'customer'});
                        // Notification.success();

                    })
                    .catch((error) =>{
                         console.log(error.response.data.errors)
                    })

            },
            onFileSelected(event){
                let file = event.target.files[0];
                if(file.size > 1048770){
                    console.log('file size large');
                }
                else {
                    let reader = new FileReader();
                    reader.onload = (event) =>{
                        this.form.categoryImage = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>