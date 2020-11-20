<template>
    <div>

        <v-skeleton-loader v-if="progress" type="paragraph" style="with:100%"></v-skeleton-loader>
        <div v-else>
        <h2 class="font-weight-light">TOTAL VALID VOTES CAST {{total}}</h2>
        <h4 class="font-weight-light">Parliamentary Results</h4>

        <apexchart  type="bar" :height="$vuetify.breakpoint.mobile ? '250' : '150'" :options="chartOptions" :series="series"></apexchart>

        <h2 class="font-weight-light mt-4">
            PARLIAMENTARY CANDIDATE BREAKDOWN
        </h2>
        <v-row>
            <v-col
                cols="12"
                sm="4"
                v-for="party in political_parties"
                :key="party.id"
            >
                <v-card tile :to="'parliamentarycandidate/'+party.candidate.id">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" sm="7">
                                <apexchart
                                    type="radialBar"
                                    height="250"
                                    :options="make_opions(party)"
                                    :series="[((Number(party.votes)/total)*100).toFixed(2)]"
                                ></apexchart>

                            </v-col>
                            <v-col cols="12" sm="5">
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
    </div>

</template>

<script>
    export default {
        name: "constituencydetailsComponent",
        props:['constituency_id'],
        data(){
            return{
                political_parties:[],
                total:0,
                progress:true,
                series: [
                ],
                chartOptions: {
                    chart: {
                        type: 'bar',
                        height: 350,
                        stacked: true,
                        stackType: '100%'
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
        methods:{

            make_opions (party) {
                const chartOptions = {
                    chart: {
                        height: '100%',
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
                                        return val + "%";
                                    }
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            shadeIntensity: 0,
                            inverseColors: [party.color],
                            gradientToColors: [party.color],
                            gradientFromColors: [party.color],
                            stops: [0]
                        },
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
                this.progress = true;
                axios.get('/api/partiesandprlresults/'+this.constituency_id)
                    .then(res=>{
                        this.progress=false;

                        this.set_seriese(res.data);
                        this.political_parties = res.data;


                    })
                    .catch(error=>{

                    });


            }

        },
        mounted(){
            this.get_parties();


        }
    }
</script>

<style scoped>

</style>
