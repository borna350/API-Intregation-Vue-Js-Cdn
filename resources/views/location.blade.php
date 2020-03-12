<!DOCTYPE html>
<html lang="en">
<head>
    <title>Location Information : </title>
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
    <br>
    <div class="col-sm-12">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="10%" class="text-left">Client IP</th>
                <th width="20%" class="text-left">Time Zone</th>
                <th width="50%" class="text-center">UTC Date Time</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td width="10%" class="text-left">@{{location.client_ip}}</td>
                <td width="20%" class="text-left">@{{location.timezone}}</td>
                <td width="50%" class="text-center">@{{location.utc_datetime}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    const data = {a: 1};
    const vm = new Vue({
        el: '#example',
        data: {

            location : []
        },
        mounted() {
            this.showLocation();
        },

        methods: {
            showLocation() {
                fetch('/api/getLocation', {
                    method: 'get',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                    .then(response => response.json())
                    .then(res => {
                        // console.log(res.data)
                        this.location = res.data;
                    })
            },

        }
    });
</script>
</body>
</html>
