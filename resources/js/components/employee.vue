<template>
    <div>
        <h3 class="text-center">Add employee</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addemployee">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="employee.name">
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="text" class="form-control" v-model="employee.email">
                    </div>

                    <div class="form-group">
                        <label>password</label>
                        <input type="password" class="form-control" v-model="employee.password">
                    </div>

                    
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                employee: {}
            }
        },
        methods: {
           
            addemployee() {
                
               
                this.axios
                    .post('http://localhost:8000/api/register/emloyee', this.employee)
                    .then(response => (
                        this.$router.push({ name: 'home' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>