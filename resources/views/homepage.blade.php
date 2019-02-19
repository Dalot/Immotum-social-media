<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vue</title>
</head>
<body>
    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    
    <div id="root">
        <input type="text" id="input" v-model="message"/>
    </div>
    
    
    <script>
        let data = 
        
        
        
        
        new Vue({
                
                el: '#root',
                data: {
                    message: 'hello world'
                }
                
            });
    </script>
    
    
</body>
</html>