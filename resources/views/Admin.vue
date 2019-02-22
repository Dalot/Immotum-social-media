<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Admin Dashboard</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <ul style="list-style-type:none">
                            <li class="active"><button class="btn" @click="setComponent('main')">Dashboard</button></li>
                            <li><button class="btn" @click="setComponent('orders')">Orders</button></li>
                            <li><button class="btn" @click="setComponent('products')">Products</button></li>
                            <li><button class="btn" @click="setComponent('users')">Users</button></li>
                            <li><button class="btn" @click="setComponent('fetch')">Fetch</button></li>
                            
                            
                           
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <component :is="activeComponent"></component>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    import Main from '../js/components/Admin/Main'
    import Users from '../js/components/Admin/Users'
    import Products from '../js/components/Admin/Products'
    import Orders from '../js/components/Admin/Orders'
    import Fetch from '../views/Fetch'

    export default {
        data() {
            return {
                user: null,
                activeComponent: null
            }
        },
        components: {
            Main, Users, Products, Orders
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('ImmotumInstantFans.  d fuser'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('ImmotumInstantFans.jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name: 'admin-pages', params: {page: 'orders'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name: 'admin-pages', params: {page: 'products'}})
                        break;
                    case "fetch":
                        this.activeComponent = Fetch
                        this.$router.push({name: 'fetch', params: {page: 'api/fetch'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            },
            
        }
    }
    </script>

    <style scoped>
    .hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
    .title { font-size: 60px; color: #ffffff; }
    </style>