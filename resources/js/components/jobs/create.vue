<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Job type</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Staff</label>
                                    <el-select v-model="form.staff" filterable remote reserve-keyword style="width: 100%" placeholder="type at least 3 characters" :remote-method="search_users" :loading="loading">
                                        <el-option v-for="item in users.data" :key="item.id" :label="item.name" :value="item.id">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div>
                                    <label for="">Client</label>
                                    <el-select v-model="form.client" filterable remote reserve-keyword style="width: 100%" placeholder="type at least 3 characters" :remote-method="search_client" :loading="loading">
                                        <el-option v-for="item in clients.data" :key="item.id" :label="item.name" :value="item.id">
                                        </el-option>
                                    </el-select>
                                </div>

                                <v-layout row wrap>
                                    <VFlex sm6>
                                        <div>
                                            <span class="demonstration">Start date</span>
                                            <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a day" style="width: 100%">
                                            </el-date-picker>
                                        </div>
                                    </VFlex>
                                    <VFlex sm6>
                                        <div>
                                            <span class="demonstration">End date</span>
                                            <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a day" style="width: 100%">
                                            </el-date-picker>
                                        </div>
                                    </VFlex>
                                </v-layout>
                                <v-layout row wrap v-for="(item, index) in form.jobs_arr" :key="index">
                                    <VFlex sm5>
                                        <div>
                                            <label for="">Job Type</label>
                                            <el-select v-model="item.jobtype_id" filterable style="width: 100%" placeholder="Select">
                                                <el-option v-for="item in jobtypes.data" :key="item.id" :label="item.jobtype" :value="item.id">
                                                </el-option>
                                            </el-select>
                                        </div>
                                    </VFlex>
                                    <VFlex sm5>
                                        <div>
                                            <label for="">Price</label>
                                            <el-input placeholder="Price" v-model="item.price"></el-input>
                                        </div>
                                    </VFlex>
                                    <VFlex sm1 offset-sm1>
                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-btn icon v-on="on" class="mx-0" @click="remove(index)" slot="activator" style="margin-top: 32px;">
                                                    <v-icon small color="pink darken-2">delete</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Remove</span>
                                        </v-tooltip>
                                    </VFlex>
                                </v-layout>
                                <v-btn color="info" @click="addNew">Add new</v-btn>
                                <div>
                                    <label for="">Description</label>
                                    <el-input type="textarea" placeholder="Please input" v-model="form.description">
                                    </el-input>
                                </div>
                            </v-card-text>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-btn color="blue darken-1" text @click="close">Close</v-btn>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="save" :loading="loading" :disabled="loading">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    data: () => ({
        dialog: false,
        form: {
            jobs_arr: [{
                jobtype_id: '',
                price: '',
            }]
        },
        errors: {},

    }),
    created() {
        eventBus.$on("openCreateJob", data => {
            this.dialog = true;
            this.getJobtypes()
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'jobs',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("jobEvent")
                });
        },
        close() {
            this.dialog = false;
        },
        search_client(search) {
            // console.log(search);
            if (search.length > 2) {
                var payload = {
                    model: 'search_client',
                    update: 'updateClientList',
                    search: search
                }
                this.$store.dispatch("searchItems", payload);
            }
        },
        search_users(search) {
            // console.log(search);
            if (search.length > 2) {
                var payload = {
                    model: 'search_users',
                    update: 'updateUsersList',
                    search: search
                }
                this.$store.dispatch("searchItems", payload);
            }
        },

        getJobtypes() {
            var payload = {
                model: 'jobtypes',
                update: 'updateJobtypeList'
            }
            this.$store.dispatch("getItems", payload);
        },
        addNew() {
            this.form.jobs_arr.push({
                jobtype_id: '',
                price: '',
            })
        },
        remove(index) {
            this.form.jobs_arr.splice(index, 1)
        },
    },
    computed: {
        loading() {
            return this.$store.getters.loading;
        },
        users() {
            return this.$store.getters.users;
        },
        clients() {
            return this.$store.getters.clients
        },
        jobtypes() {
            return this.$store.getters.jobtypes
        }
    },
};
</script>
