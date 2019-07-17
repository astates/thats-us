<template>
    <div>
        <form @submit.prevent="createItem">
            <div class="create-item-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newItemName" type="text" class="form-control col-sm-4" placeholder="Item Name" />
                <select class="form-control col-sm-4" v-model="itemCategory">
                  <option value="" selected disabled>Category</option>
                  <option  v-for="row in categories" :value="row.id" :id="row.id">{{ row.name }}</option>
                </select>
                <select class="form-control col-sm-4" v-model="itemLocation">
                  <option value="" selected disabled>Location</option>
                  <option  v-for="row in locations" :value="row.id" :id="row.id">{{ row.name }}</option>
                </select>
                <input v-model="itemPrice" type="text" class="form-control col-sm-4" placeholder="Item Price" />
                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.price }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteItem(row.id)"><i class="fa fa-times" /> Delete</button></td>
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
            items: [],
            newItemName: '',
            itemCategory: '',
            itemLocation: '',
            itemPrice: '',
            categories: [],
            locations: []
        };
    },
    mounted() {
        this.getItems();
        this.getCategories();
        this.getLocations();
    },
    methods: {
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                }).catch(console.error);
        },
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                }).catch(console.error);

        },
        getLocations() {
            return axios.get('/api/locations')
                .then(response => {
                    this.locations = response.data;
                }).catch(console.error);
        },
        createItem() {
            return axios.post('/api/items', {
                name: this.newItemName,
                category: this.itemCategory,
                location: this.itemLocation,
                price: this.itemPrice
            })
                .then(this.getItems)
                .then(() => this.newItemName = '')
                .catch(console.error);
        },
        deleteItem(id) {
            return axios.post('/api/items/' + id, {_method: 'DELETE'})
                .then(this.getItems)
                .catch(console.error);
        }
    }
}
</script>

<style>
.create-item-form {
    margin-bottom: 10px;
}
</style>
