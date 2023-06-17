import Allbook from './components/Allbook.vue';
import Createbook from './components/Createbook.vue';
import Editbook from './components/Editbook.vue';

 
export const routes = [
    {
        name: 'Allbook',
        path: '/',
        component: Allbook
    },
    {
        name: 'create',
        path: '/create',
        component: Createbook
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: Editbook
    },

    
];