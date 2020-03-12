<!DOCTYPE html>
<html lang="en">
<head>
    <title>Convert Timezone</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
</head>
<body>

<div class="container" id="example">
    <h2>Convert Timezone Create form</h2>
    <form action="/action_page.php">
        <div class="form-group">
            <label for="email">From Time Zone:</label>
            <input type="text" class="form-control" placeholder="Asia/Dhaka" v-model="convert.from_tz">
        </div>
        <div class="form-group">
            <label for="email">Date Time:</label>
            <input type="text" class="form-control" placeholder="America/Chicago" v-model="convert.to_tz">
        </div>
        <div class="form-group">
            <label for="email">To Time Zone:</label>
            <input type="text" class="form-control" placeholder="12-03-2020" v-model="convert.datetime">
        </div>
        <button type="button" class="btn btn-default" @click="convertZone">Submit</button>
    </form>
    <div>
        <h3>Convert From :  @{{viewConvert.from_tz}}</h3>
        <h3>Convert To :  @{{viewConvert.to_tz}}</h3>
    </div>
</div>
<script>
    let data = {a: 1}
    let vm = new Vue({
        el: '#example',
        data: {
            convert: {
                from_tz: null,
                to_tz: null,
                datetime: null,
            },
            viewConvert : [],
            message: null
        },

        methods: {
            convertZone() {
                fetch('/api/convert', {
                    method: 'POST',
                    body: JSON.stringify(this.convert),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                    .then(response => response.json())
                    .then(res => {
                            this.viewConvert = res.data;
                        }
                    )
            },
        }
    })
</script>
</body>
</html>
