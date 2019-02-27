<template>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <img :src="product.image" :alt="product.name">
                    <h3 class="title" v-html="product.title"></h3>
                    <p v-html="product.description"></p>
                    <h4>
                        <span class="small-text text-muted float-left">$ {{product.price}}</span>
                        <span class="small-text float-right">Available Quantity: {{product.units}}</span>
                    </h4>
                    <br>
                    <hr>
                    <label class="row"><span class="col-md-2 float-left">Quantity: </span><input type="number" name="units" min="1" :max="product.units" class="col-md-2 float-left" v-model="quantity" @change="checkUnits"></label>

                    <router-link :to="{ path: '/checkout?pid='+product.id }" class="col-md-4 btn btn-sm btn-primary float-right" @click.native="addToCart">Add to cart</router-link>
                </div>
            </div>
        </div>
    </template>

    <script>
    
  
                
                
    export default {
        data(){
            return {
                product : [],
                quantity : 1
                
            }
        },
        beforeMount(){
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
                let title = this.product["title"]
                let quantity = this.quantity;
                let url = `/api/cart`;
                
                axios.post(url, { product_id, price, title, quantity });
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