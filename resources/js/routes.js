import adminHome from './components/admin/AdminHome';
//category
import indexCategory from './components/admin/category/index';
import createCategory from './components/admin/category/create';
import editCategory from './components/admin/category/edit';
//tag
import indexTag from './components/admin/tag/index';
import createTag from './components/admin/tag/create';
import editTag from './components/admin/tag/edit';
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
];