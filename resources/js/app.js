import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import App from '../views/Vue/App';
import Home from '../views/Vue/Home';
import Login from '../views/Vue/Login';
import Register from '../views/Vue/Register';
import SingleProduct from '../views/Vue/SingleProduct';
import Checkout from '../views/Vue/Checkout';
import Confirmation from '../views/Vue/Confirmation';
import UserBoard from '../views/Vue/UserBoard';
import Admin from '../views/Vue/Admin';
import Fetch from '../views/Vue/Fetch';

window.events = new Vue();
window.flash = function(message) {
    window.events.$emit('flash',message);
};

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/products/:id',
            name: 'single-products',
            component: SingleProduct
        },
        {
            path: '/confirmation',
            name: 'confirmation',
            component: Confirmation
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout,
            props: (route) => ({ pid: route.query.pid })
        },
        {
            path: '/dashboard',
            name: 'userboard',
            component: UserBoard,
            meta: {
                requiresAuth: true,
                is_user: true
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        },
        {
            path: '/api/fetch',
            name: 'fetch',
            component: Fetch,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        },

    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        
        if (localStorage.getItem('ImmotumInstantFans.jwt') == null) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            });
        } else {
            let user = JSON.parse(localStorage.getItem('ImmotumInstantFans.user'))
            if (to.matched.some(record => record.meta.is_admin)) {
                if (user.is_admin == 1) {
                    next();
                }
                else {
                    next({ name: 'userboard' });
                }
            }
            else if (to.matched.some(record => record.meta.is_user)) {
                if (user.is_admin == 0) {
                    next();
                }
                else {
                    next({ name: 'admin' });
                }
            }
            next();
        }
    } else {
        next();
    }
});



const app = new Vue({
    
    
        el: '#app',
        components: { App },
        router,
        data: function() {
      return {}
    }
        
});