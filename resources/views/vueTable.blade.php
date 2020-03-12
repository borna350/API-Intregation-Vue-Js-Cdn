<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editable Table</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <style>
        /*@import url('https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700');*/

        *{
            /* Fonts*/
            --work: 'Work Sans', sans-serif;

            /* Colors*/
            --h2o: #7bd4cc;
            --honey: #bea42e;
            --army: #7b895b;
            --green: #037367;
            --sangria: #00281f;
            --white: #fff;
            /* Transition */
            --transition-short: all .5s ease-in-out;

            /* padding */
            --padding-standard:1rem;
        }

        html,body{ min-height:100%; height:100%;}
        button{ cursor:pointer; }

        body{ font-family: var(--work); /* IE10+ */
            background-image: -ms-linear-gradient(bottom, #7BD4CC 0%, #037367 100%);

            /* Mozilla Firefox */
            background-image: -moz-linear-gradient(bottom, #7BD4CC 0%, #037367 100%);

            /* Opera */
            background-image: -o-linear-gradient(bottom, #7BD4CC 0%, #037367 100%);

            /* Webkit (Safari/Chrome 10) */
            background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #7BD4CC), color-stop(100, #037367));

            /* Webkit (Chrome 11+) */
            background-image: -webkit-linear-gradient(bottom, #7BD4CC 0%, #037367 100%);

            /* W3C Markup */
            background-image: linear-gradient(to top, #7BD4CC 0%, #037367 100%); display: flex; align-items: center; align-content: center;
        }
        h2, p, input, h1, h3{ font-family:  var(--work); }

        .left_panel{ padding-left:0px; padding-right:0px;}
        .left_panel header{ background-color: var(--h2o); padding:var(--padding-standard); }

        #chart_datas{ position: relative; }
        #chartpanel{ background-color:#fafafa; max-width:50rem; max-width: 50rem; height: auto; border-radius:7px;}


        .hideshow{ color: var(--white); font-size: .8rem;}
        .inputHide{ oapcity:1;  -webkit-transition: var(--transition-short);  -moz-transition: var(--transition-short);  -o-transition: var(--transition-short); transition: var(--transition-short);}
        .is-collapsed{ opacity:0;}

        .addRowBtn{width:auto; position: absolute; left: 2rem;     font-size: 2rem;    background-color: var(--honey);    padding: .1rem .9rem; border-radius: 2rem; margin-top: -4rem; z-index: 999999999999999; -webkit-box-shadow: 0px 3px 1px 0px rgba(0,0,0,0.45);
            -moz-box-shadow: 0px 3px 1px 0px rgba(0,0,0,0.45);
            box-shadow: 0px 3px 1px 0px rgba(0,0,0,0.45); cursor: pointer; opacity:1; -webkit-transition: var(--transition-short);  -moz-transition: var(--transition-short);  -o-transition: var(--transition-short); transition: var(--transition-short);}
        .addRowBtn:hover{ opacity:.8; }
        .addRowBtn .fa{color:var(--white); margin-top: 7px; }

        .single-cel{overflow: hidden; display: block; position: relative;}
        .edit_mode{ cursor:pointer; color:var(--h20); position:absolute; right:1.3rem; -webkit-transition: var(--transition-short);  -moz-transition: var(--transition-short);  -o-transition: var(--transition-short); transition: var(--transition-short); margin-right:2%}
        .edit_mode:hover{ color:#666;}
        .edit_panel{padding-left:1rem !important; padding-right:1rem; padding-top:.5rem !important;}
        .edit_panel button{color:var(--sangria);}
        .edit_panel button:hover{ opacity:.5;}

        .left_panel{ overflow:hidden; position:relative; border-radius:7px; -webkit-box-shadow: 0px 0px 20px 0px rgba(50, 50, 50, 0.57);
            -moz-box-shadow:    0px 0px 20px 0px rgba(50, 50, 50, 0.57);
            box-shadow:         0px 0px 20px 0px rgba(50, 50, 50, 0.57);}
        .left_panel header{ overflow:hidden; position:relative; color:var(--white);}
        .menu_top_icon, .right_nav .fa-heart, .right_nav .fa-link{ font-size:1.3rem; color:var(--sangria);}
        .right_nav .fa-user-circle{ font-size:1.3rem; margin-left:1rem; }
        .right_nav .fa-link{ margin-left:1rem;}
        .right_nav{float:right;}

        #chart_datas{ padding-top:1rem; margin-top: 1.5rem;}
        .input_wrp .cell{padding:0px;}
        #chart_datas input{    border-top: 0px; border-left: 0px; border-right: 0px; box-shadow: none; background-color: rgba(255,255,255,.30); border-color: var(--h2o);}

        #cart_table, #chart_datas{ padding-left: 1rem; padding-right: 1rem }
        #chart_table{padding-left:1rem; padding-right:1rem;}
        #chart_table .column{ padding:3px;}
        #chart_table .row{ margin-left:0px; margin-right:0px;}
        #chart_table .top_titles div{ text-align:center; color: var(--green); text-transform: uppercase; font-size: 75%;}
        #chart_table div.table_cell input{ border: 0px; background-color: rgba(0,0,0,.05); text-align: center; color: var(--army); font-weight: 500;}

        #chart_table div.table_cell input[type="text"]:disabled { background: rgba(0,0,0,.02); }

        .right_panel{padding-left:0px; padding-right:0px; min-height:10.8rem; border-radius:3px;}

        .right_panel header{background-color:var(--green); min-height:3rem; display:block; width:100%; border-left: 2px solid rgba(0,0,0,.2); }
    </style>
</head>
<body>

<div id="chartpanel" class="row" data-equalizer>

    <div class="column small-12 left_panel" >
        <header data-equalizer-watch>
            <i class="fa fa-bars menu_top_icon" aria-hidden="true"></i>
            <div class="right_nav">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <i class="fa fa-link" aria-hidden="true"></i>
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </div>
            <charttitle> </charttitle>
        </header>


        <div id="chart_table">
            <form id="chart_datas"  >
                <div class="grid-container">
                    <div class="grid-x grid-padding-x input_wrp">
                        <div class="small-1 cell column">
                            <label>
                                <input type="text" placeholder="id">
                            </label>
                        </div>
                        <div class="small-2 cell column">
                            <label>
                                <input type="text" placeholder="value" v-model="value" id="value" name="value">
                            </label>
                        </div>
                        <div class="small-6 cell column">
                            <label>
                                <input type="text" placeholder="Label" v-model="label" id="label" name="label">
                            </label>
                        </div>
                        <div class="small-3 cell column">
                            <label>
                                <input type="text" placeholder="Icon" v-model="icon" id="icon" name="icon">
                            </label>
                        </div>
                    </div>

                    <div class="addRowBtn" v-on:click.prevent="addRow" value=""><i class="fa fa-plus" aria-hidden="true"></i></div>
                </div>

            </form>

            <charttable v-bind:proplabels="labels"> </charttable>
        </div>
    </div>
</div>
<script>
    Vue.component('charttitle',{
        data() {
            return {
                message: 'TABLE TITLE',
                collapsed: true
            }
        },
        template:`
<div id ="chart_title">
    <label>
    <input v-model="message" placeholder="Insert the chart title" v-bind:class="[ {'is-collapsed' : collapsed }, 'inputHide' ]" type="text">
    </label>
    <h2>{{ message }} <button class="hideshow" v-on:click=" collapsed = !collapsed"><i class="fa fa-pencil" aria-hidden="true"></i></button></h2>
  </div>
`
    })

    /* Second header */

    Vue.component('chartsubtitle',{
        data() {
            return {
                message: 'Data reports',
                collapsed: true
            }
        },
        template:`
<div id ="chart_subtitle">
    <label>
    <input v-model="message" placeholder="Insert the chart title" v-bind:class="[ {'is-collapsed' : collapsed }, 'inputHide' ]" type="text">
    </label>
    <h2>{{ message }} <button class="hideshow" v-on:click=" collapsed = !collapsed"><i class="fa fa-pencil" aria-hidden="true"></i></button></h2>
  </div>
`
    })


    Vue.component('charttable',{
        props:['proplabels'],
        data() {
            return{
                disabled: true
            }
        },
        methods:{
            deleteEvent: function(index) {
                this.proplabels.splice(index, 1);
            }
        },
        template:
            `
<div id="chart_table">
        <div class="top_titles">
            <div class="small-12 medium-1 column"> id </div>
            <div class="small-12 medium-2 column"> Value </div>
            <div class="small-12 medium-6 column"> Label </div>
            <div class="small-12 medium-2 column"> icon </div>
            <div class="small-12 medium-1 column">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </div>
        </div>
    <div v-for="(val, index)al in proplabels" class="row table_cell">
        <div class="small-12 medium-1 column">
            <input type="text" v-model="val.id" disabled></input>
        </div>
        <div  class="small-12 medium-2 column single-cel">
            <input type="text" v-model="val.percentual" v-bind:disabled="disabled">
            </input>
        </div>
        <div class="small-12 medium-6 column single-cel">
            <input type="text" v-model="val.label" v-bind:disabled="disabled"> </input>
        </div>
        <div class="small-12 medium-2 column single-cel">
            <input type="text" v-model="val.icon" v-bind:disabled="disabled"> </input>
        </div>
        <div class="small-12 medium-1 column edit_panel">
            <button @click="deleteEvent(index)">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
<span class="edit_mode" @click="disabled = !disabled">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </span>
        </div>
    </div>


</div>

`
    })


    new Vue({
        el: '#chartpanel',
        data: {
            value: '',
            label: '',
            icon:'',
            labels: [ { id:0, percentual: 87, label:'Mandorle', icon:'fa-user-circle-o' } ],
            nextBarId: 1
        },
        computed: {

        },
        methods: {
            addRow: function (event) {
                lastId =  this.labels.length;
                var newRow={
                    id: this.nextBarId++,
                    percentual: this.value,
                    label: this.label ,
                    icon: this.icon
                };
                this.labels.push( newRow );
            }

        }
    });

</script>
</body>
</html>
