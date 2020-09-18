import adminHome from './components/admin/AdminHome';
//category
import indexCategory from './components/admin/category/index';
import createCategory from './components/admin/category/create';
import editCategory from './components/admin/category/edit';
//tag
import indexTag from './components/admin/tag/index';
import createTag from './components/admin/tag/create';
import editTag from './components/admin/tag/edit';
//post
import indexPost from './components/admin/post/index';
import createPost from './components/admin/post/create';
import editPost from './components/admin/post/edit';
import showPost from './components/admin/post/show';
//public
import publicHome from './components/public/PublicHome';
export const routes = [
    //admin dashboard
    { path: '/home', component: adminHome, name:'home'},
    //category
    { path: '/category', component: indexCategory, name:'category'},
    { path: '/category-create', component: createCategory, name:'category-create'},
    { path: '/category-edit/:id', component: editCategory, name:'category-edit'},
    //tag
    { path: '/tag', component: indexTag, name:'tag'},
    { path: '/tag-create', component: createTag, name:'tag-create'},
    { path: '/tag-edit/:id', component: editTag, name:'tag-edit'},
    //post
    { path: '/post', component: indexPost, name:'post'},
    { path: '/post-create', component: createPost, name:'post-create'},
    { path: '/post-edit/:id', component: editPost, name:'post-edit'},
    { path: '/post-show/:id', component: showPost, name:'post-show'},
    //public
    { path: '/', component: publicHome, name:'/'},

];

