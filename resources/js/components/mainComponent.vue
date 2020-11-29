<template>
    <div>
        <v-skeleton-loader type="card" v-if="progress"></v-skeleton-loader>
    <v-card flat v-else>
        <v-row>
            <v-col cols="12" sm="3">
                Made with <code class="pr-2 pl-2">Code</code> by &nbsp;&nbsp; <a href="https://twitter.com/oryusif"> Yusif Katulie</a>

            </v-col>
            <v-col cols="12" sm="2">

                <v-switch
                    v-model="$vuetify.theme.isDark"
                    :label="$vuetify.theme.isDark ? 'Switch to light mode' : 'Switch to  Dark mode'"
                    class="m-0"

                ></v-switch>
                <v-btn color="green" to="/votepattern" block outlined rounded>Vote Pattern</v-btn>
            </v-col>
            <v-col cols="12" sm="7">
                <v-alert outlined type="warning">
                    <span class="font-weight-light"><strong>NOTE:</strong> The media house responsible for the votes
                        published here is NOT calling this election but only projecting what is being reported on the grounds.
                        You are advised to wait until the official results are declared.</span>
                </v-alert>
            </v-col>
        </v-row>

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
