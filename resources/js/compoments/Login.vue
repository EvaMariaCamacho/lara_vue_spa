<template>
    <form v-on:submit.prevent="login()">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="user.email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group pb-5">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" v-model="user.password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email: '',
                password: '',
                remember: false
            }
        }
    },
    methods: {
        login() {
            axios.post('/api/login', this.user).then((response) => {
                localStorage.username = response.data.user.name
                localStorage.token = response.data.token
                this.$router.push({name: "mostrarBlogs"})
            });   
        }
    }
}
</script>