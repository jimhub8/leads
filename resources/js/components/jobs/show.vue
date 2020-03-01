<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="900px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Job Details</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>client name</b>
                                    <span class="badge badge-primary badge-pill">{{ form.client_name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Description</b>
                                    <span class="">{{ form.description }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Staff comments</b>
                                    <span class="">{{ form.staff_comments }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>Status</b>
                                    <span class="badge badge-primary badge-pill">{{ form.status }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Completed on
                                    <span class="badge badge-primary badge-pill">{{ form.completed_on }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" v-if="form.status == 'Complete'">
                                    Completed on
                                    <span class="badge badge-primary badge-pill">{{ form.completed_on }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" v-if="form.status == 'Cancelled'">
                                    Cancelled on
                                    <span class="badge badge-primary badge-pill">{{ form.cancelled_on }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Start date
                                    <span class="badge badge-primary badge-pill">{{ form.start_date }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    End date
                                    <span class="badge badge-primary badge-pill">{{ form.end_date }}</span>
                                </li>
                            </ul>

                            <v-divider></v-divider>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Job title</th>
                                        <th scope="col">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in form.jobtype" :key="item.id">
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ item.jobtype }}</td>
                                        <td>{{ item.description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-btn color="blue darken-1" text @click="close">Close</v-btn>
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
    }),
    methods: {
        close() {
            this.dialog = false;
        },
    },
    created() {
        eventBus.$on("openShowJob", data => {
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

<style scoped>
ul span {
    margin-left: 40px;
}
</style>
