<template>
<v-card flat>

    <v-card-title>
        <v-row>
            <v-col cols="12" sm="2">
                <v-btn dark fab color="blue" to="/">
                    <v-icon>mdi-arrow-left</v-icon>

                </v-btn>
            </v-col>
            <v-col cols="12" sm="10" class="text-center">

                <h3 class="font-weight-light">VOTER PATTERN BY  CONSTITUENCIES/POLLING STATIONS</h3>
            </v-col>
        </v-row>
    </v-card-title>
    <v-skeleton-loader v-if="progress" type="table"></v-skeleton-loader>
<v-card-text v-else>

    <v-row>
        <v-col cols="12" sm="6" v-for="constituency in constituencies" :key="constituency.id" class="border-right">
            <h2 class="font-weight-light">{{constituency.name}}</h2>
            <h3>Presidential Vote Pattern</h3>

            <apexchart type="bar" height="150" :options="get_constituency_prechartOption(constituency)" :series="get_constituency_Preseries(constituency)"></apexchart>


            <h3>Parliamentary Vote Pattern</h3>

            <apexchart type="bar" height="150" :options="get_constituency_prechartOption(constituency)" :series="get_constituency_Parseries(constituency)"></apexchart>




        </v-col>
    </v-row>


</v-card-text>

</v-card>

</template>

<script>
    import pollingstationvotepartten from "./pollingstationvotepartten";
    export default {
        name: "voterPatternComponent",
        components:{
          pollingstationvotepartten
        },
        data(){
            return{
                progress:false,
                constituencies:[],
                stealth:false,
            }
        },
        methods:{

            get_constituencies(){
                this.progress = !this.stealth;
                axios.get('/api/votepatern')
                    .then(res=>{
                        this.constituencies = res.data;
                        this.progress = false;
                    });
            },

            get_constituency_prechartOption(constituency){
                const chartOptions = {
                    chart: {
                        type: 'bar',
                            stacked: true,
                            stackType: '100%'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        },
                    },
                    grid:{
                        show:false
                    },
                    stroke: {
                        width: 1,
                            colors: ['#fff']
                    },

                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val;
                            }
                        }
                    },
                    xaxis:{
                        labels:{
                            show:false
                        }
                    },
                    yaxis:{
                        labels:{
                            show:false
                        }
                    },
                    fill: {
                        opacity: 1

                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left',
                    }
                };

                return chartOptions;


            },
            get_constituency_Preseries(constituency){

                let series = [];

                    constituency.party_results.forEach(item=>{
                        let data = {
                            name:item.acronym,
                            color:item.color,
                            data:[item.presidential_votes]
                        };
                        series.push(data);

                    });
                    return series;

            },
            get_constituency_Parseries(constituency){

                let series = [];

                    constituency.party_results.forEach(item=>{
                        let data = {
                            name:item.acronym,
                            color:item.color,
                            data:[item.parliamentary_votes]
                        };
                        series.push(data);

                    });
                    return series;

            },
            listenForResults(){


                window.Echo.channel('resultsPublished')
                    .listen('parliamentaryResultsPublished', (e) => {
                            this.stealth = true;
                        this.get_constituencies();

                    });


            }

        },
        mounted() {

            this.get_constituencies();
            this.listenForResults();

        }
    }
</script>

<style scoped>

</style>
