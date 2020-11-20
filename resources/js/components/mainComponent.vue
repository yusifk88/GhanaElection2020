<template>
    <div>
        <v-skeleton-loader type="card" v-if="progress"></v-skeleton-loader>
    <v-card flat v-else>
        <div class="text-center justify-center">
           Made with <code class="mr-2 ml-2">Code</code> by &nbsp;&nbsp; <a href="https://twitter.com/oryusif"> Yusif Katulie</a>

        <v-switch
            v-model="$vuetify.theme.isDark"
            :label="$vuetify.theme.isDark ? 'Switch to light mode' : 'Switch to  Dark mode'"

        ></v-switch>
        </div>

        <v-tabs
            v-model="tab"
            background-color="transparent"
            grow
        >
            <v-tab

            >
                General
            </v-tab>

            <v-tab
                v-for="constituency in constituencies"
                :key="constituency.id"
            >
                {{constituency.name}}<br>
            </v-tab>

        </v-tabs>

        <v-tabs-items
            v-model="tab"

        >
            <v-tab-item>
                <v-card
                    flat
                >
                    <v-card-text>

                        <generalvoterComponent></generalvoterComponent>

                    </v-card-text>
                </v-card>
            </v-tab-item>

            <v-tab-item
                v-for="constituency in constituencies"
                :key="constituency.id"

            >
                <v-card
                    flat
                >
                    <v-card-text>
                        <constituencydetails-component :constituency_id="constituency.id"></constituencydetails-component>
                    </v-card-text>
                </v-card>
            </v-tab-item>

        </v-tabs-items>

    </v-card>
    </div>

</template>

<script>
    import generalvoterComponent from "./generalvoterComponent";
    import constituencydetailsComponent from "./constituencydetailsComponent";
    export default {
        name: "mainComponent",
        components:{
            generalvoterComponent,
            constituencydetailsComponent
        },
        data(){
            return{
                constituencies:[],
                tab:'east',
                progress:true,
            }
        },
        methods:{
            get_constituencies(){
                this.progress=true;
                axios.get('/api/constituencies')
                    .then(res=>{
                        this.constituencies = res.data;
                        this.progress =false;
                    })
                    .catch(err=>{

                    });

           }

        },
        mounted() {

            this.get_constituencies();

        }
    }
</script>

<style scoped>

</style>
