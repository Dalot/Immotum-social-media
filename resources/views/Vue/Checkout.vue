<template>
        <div class="container">
            
            <div class="row" >
                <div class="col-md-8 offset-md-2">
                    <div v-for="cartItem in cartItems">
                        
                        <div class="order-box" v-for="item in cartItem">
                            <img :src="product.image" :alt="product.name">
                            <h2 class="title" v-html="item.name"></h2>
                            <p class="small-text text-muted float-left">$ {{item.price}}</p>
                            <p class="small-text text-muted float-right">Available Units: {{product.units}}</p>
                            <br>
                            <hr>
                            <label class="row"><span class="col-md-2 float-left">Quantity: </span><input type="number" name="units" min="1" :max="product.units" class="col-md-2 float-left" v-model="item.qty" @change="checkUnits"></label>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div v-if="!isLoggedIn">
                            <h2>You need to login to continue</h2>
                            <button class="col-md-4 btn btn-primary float-left" @click="login">Login</button>
                            <button class="col-md-4 btn btn-danger float-right" @click="register">Create an account</button>
                        </div>
                        <div v-if="isLoggedIn">
                            <div class="row">
                                <label for="address" class="col-md-3 col-form-label">Delivery Address</label>
                                <div class="col-md-9">
                                    <input id="address" type="text" class="form-control" v-model="address" required>
                                </div>
                            </div>
                            <br>
                            <button class="col-md-4 btn btn-sm btn-success float-right" v-if="isLoggedIn" @click="placeOrder">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <style scoped>
    .small-text { font-size: 18px; }
    .order-box { border: 1px solid #cccccc; padding: 10px 15px; }
    .title { font-size: 36px; }
    </style>
    
    
    <script>
    export default {
        props : ['pid'],
        data(){
            return {
                address : "",
                quantity : 1,
                isLoggedIn : null,
                product : []
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('ImmotumInstantFans.jwt') != null
        },
        beforeMount() {
            if (localStorage.getItem('ImmotumInstantFans.jwt') != null) {
                
                this.user = JSON.parse(localStorage.getItem('ImmotumInstantFans.user'))
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('ImmotumInstantFans.jwt')

                
            }
              let tempCartItems =  JSON.parse( localStorage.getItem('ImmotumInstantFans.cart') );
              
              this.cartItems = Object.keys(tempCartItems).map(function(key) {
                                  var ret = {};
                                  ret[key] = tempCartItems[key];
                                  return ret;
                                });
              
              console.log(this.cartItems);
            
            
            axios.get(`/api/cart`).then( (response) => {
                this.product = response.data
                console.log("Cart::contet(): " + response.data)
                });

            
        },
        methods : {
            login() {
                this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
            },
            register() {
                this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
            },
            placeOrder(e) {
                e.preventDefault()

                let address = this.address
                let product_id = this.product.id
                let quantity = this.quantity

                axios.post('api/orders/', {address, quantity, product_id})
                     .then(response => this.$router.push('/confirmation'))
            },
            checkUnits(e){
                if (this.quantity > this.product.units) {
                    this.quantity = this.product.units
                }
            }
        }
    }
    </script>