export default {
    state:{
        categories:[],
        tags:[],
        posts:[],
        blogPosts:[]
    },
    getters:{
        getCategory(state){
            return state.categories;
        },
        getTag(state){
            return state.tags;
        },
        getPost(state){
            return state.posts;
        },
        getBlogPosts(state){
            return state.blogPosts;
        }
    },
    actions:{
        allCategory(context){
            axios.get('/api/category/')
                .then((response) => {
                    context.commit('categories',response.data.categories)
                })
                .catch((e) =>{
                    console.log(e)
                })
        },
        allTag(context){
            axios.get('/api/tag/')
                .then((response) => {
                    context.commit('tags',response.data.tags)
                })
                .catch((e) =>{
                    console.log(e)
                })
        },
        allPost(context){
            axios.get('/api/post/')
                .then((response) => {
                    context.commit('posts',response.data.posts)
                })
                .catch((e) =>{
                    console.log(e)
                })
        },
        blogPost(context){
            axios.get('/posts/')
                .then((response) => {
                    context.commit('blogPosts',response.data.posts)
                })
                .catch((e) =>{
                    console.log(e)
                })
        }
    },
    mutations:{
        categories(state,payload){
            return state.categories = payload
        },
        tags(state,payload){
            return state.tags = payload
        },
        posts(state,payload){
            return state.posts = payload
        },
        blogPosts(state,payload){
            return state.blogPosts = payload
        }

    }
}