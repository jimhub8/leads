<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Client</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <div>
                                <label for="">company/individual</label>
                                <el-select v-model="form.client_type" filterable clearable placeholder="status" style="width: 100%;">
                                    <el-option v-for="item in client_type" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </div>
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
                                <label for="">Tel</label>
                                <el-input placeholder="+254..." v-model="form.tel"></el-input>
                            </div>
                            <div>
                                <label for="">Contact person Phone No.</label>
                                <el-input placeholder="+254..." v-model="form.phone"></el-input>
                            </div>
                            <div>
                                <label for="">Staff</label>
                                <el-select v-model="form.staff_id" filterable remote reserve-keyword style="width: 100%" placeholder="type at least 3 characters" :remote-method="search_staff" :loading="loading">
                                    <el-option v-for="item in staff.data" :key="item.id" :label="item.name" :value="item.id">
                                    </el-option>
                                </el-select>
                            </div>
                            <div>
                                <label for="">Status</label>
                                <el-select v-model="form.status" filterable clearable placeholder="status" style="width: 100%;">
                                    <el-option v-for="item in status" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </div>
                            <div>
                                <label for="">Notes</label>
                                <el-input type="textarea" placeholder="Please input" v-model="form.notes">
                                </el-input>
                            </div>
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
                value: 'WIP',
                lable: 'WIP',
            },
            {
                value: 'COMPLETED',
                lable: 'COMPLETED',
            },
            {
                value: 'CANCELLED',
                lable: 'CANCELLED',
            },
        ],
        client_type: [{
                value: 'Company',
                lable: 'Company',
            },
            {
                value: 'Individual',
                lable: 'Individual',
            },
        ]
    }),
    created() {
        eventBus.$on("openCreateClient", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'clients',
                data: this.form,
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("clientEvent")
                });
        },
        close() {
            this.dialog = false;
        },

        getStaff() {
            var payload = {
                model: 'staff',
                update: 'updateStaffList'
            }
            this.$store.dispatch("getItems", payload);
        },
        search_staff(search) {
            // console.log(search);
            if (search.length > 2) {
                var payload = {
                    model: 'search_staff',
                    update: 'updateStaffList',
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
        staff() {
            return this.$store.getters.staff;
        },
    },
};
</script>
