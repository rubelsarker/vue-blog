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
                            <div class="card-body">
                                <h5 class="card-title m-b-0 float-left">All Categories</h5>
                                <router-link to="/category-create" class="btn btn-success btn-outline-success float-right">Add New</router-link>
                            </div>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Icon</th>
                                      <th scope="col">Date</th>
                                      <th scope="col" class="text-center">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr v-for="(category,index) in getAllCategory" :key="category.id">
                                      <th scope="row">{{index + 1}}</th>
                                      <td>{{category.categoryName}}</td>
                                      <td><img :src="category.categoryImage" height="45" width="45" alt="Icon"></td>
                                      <td>{{category.created_at | timeformat}}</td>
                                      <td class="text-center">
                                        <a class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger text-white"><i class="fas fa-trash"></i></a>
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
            getAllCategory(){
                return this.$store.getters.getCategory;
            }
        },
        mounted(){
            this.$store.dispatch('allCategory')
        }
    }
</script>