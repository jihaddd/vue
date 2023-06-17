<template>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                
                <tr v-for="book in books" :key="book.id">
                    <td>{{ book.id }}</td>
                    <td>{{ book.name }}</td>
                    <td>{{ book.detail }}</td>
                    <td>
                        <router-link :to="{ name: 'edit', params: { id: book.id } }"
                            class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(book.id)">Delete</button>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>
</template>
 
<script>
export default {
    data() {
        return {
            books: [],
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/book/')
            .then(response => {
                this.books = response.data;
            });
    },
    methods: {
        deleteProduct(id) {
           
            this.axios
           
                .delete(`http://localhost:8000/api/book/${id}`)
                .then(response => {
                    let i = this.books.map(data => data.id).indexOf(id);
                    this.books.splice(i, 1)
                    
                });
        },
    }
}
</script>