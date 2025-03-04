import Login from '../pages/Login.vue';
import Layout from '../components/Layout.vue';
import Machine from '../pages/Machine.vue';


const routes = [
    {path: '/login', name: 'login', component: Login},
    {
        path: '/',
        name: 'machines',
        component: Layout,
        children: [
            {
                path: '/',
                name: 'machines.index',
                component: Machine,
            },
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: Layout,
        children: [
            {
                path: '',
                name: 'NotFound.index',
                component: () => import('../pages/NotFound.vue')
            }
        ]
    }
];

export default routes;
