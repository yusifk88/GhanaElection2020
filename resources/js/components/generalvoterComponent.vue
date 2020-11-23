<template>
    <div>
        <v-skeleton-loader v-if="progress" type="table" style="with:100%"></v-skeleton-loader>

        <div id="chart" v-else class="text-center">

        <h2 class="font-weight-light">TOTAL VALID VOTES CAST {{total}}</h2>
            <h4 class="font-weight-light">Presidential Results Sissala East & West</h4>

        <apexchart  type="bar" :height="$vuetify.breakpoint.mobile ? '250' : '150'" :options="chartOptions" :series="series"></apexchart>

            <h2 class="font-weight-light mt-4">
                PRESIDENTIAL CANDIDATE BREAKDOWN
            </h2>
            <v-row>
                <v-col
                    cols="12"
                    sm="4"
                    v-for="party in parties"
                    :key="party.id"
                >
                    <v-card tile :to="'presidentialcandidate/'+party.candidate.id">
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" sm="8">
                                    <apexchart
                                        type="radialBar"
                                        height="250"
                                        :options="make_opions(party)"
                                        :series="[((Number(party.votes)/Number(total))*100).toFixed(2)]"
                                    ></apexchart>

                                </v-col>
                                <v-col cols="12" sm="4">
                                    <v-avatar>
                                        <v-img :src="party.candidate.photo"/>
                                    </v-avatar><br>
                                    {{party.candidate.name}}<br>
                                    <h3 class="font-wieght-black">{{party.votes | toMoney}}</h3>
                                    Votes
                                </v-col>
                            </v-row>


                        </v-card-text>

                    </v-card>

                </v-col>
            </v-row>


    </div>


        <v-snackbar
            :timeout=8000
            color="green"
            dark
            v-model="dashboardUpdated"
            top
        >
            New results have arrived and we have updated your dashboard <v-icon>mdi-check-circle</v-icon>

        </v-snackbar>
    </div>
</template>

<script>
    export default {
        name: "generalvoterComponent",
        data(){
            return{
                parties:[],
                total:0,
                progress:true,
                stealth:false,
                dashboardUpdated:false,
                series: [
                ],
                    chartOptions: {
                    chart: {
                        type: 'bar',
                            height: 350,
                            stacked: true,
                            stackType: '100%',
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
                        },
                    },
                    stroke: {
                        width: 1,
                            colors: ['#fff']
                    },
                    title: {
                        text: ''
                    },
                    xaxis: {
                        categories: ['Votes'],
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val + "K"
                            }
                        }
                    },
                    fill: {
                        opacity: 1

                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left',
                        offsetX: 40
                    }


            }
        }
    },
        methods: {

             make_opions (party) {
               const chartOptions = {
                    chart: {
                            type: 'radialBar',
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: "60%",
                                background: this.$vuetify.theme.isDark ? "#1F1F1F":"#ffffff"
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

                                color: party.color,
                                dataLabels: {
                                name: {
                                    fontSize: '16px',
                                        color: party.color,
                                    show:true
                                },
                                value: {
                                        fontSize: '22px',
                                        color: party.color,
                                        formatter: function (val) {
                                            if (isNaN(val)){
                                                return "0%";
                                            }else{
                                                return Number(val) + "%";

                                            }
                                    }
                                }
                            }
                        }
                    },
                    fill: {
                        colors:[party.color]
                    },
                    stroke: {
                        lineCap: "round",
                        color: party.color
                    },
                    labels: [party.acronym],
                };

               return chartOptions;
            },

            set_seriese(parties){
                parties.forEach(party=>{

                    let serie = {
                        name:party.acronym,
                        data:[Number(party.votes)],
                        color:party.color

                    };
                    this.total +=Number(party.votes);

                    this.series.push(serie);

                });

            },
            get_parties(){
                this.progress = !this.stealth;
                axios.get('/api/partiesandpressresults')
                    .then(res=>{
                        this.series=[];
                        this.total=0;

                        this.set_seriese(res.data);
                        this.parties = res.data;
                        this.progress=false;
                        this.dashboardUpdated = this.stealth;


                    })
                    .catch(error=>{

                    });


            },
            listenForResults(){

                window.Echo.channel('resultsPublished')
                    .listen('parliamentaryResultsPublished', (e) => {
                        if(e.message.type==='President'){

                            this.stealth = true;
                            this.get_parties();
                        }
                    });


            }


        },
        mounted() {
            this.get_parties();

           this.listenForResults();


        }

    }
</script>

<style scoped>

</style>
