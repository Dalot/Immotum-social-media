<template>
        <div class="container">
            <flash message=""></flash>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <img :src="product.image" :alt="product.name">
                    <h3 class="title" v-html="product.title"></h3>
                    <p v-html="product.description"></p>
                    <h4>
                        <span class="small-text text-muted float-left">$ {{product.our_price}}</span>
                        <span class="small-text float-right">Available Quantity: {{product.units}}</span>
                    </h4>
                    <br>
                    <hr>
                    <label class="row"><span class="col-md-2 float-left">Quantity: </span><input type="number" name="units" min="1" :max="product.units" class="col-md-2 float-left" v-model="quantity" @change="checkUnits"></label>
                    <button type="button" class="btn btn-success" @click="addToCart">Add to Cart</button>
                    <router-link :to="{ path: '/checkout?pid='+product.id }" class="btn btn-primary btn-primary float-right">Go to cart</router-link>
                </div>
            </div>
        </div>
    </template>

    <script>
    
    import Flash from '../../js/components/Flash.vue';
                
                
    export default {
        data(){
            return {
                product : [],
                quantity : 1
                
            }
        },
        components: {
            Flash
        },
        beforeMount(){
            this.user = JSON.parse(localStorage.getItem('ImmotumInstantFans.user'));

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('ImmotumInstantFans.jwt');
            
            let url = `/api/products/${this.$route.params.id}`
            axios.get(url).then(response => {
                this.product = response.data;

                });      
        },
        
        methods:
        {
            addToCart() {
            
                let product_id = this.product["id"];
                let price = this.product["our_price"];
                let title = this.product["title"];
                let quantity = this.quantity;
                let url = `/api/cart`;
                
                axios.post(url, { product_id, price, title, quantity }).then( (response) => {
                    
                    let cartItems = response.data;
                    localStorage.setItem('ImmotumInstantFans.cart', JSON.stringify(cartItems));
                    flash('Added Product to cart.', 'success');
                
                });
            
            },
            checkUnits(e){
                if (this.quantity > this.product.units) {
                    this.quantity = this.product.units
                }
        
            }    
        }
    }
    </script>

    <style scoped>
    .small-text { font-size: 18px; }
    .title { font-size: 36px; }
    .description { white-space:pre; }
    </style>