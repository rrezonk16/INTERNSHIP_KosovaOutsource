<!-- resources/js/components/ProductsTable.vue -->
<template>
    <div>
        <h1>Products Table</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.description }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: []
        };
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await axios.get('https://dummyjson.com/products');
                this.products = response.data.products;
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }
    }
};
</script>

<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}
</style>
