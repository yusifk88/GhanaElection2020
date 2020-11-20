<template>

        <v-card flat>

            <v-skeleton-loader v-if="progress" type="card"></v-skeleton-loader>

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
                              {{((total/Number(candidate.all_votes))*100).toFixed(2)}}%
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
                    <v-col cols="12" sm="12" class="mt-5 text-center">
                        <h3 class="font-weight-light">CONSTITUENCY VOTES BREAKDWON</h3>
                    </v-col>
                    <v-col cols="12" sm="6" v-for="constituency in constituencies" :key="constituency.id">
                        <v-card outlined>
                            <v-card-title class="font-weight-bold">
                                <h4>{{constituency.name}}</h4>
                            </v-card-title>

                                <center>
                                    <h2 class="font-weight-bold">{{sum_votes(constituency.polling_stations)}}</h2>
                                    <small>Total Votes</small>
                                </center>
                                <apexchart type="bar" height="350" :options="make_options(constituency.polling_stations)" :series="makeSeries(constituency.polling_stations)"></apexchart>


                        </v-card>
                    </v-col>

                </v-row>



            </v-card-text>
        </v-card>



</template>

<script>
    export default {
        name: "presidentialCandidateComponent",
        data(){
            return{
                progress:true,
                candidate:null,
                votes:[],
                total:0,
                constituencies:[]

            }
        },
        methods:{
            makeSeries(polling_stations){

                let d = [];
                let b = [];

                polling_stations.forEach(station=>{
                    d.push(Number(station.votes));
                    b.push(Number(station.no_votes)/-1);

                });

                return [{
                    name:"Voted For",
                    data: d,
                    color:this.candidate.party.color
                },{
                    name:'Voted Against',
                    data:b,
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
                        height: 'auto',
                        stacked: true

                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        }
                    },

                    track: {
                        dropShadow: {
                            enabled: true,
                            top: 2,
                            left: 0,
                            blur: 4,
                            opacity: 0.15
                        }
                    },
                    stroke: {
                        width: 2,
                        colors: ["#fff"]
                    },

                    xaxis: {
                        categories: d,
                        formatter: function (val) {
                            return Math.abs(val);
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetX: -6,
                        style: {
                            fontSize: '14px',
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

            set_data(constittuencies){
                constittuencies.forEach(constittuency=>{

                    constittuency.polling_stations.forEach(polling_station=>{
                        if(Number(polling_station.votes)>0){
                       this.votes.push(Number(polling_station.votes));
                       this.total+=Number(polling_station.votes);
                        }

                    });

                });
            },
            get_candidate_results(){
                this.progress = true;
                axios.get('/api/presscandidateresult/'+this.$route.params.id)
                    .then(res=>{
                        this.candidate = res.data.candidate;
                        this.constituencies = res.data.constituencies;
                        this.set_data(res.data.constituencies);
                        this.progress=false

                    })
                    .catch(error=>{

                    })

            }

        },
        mounted() {
            this.get_candidate_results();


        }
    }
</script>

<style scoped>

</style>
