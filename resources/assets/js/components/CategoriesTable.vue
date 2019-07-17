<template>
    <div>
        <form @submit.prevent="createCategory">
            <div class="create-category-form input-group">
              <label for="checkbox">Has Parent?</label>
            </div>
            <div class="create-category-form input-group">
                <div class="col-sm-3">
                  <input v-model="newCategoryName" type="text" class="form-control col" placeholder="Category Name" />
                </div>
                <div class="form-check form-check-inline col-sm-3">
                  <input type="checkbox" id="isParent" class="form-check-input " v-model="isParent" @change="isParentToggle(this.hasParent)">
                  <label class="form-check-label" for="inlineCheckbox1">Has Parent Category?</label>
                </div>

                <div class="col-sm-4">
                  <select class="custom-select" v-if="this.hasParent" v-model="parentId">
                    <option  v-for="row in categories" :value="row.id" :id="row.id">{{ row.name }}</option>
                  </select>
                </div>
                <div class="input-group-append col-sm-1 pull-right">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in categories" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteCategory(row.id)"><i class="fa fa-times" /> Delete</button></td>
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
            hasParent: false,
            parentId: [],
            isParent: [],
            categories: [],
            newCategoryName: '',
        };
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        // Change variable to display or hide dropdown
        isParentToggle: function(e) {
              this.hasParent = !this.hasParent;
        },
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                }).catch(console.error);
        },
        createCategory() {
            return axios.post('/api/categories', {
              name: this.newCategoryName,
              parentId: this.parentId
            })
                .then(this.getCategories)
                .then(() => this.newCategoriesName = '')
                .catch(console.error);
        },
        deleteCategory(id) {
            return axios.post('/api/categories/' + id, {_method: 'DELETE'})
                .then(this.getCategories)
                .catch(console.error);
        }
    }
}
</script>

<style>
.create-category-form {
    margin-bottom: 10px;
}
</style>
