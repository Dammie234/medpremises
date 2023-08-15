<template>
    <div>
    
    </div>
</template>

<script>
export default {
    name: 'logout',
    created(){
        this.login()
    },
    data() {
        return {
            
            token: ''
        }
    },
    methods: {
        login(){
            this.token = User.token()
            axios.get('/api/user-logout/' + this.id)
            .then()
            .catch()
            localStorage.removeItem('token')
            Toast.fire({
                icon: 'success',
                title: 'Logout successfully'
            })
            this.$router.push({
                name: 'staff-login'
            })
            // document.location.href = "/sign-in"
        },
        
    }
}
</script>

<style scoped>

</style>
