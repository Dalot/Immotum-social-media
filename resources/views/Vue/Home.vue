<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Welcome to Immotum Instant Fans</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4" v-for="product in products">
                        <card v-bind:product="product"></card>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
     import Card from '../../js/components/partials/Card.vue';
    
        export default {
            
            data(){
                return {
                    products : [],
                    categories : []
                }
            },
            components: {
              Card  
            },
            mounted(){
                axios.get("api/products/").then(response => {
                    
                    this.products = response.data[0];
                    this.categories = response.data[1];
                    
                    });      
            }
        }
    </script>
    
    
    <style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
    </style>