<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Edit Jobtype</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                            <v-flex sm12>
                                <v-card-text>
                                    <div>
                                        <label for="">Job Title</label>
                                        <el-input placeholder="John Doe" v-model="form.name"></el-input>
                                    </div>
                                    <div style="margin: 20px 0"></div>
                                    <div>
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
        form: {},
        errors: {},
        payload: {
            model: 'jobtypes',
        },
    }),
    created() {
        eventBus.$on("openEditJobtype", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            this.payload['data'] = this.form
            this.$store.dispatch('patchItems', this.payload)
                .then(response => {
                    eventBus.$emit("jobtypeEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },
    computed: {
        loading() {
            return this.$store.getters.loading;
        },
    },
};
</script>
