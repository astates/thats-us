<template>
    <div>
      <form @submit.prevent="init">
          <div class="create-location-form input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">Price</span>
              </div>
              <input v-model="price" type="text" class="form-control" placeholder="Filter by Price" />
              <div class="input-group-append">
                  <button class="btn btn-primary">Filter</button>
              </div>
          </div>
      </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Location</th>
                <th>Parent Category</th>
                <th>Category</th>
                <th>Count</th>
            </thead>
            <tbody>
                <tr v-for="row in items" :key="row.id">
                    <td>{{ row.location.name}}</td>
                    <td v-if="row.category.parent_id">{{ parentName[row.category.parent_id] }}</td>
                    <td v-else></td>
                    <td>{{ row.category.name }}</td>
                    <td>{{  }}</td>
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
            price: "",
            categories: [],
            parentName: []
        };
    },
    mounted() {
        this.init();
    },
    methods: {
        init: function() {
            if(this.price)
            {
              this.getPricing();
            }else{
              this.getItems();
              this.getCategories();
            }
        },
        getParentNames: function() {
            this.categories.forEach((category) => {
                this.parentName[category.id] = category.name;
            });
        },
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                    this.getParentNames();
                }).catch(console.error);
        },
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                }).catch(console.error);
        },
        // Couldnt get this working properly :(
        getPricing() {
            let price = this.price;
            this.getItems();
            this.items.forEach((item) => {
              if(item.price < this.price)
              {

              }
            });

        }
    }
}
</script>

<style>
.create-report-form {
    margin-bottom: 10px;
}
</style>
