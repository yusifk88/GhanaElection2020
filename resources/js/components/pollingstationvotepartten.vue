<template>
    <apexchart type="bar" height="3500" :options="options" :series="series"></apexchart>
</template>

<script>
    export default {
        name: "pollingstationvotepartten",
        props:['constituency_id'],
        data(){
            return{
                polling_stations:[],
                series:[{
                    name: 'Marine Sprite',
                    data: [44, 55, 41, 37, 22, 43, 21]
                }, {
                    name: 'Striking Calf',
                    data: [53, 32, 33, 52, 13, 43, 32]
                }, {
                    name: 'Tank Picture',
                    data: [12, 17, 11, 9, 15, 11, 20]
                }, {
                    name: 'Bucket Slope',
                    data: [9, 7, 5, 8, 6, 9, 4]
                }, {
                    name: 'Reborn Kid',
                    data: [25, 12, 19, 32, 25, 24, 10]
                }],
                options:{}

            }
        },
        methods:{

            set_series(polling_stations){

                polling_stations.forEach(item=>{
                    let d = [];

                    item.party_results.forEach(p=>{
                        d.push(Number(p.presidential_votes));

                        let data = {
                            name:p.acronym,
                            color:p.color,
                            data:d
                        };

                        this.series.push(data);

                    });


                });
                console.log(this.series);

            },

            set_options(polling_station){

                let p =[];
                polling_station.forEach(item=>{

                    p.push(item.name);
                });

               let options = {
                plotOptions: {
                    chart: {
                        type: 'bar',
                        height: 350,
                        stacked: true,
                        stackType: '100%'
                    },
                    bar: {
                        horizontal: true,
                    },
                },
                stroke: {
                    width: 1,
                        colors: ['#fff']
                },
                title: {
                    text: '100% Stacked Bar'
                },
                xaxis: {
                    categories:p
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val
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
            };


              this.options =  options;


            },

            get_polling_station_pattern(){

                axios.get('/api/pollingstationpattern/'+this.constituency_id)
                    .then(res=>{
                        this.polling_stations = res.data;
                        this.set_options(this.polling_stations);
                        this.set_series(this.polling_stations);
                    })
            }

        },
        mounted(){

            this.get_polling_station_pattern();


        }
    }
</script>

<style scoped>

</style>
