import Login from '../pages/Login.vue';
import Layout from '../components/Layout.vue';
import Machine from '../pages/Machine.vue';
import MachineForm from "../components/MachineForm.vue";
import DeleteModal from "../components/DeleteModal.vue";
import ResetTimer from "../components/ResetTimer.vue";


const routes = [
    {path: '/login', name: 'login', component: Login},
    {
        path: '/',
        name: 'machines',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: Layout,
        children: [
            {
                path: '/',
                name: 'machines.index',
                component: Machine,
            },
            // {
            //     path: 'machine/create',
            //     name: 'machine.create',
            //     component: MachineForm
            // },
            {
                path: ':machineId/edit/',
                name: 'machine.edit',
                component: MachineForm
            },
            {
                path: ':machineId/delete/',
                name: 'machine.delete',
                component: DeleteModal
            },
            {
                path: ':machineId/reset-timer/',
                name: 'machine.reset_timer',
                component: ResetTimer
            }
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('../pages/NotFound.vue')
    }
];

export default routes;
