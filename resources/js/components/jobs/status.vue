<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Update status</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-card-text>
                                <div>
                                    <label for="">Status</label>
                                    <el-select v-model="form.status" filterable style="width: 100%" placeholder="type at least 3 characters"
                                    :loading="loading">
                                        <el-option v-for="item in status" :key="item.value" :label="item.value" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div style="margin: 20px"></div>
                                <div>
                                    <el-input type="textarea" placeholder="Please input" v-model="form.comment" maxlength="30" show-word-limit>
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
        errors: {},
    }),
    methods: {
        save() {
            var payload = {
                model: 'status',
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
    },
    created() {
        eventBus.$on("openStatusJob", data => {
            this.form = data
            this.dialog = true;
        });
    },

    computed: {
        loading() {
            return this.$store.getters.loading;
        },
        statuses() {
            return this.$store.getters.statuses;
        },
    },
};
</script>
