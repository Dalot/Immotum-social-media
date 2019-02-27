<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Fetch new data?</div>

                    <div class="card-body">
                        You need to turn nodejs server on. <br>
                        
                        If nodejs server is on, you can refresh this page.<br>
                        
                        Be patient, it takes a minute!<br>
                        
                    </div>
                   
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
       
        
    }
</script>
