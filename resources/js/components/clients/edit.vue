<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Edit Client</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <div>
                                <label for="">Full Name</label>
                                <el-input placeholder="John Doe" v-model="form.name"></el-input>
                            </div>
                            <div>
                                <label for="">Email Address</label>
                                <el-input placeholder="john@gmail.com" v-model="form.email"></el-input>
                            </div>
                            <div>
                                <label for="">address</label>
                                <el-input placeholder="123 main st" v-model="form.address"></el-input>
                            </div>
                            <div>
                                <label for="">Phone Number</label>
                                <el-input placeholder="+254..." v-model="form.phone"></el-input>
                            </div>
                            <div>
                                <label for="">Staff</label>
                                <el-select v-model="form.staff_id" filterable remote reserve-keyword style="width: 100%" placeholder="type at least 3 characters" :remote-method="search_users" :loading="loading">
                                    <el-option v-for="item in users.data" :key="item.id" :label="item.name" :value="item.id">
                                    </el-option>
                                </el-select>
                            </div>
                            <label for="">Status</label>
                            <el-select v-model="form.status" filterable clearable placeholder="status" style="width: 100%;">
                                <el-option v-for="item in status" :key="item.value" :label="item.label" :value="item.value">
                                </el-option>
                            </el-select>
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
        status: [{
                value: 'Open',
                lable: 'Open',
            },
            {
                value: 'Closed',
                lable: 'Closed',
            },
        ]
    }),
    created() {
        eventBus.$on("openEditClient", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                data: this.form,
                model: 'clients',
            }
            this.$store.dispatch('patchItems', payload)
                .then(response => {
                    eventBus.$emit("clientEvent")
                });
        },
        close() {
            this.dialog = false;
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
    },
    computed: {
        loading() {
            return this.$store.getters.loading;
        },
        users() {
            return this.$store.getters.users;
        },
    },
};
</script>
