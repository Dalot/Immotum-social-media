<template>
  <mdb-card class="mb-5">
    
        <mdb-card-image src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%282%29.jpg" alt="Card image cap"
          waves></mdb-card-image>
          
        <mdb-card-body>
            <router-link :to="{ path: '/products/'+product.id}">
          <mdb-card-title v-html="product.title"></mdb-card-title>
          <mdb-card-text v-html="product.description"></mdb-card-text>
          
          <mdb-btn class="btn btn-sm float-right" color="primary">Buy</mdb-btn>
          </router-link>
          <label class="small-text float-left">$ {{ product.our_price}} USD</label>
        </mdb-card-body>
    
  </mdb-card>
</template>

<script>
  import { mdbCard, mdbCardImage, mdbCardBody, mdbCardTitle, mdbCardText, mdbBtn } from 'mdbvue';

  export default {
    name: 'Card',
    props: ['product'],
    components: {
      mdbCard,
      mdbCardImage,
      mdbCardBody,
      mdbCardTitle,
      mdbCardText,
      mdbBtn
    }
  };
</script>