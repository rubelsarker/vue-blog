import adminHome from './components/admin/AdminHome';
//category
import indexCategory from './components/admin/category/index';
import createCategory from './components/admin/category/create';
import editCategory from './components/admin/category/edit';
export const routes = [
    //admin dashboard
    { path: '/home', component: adminHome, name:'home'},
    //category
    { path: '/category', component: indexCategory, name:'category'},
    { path: '/category-create', component: createCategory, name:'category-crate'},
    { path: '/category-edit/:id', component: editCategory, name:'category-edit'},
];