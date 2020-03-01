<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
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
                                    <label for="">Customer</label>
                                    <el-select v-model="form.client" filterable remote reserve-keyword style="width: 100%" placeholder="type at least 3 characters" :remote-method="search_client" :loading="loading">
                                        <el-option v-for="item in clients.data" :key="item.id" :label="item.name" :value="item.id">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div>
                                    <el-input type="textarea" placeholder="Please input" v-model="form.description" maxlength="30" show-word-limit>
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
        form: {},
        errors: {},
    }),
    methods: {

        save() {
            var payload = {
                model: 'jobs',
                data: this.form,
                id: this.form.id
            }
            this.$store.dispatch('patchItems', payload)
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
        }
    },
    created() {
        eventBus.$on("openEditJob", data => {
            this.form = data
            this.dialog = true;
        });
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
        }
    },
};
</script>
