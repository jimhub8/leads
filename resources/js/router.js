import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

import myDashboard from './components/dashboard/Dashboard'
import myUser from './components/users/'
import myRoles from './components/users/roles/Roles'
import myClients from './components/clients'
import myJobtype from './components/jobtype'
import myJob from './components/jobs'

import myReport from './components/report/Report'


const routes = [
    { path: '/', component: myDashboard },
    { path: '/users', component: myUser },
    { path: '/roles', component: myRoles },
    { path: '/clients', component: myClients },
    { path: '/jobtypes', component: myJobtype },
    { path: '/jobs', component: myJob },

    { path: '/reports', component: myReport },
]

export default new VueRouter({routes})
