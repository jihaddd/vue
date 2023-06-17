<template>
    <div class="container"> 
        <nav class="nav">
            
            <router-link to="/" class="nav-link active" >Book List</router-link>
            <router-link to="/create" class="nav-link" >Create Book</router-link>
          
                
        </nav>
        <router-view> </router-view>
    </div>
</template>
 
<script>
    export default {}
</script>

