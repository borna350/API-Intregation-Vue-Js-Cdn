<!DOCTYPE html>
<html lang="en">
<head>
    <title>Country List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
</head>
<style>
    .active {
        background: #1d68a7;
        color: white !important;
    }
</style>
<body>
<div class="container" id="example">
    <h1 class="text-center">Country List : </h1>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="search country name" v-model="search" @keyup="searchData">
                </div>
            </div>
        <div class="col-sm-2">
            <a :href="'/show/location'" class="btn btn-primary">Get Location</a>
        </div>
        <div class="col-sm-2">
            <a :href="'/convert/zone'" class="btn btn-primary">Convert Time Zone</a>
        </div>
        <div class="col-sm-2">
            <a :href="'/api/create/country'" class="btn btn-primary">Add New</a>
        </div>
    </div>
    </div>
    <br>
    <div class="col-sm-12">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="10%" class="text-left">ID</th>
                <th width="20%" class="text-left">ISO</th>
                <th width="50%" class="text-center">Country Name</th>
                <th width="20%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody v-for="value in country.data">
            <tr>
                <td width="10%" class="text-left">@{{value.id}}</td>
                <td width="20%" class="text-left">@{{value.iso}}</td>
                <td width="50%" class="text-center">@{{value.country_name}}</td>
                <td width="20%" class="text-center"><a :href="'/api/country/edit/'+value.id" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" @click="deleteCountry(value.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12">
        <button v-if="country.current_page === 1" style="color: #4c110f" disabled>Previous</button>
        <button v-else @click="paginationPrev" style="color: #1d68a7">Previous</button>
        <button v-for="value in country.last_page" :class="(country.current_page === value) ? 'active' : ''" @click="paginationCurrent(value)" v-if="country.total>6 && (value <= 3 || value >= (country.last_page-3))" style="color: #1d68a7">
            @{{value}}
        </button>
        <button v-if="country.current_page === country.last_page" style="color: #4c110f" disabled>Next</button>
        <button v-else @click="paginationNext" style="color: #1d68a7">Next</button>
        <br>
    </div>
</div>
<script>
    const data = {a: 1};
    const vm = new Vue({
        el: '#example',
        data: {
            country: [],
            search: '',
            message: null
        },


        mounted() {
            this.showData();
        },

        methods: {

            showData() {
                fetch('/api/country', {
                    method: 'GET',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                    .then(response => response.json())
                    .then(res => {
                        // console.log(res.data)
                        this.country = res.data;
                    })
            },

            searchData() {
                fetch('/api/country?search=' + this.search, {
                    method: 'GET',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                    .then(response => response.json())
                    .then(res => {
                        // console.log(res.data)
                        this.country = res.data;
                    })
            },

            paginationNext() {
                fetch('/api/country?page=' + (this.country.current_page + 1), {
                    method: 'GET',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                    .then(response => response.json())
                    .then(res => {
                        // console.log(res.data)
                        this.country = res.data;
                    })
            },

            paginationCurrent(value) {
                fetch('/api/country?page=' + value + '&search=' + this.search, {
                    method: 'GET',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                    .then(response => response.json())
                    .then(res => {
                        // console.log(res.data)
                        this.country = res.data;
                    })
            },

            paginationPrev() {
                fetch('/api/country?page=' + (this.country.current_page - 1), {
                    method: 'GET',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                    .then(response => response.json())
                    .then(res => {
                        // console.log(res.data)
                        this.country = res.data;
                    })
            },

            deleteCountry(id) {
                alert('Are you want to delete?')
                fetch('/api/country/delete/' + id, {
                    method: 'DELETE'
                }),
                    location.reload();

            },

        }
    });
</script>
</body>
</html>
