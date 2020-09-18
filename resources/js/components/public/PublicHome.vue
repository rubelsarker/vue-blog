<template>
   <span>
       <section class="blog_categorie_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="categories_post">
                    <img :src="`/asset/public/img/blog/cat-post/cat-post-3.jpg`" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="single-blog.html">
                                <h5>Social Life</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Enjoy your social life together</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img :src="`/asset/public/img/blog/cat-post/cat-post-2.jpg`" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="single-blog.html">
                                <h5>Politics</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Be a part of politics</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img :src="`/asset/public/img/blog/cat-post/cat-post-1.jpg`" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="single-blog.html">
                                <h5>Food</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Let the food be finished</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
       <!--================Blog Categorie Area =================-->

       <!--================Blog Area =================-->
<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <article v-for="post in getblogPosts" class="row blog_item">
                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <a href="#" v-if="post.tags" v-for="tag in post.tags">
                                        <span class="m-1 tagname bg-light">{{tag.tagName}}</span>
                                    </a>
                                </div>
                                <ul class="blog_meta list">
                                    <li v-if="post.user"><a href="#">{{post.user.name}}<i class="lnr lnr-user"></i></a></li>
                                    <li><a href="#">{{post.created_at |timeformat}}<i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="#">{{post.views}} Views<i class="lnr lnr-eye"></i></a></li>
                                    <!--<li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="blog_post">
                                <img :src="post.postImage" alt="">
                                <div class="blog_details">
                                    <a href="single-blog.html">
                                        <h2>{{post.title | shortLength(80,'...')}}</h2>
                                    </a>
                                    <p>{{post.body | shortLength(200,'...')}}</p>
                                    <a href="single-blog.html" class="primary_btn">View More</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">
                                            <span class="lnr lnr-chevron-left"></span>
                                        </span>
                                </a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">01</a></li>
                            <li class="page-item active"><a href="#" class="page-link">02</a></li>
                            <li class="page-item"><a href="#" class="page-link">03</a></li>
                            <li class="page-item"><a href="#" class="page-link">04</a></li>
                            <li class="page-item"><a href="#" class="page-link">09</a></li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                        <span aria-hidden="true">
                                            <span class="lnr lnr-chevron-right"></span>
                                        </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
             <sidebar></sidebar>
        </div>
    </div>
</section>
   </span>
</template>
<script>
    import sidebar from './blog/SideBar'
    export default {
        components:{
            sidebar
        },
        computed:{
            getblogPosts(){
                return this.$store.getters.getBlogPosts;
            }
        },
        mounted(){
            this.$store.dispatch('blogPost')
        },
    }
</script>
<style>
    /*.tagname::after{*/
        /*content: ",";*/
    /*}*/
    /*.tagname:last-child::after{*/
        /*content:none;*/
    /*}*/
</style>