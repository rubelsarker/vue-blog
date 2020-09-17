export default {
    state:{
        categories:[]
    },
    getters:{
        getCategory(state){
            return state.categories;
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
        }
    },
    mutations:{
        categories(state,payload){
            return state.categories = payload
        }
    }
}