<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">  
                        <li class="nav-item" v-if="!isAuthenticated">
                            <router-link exact-active-class="active" to="/login" class="nav-link">Login</router-link>
                        </li>
                    <template v-else>
                
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/" class="nav-link active" aria-current="page">Inicio</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/contacto" class="nav-link">Contacto</router-link>
                        </li>
                        <li class="nav-item" v-on:click="logout">
                            <a class="nav-link" href="#">Logout</a>
                         </li>
                    </template>
        
                    </ul>
                        <span class="navbar-text">{{ username }}</span>
                </div> 
            </div>  
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>
 
<script>
export default {
    data() {
        return {
            isAuthenticated: false,
            username: ''
        }
    },
    watch: {
        $route() {
            //Token
            if (localStorage.getItem('token'))
                this.isAuthenticated = true
            else {
                this.isAuthenticated = false
                this.$router.push({name: 'login'})
            }
         
            if (localStorage.getItem('username'))
                this.username = localStorage.getItem('username')
            else
                this.username = ''
        }
    },
    methods: {
        logout() {
            axios.defaults.headers.common = {
                Authorization: "Bearer " + localStorage.getItem("token")
            };
            axios.post('/api/logout').then(() => {
                localStorage.removeItem('token')
                localStorage.removeItem('username')
                this.$router.push({name: 'login'})
            });
        }
    }
}
</script>