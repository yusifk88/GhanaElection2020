<template>

    <v-card flat>

        <v-skeleton-loader v-if="progress" type="table"></v-skeleton-loader>

        <v-card-text v-else>

            <v-row>
                <v-col cols="12" sm="2">
                    <v-btn dark fab color="blue" to="/">
                        <v-icon>mdi-arrow-left</v-icon>

                    </v-btn>
                </v-col>
                <v-col cols="12" sm="10" class="text-center">
                    <h2 class="font-weight-light">CANDIDATE SUMMARY</h2>
                </v-col>

                <v-col cols="12" sm="3">
                    <v-avatar size="200">
                        <v-img :src="candidate.photo"></v-img>
                    </v-avatar>
                </v-col>

                <v-col cols="12" sm="4">
                    <v-list>
                        <v-list-item two-line>
                            <v-list-item-content>
                                <v-list-item-title><h5>{{candidate.name}}</h5></v-list-item-title>
                                <v-list-item-subtitle>Name</v-list-item-subtitle>
                            </v-list-item-content>

                        </v-list-item>
                        <v-list-item two-line>
                            <v-list-item-content>
                                <v-list-item-title>{{candidate.party.name}}({{candidate.party.acronym}})</v-list-item-title>
                                <v-list-item-subtitle>Political Party</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-avatar>
                                <img :src="candidate.party.symbol_url">
                            </v-list-item-avatar>

                        </v-list-item>
                    </v-list>
                </v-col>

                <v-col cols="12" sm="5">
                    <v-card :color="candidate.party.color">
                        <v-card-title>
                            <v-icon
                                class="mr-12 white--text"
                                size="64"
                            >
                                mdi-vote
                            </v-icon>
                            <v-row align="start">
                                <div class="caption white--text text-uppercase">
                                    {{total}}
                                </div>
                                <div>
                          <span
                              class="display-2 font-weight-black white--text"
                          >
                              {{((total/Number(candidate.valid_votes))*100).toFixed(2)}}%
                          </span>
                                </div>
                            </v-row>

                            <v-spacer></v-spacer>

                        </v-card-title>

                        <v-sheet color="transparent">
                            <v-sparkline
                                :smooth="16"
                                :line-width="3"
                                color="white"
                                :value="votes"
                                auto-draw
                                stroke-linecap="round"
                            ></v-sparkline>
                        </v-sheet>
                    </v-card>


                </v-col>


            </v-row>

            <v-row>


                <v-col cols="12" sm="4">
                    <apexchart type="pie" width="400" :options="pieoptions(candidate.party)" :series="[sum_votes(polling_stations),other_votes]"></apexchart>

                </v-col>
                <v-col cols="12" sm="8" class="mt-5">
                    <h3 class="font-weight-light">CONSTITUENCY VOTES BREAKDOWN</h3>
                        <h4>{{candidate.constituency.name}}</h4>

                        <h2 class="font-weight-bold">Votes:{{sum_votes(polling_stations) | toMoney}} </h2>
                        <h2 class="font-weight-bold">other votes: {{Number(other_votes) | toMoney}} </h2>
                </v-col>
                <v-col cols="12" sm="12">
                    <v-card flat>



                        <apexchart type="bar" height="3500" :options="make_options(polling_stations)" :series="makeSeries(polling_stations)"></apexchart>


                    </v-card>
                </v-col>

            </v-row>



        </v-card-text>


        <v-snackbar
            :timeout=8000
            color="green"
            dark
            v-model="dashboardUpdated"
            top
        >
            New results have arrived and we have updated your dashboard <v-icon>mdi-check-circle</v-icon>

        </v-snackbar>
    </v-card>



</template>

<script>
    export default {
        name: "parliamentaryCandidateCompoenet",
        data(){
            return{
                progress:true,
                stealth:false,
                candidate:null,
                other_votes:0,
                votes:[],
                party_color:'',
                total:0,
                polling_stations:[],
                dashboardUpdated:false,



            }
        },
        methods:{

            pieoptions(party){
               return  {
                    chart: {
                        type: 'pie',
                        colors: [party.color,'darkgrey'],

                    },
                    labels: ['Voted For', 'Other Votes'],

                   legend: {
                       markers: {

                           fillColors: [party.color,'darkgrey'],

                       },
                   },
                     responsive: [{
                        breakpoint: 480,
                        options: {

                            legend: {
                                position: 'bottom',
                                labels: {
                                    colors: [party.color,'darkgrey'],
                                    useSeriesColors: false
                                },
                            }
                        }
                    }],
                dataLabels: {
                    offset: 0,
                    style: {
                        colors: ['#fff'],
                        fontSize: '20px',

                    }
                    },

                  fill: {
                    colors: [party.color,'darkgrey'],
                },
                   tooltip:{
                       fillSeriesColor: true,

                   }
                };



            },
            makeSeries(polling_stations){

                let d = [];
                let b = [];

                polling_stations.forEach(station=>{
                    d.push(Number(station.votes));
                    b.push(Number(station.no_votes)/-1);

                });

                return [{
                    name:'Voted for',
                    data: d,
                    color:this.candidate.party.color
                },
                    {   name:'Other Votes',
                        data: b,
                        color: "darkgrey"

                    }

                ];
            },

            make_options(polling_stations){

                let d = [];

                polling_stations.forEach(station=>{
                    d.push(station.name);
                });


                let chartOptions= {
                    chart: {
                        type: 'bar',
                        stacked: true,
                        dropShadow: {
                            enabled: true,
                            top: 2,
                            left: 0,
                            blur: 4,
                            opacity: 0.15
                        }

                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            endingShape: 'rounded',
                            barHeight: '90%'
                        }
                    },

                    stroke: {
                        width: 2,
                        colors: ["transparent"]
                    },
                    tooltip: {
                        shared: false,
                        x: {

                            formatter: function (val) {
                                return val
                            }
                        },
                        y: {
                            formatter: function (val) {
                                return Math.abs(val);
                            }

                        }
                    },
                    xaxis: {
                        style:{
                            fontSize: '9px'
                        },
                        categories: d,
                        formatter: function (val) {
                            return Math.abs(val);
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetX: -6,
                        style: {
                            fontSize: '12px',
                            colors: ['#fff']
                        },
                        formatter: function (val) {
                            return Math.abs(val);
                        }
                    },
                };
                return chartOptions;

            },

            sum_votes(stations){
                let sum = 0;
                stations.forEach(station=>{
                    sum+=Number(station.votes);
                });

                return sum;
            },

            sum_other_votes(stations){
                let sum = 0;
                stations.forEach(station=>{
                    sum+=Number(station.votes);
                });

                return sum;
            },

            set_data(stations){

                    stations.forEach(polling_station=>{
                            this.votes.push(Number(polling_station.votes));
                            this.total+=Number(polling_station.votes);
                            this.other_votes +=Number(polling_station.no_votes);

                    });

            },
            get_candidate_results(){
                this.progress = !this.stealth;
                axios.get('/api/parlcandidateresult/'+this.$route.params.id)
                    .then(res=>{
                        this.total = 0;
                        this.votes=[];
                        this.polling_stations =[];
                        this.candidate = res.data.candidate;

                        this.party_color = this.candidate.party.color;
                        this.polling_stations = res.data.polling_stations;

                        this.set_data(res.data.polling_stations);
                        this.progress=false
                        this.dashboardUpdated = this.stealth;

                    })
                    .catch(error=>{

                    })

            },
            listenForResults(){


                window.Echo.channel('resultsPublished')
                    .listen('parliamentaryResultsPublished', (e) => {
                        if(e.message.type==='MP' && e.message.candidate_id === this.$route.params.id){

                            this.stealth = true;
                            this.get_candidate_results();
                        }
                    });


            }


        },
        mounted() {
            this.get_candidate_results();
        this.listenForResults();

        }

    }
</script>

<style scoped>

</style>
