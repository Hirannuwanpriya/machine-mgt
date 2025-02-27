import Login from '../pages/Login.vue';
import Machine from '../pages/Machine.vue';

const routes = [
    { path: '/login',name: 'login', component: Login },
    {
        path: '/',
        name: 'machines',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: Machine,
        children: [
            {
                path: 'create',
                name: 'machine.create',
                component: ''
            },
            {
                path: ':machineId/edit/:tab',
                name: 'machine.edit',
                component: ''
            }
        ]
    },
];

export default routes;
