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
                    <form class="form-horizontal"  @submit.prevent ="addTag">
                        <div class="card-body">
                            <h4 class="card-title p-2">
                                <strong>Add New Tag</strong>
                                <router-link to="/tag" class="btn btn-success btn-outline-success float-right">All Tag</router-link>
                            </h4>
                            <div class="border-top mb-4"></div>

                            <div class="form-group row">
                                <label for="tagName" class="col-sm-2 offset-1 text-right control-label col-form-label">Tag Name</label>
                                <div class="col-sm-8">
                                    <input v-model="form.tagName" name="tagName" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('tagName') }" id="tagName" placeholder="Tag Name Here">
                                    <has-error :form="form" field="tagName"></has-error>
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
                    tagName: ''
                })
            }
        },
        methods:{
            addTag(){
                    this.form.post('/api/tag/')
                    .then((response) => {
                        if(response.status == 200){
                            this.$router.push({name: 'tag'});
                            Toast.fire({
                                icon: 'success',
                                title: 'Tag added successfully'
                            })
                        }
                    })
                    .catch((error) =>{
                         console.log(error.response.data.errors)
                    })
            }
        }
    }
</script>