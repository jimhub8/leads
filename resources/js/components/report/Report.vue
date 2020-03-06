<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-layout row wrap>
                <v-flex sm4>
                    <myJobs :user="user"></myJobs>
                </v-flex>

            </v-layout>
        </v-layout>
    </v-container>
</v-content>
</template>

<script>
import myJobs from './report/jobs_report';
export default {
    props: ['user'],
    components: {
        myJobs,
    },
    methods: {
        getClients() {
            var payload = {
                model: 'clients',
                update: 'updateClientList'
            }
            this.$store.dispatch("getItems", payload);
        },
        getStaff() {
            var payload = {
                model: 'staff',
                update: 'updateStaffList'
            }
            this.$store.dispatch("getItems", payload);
        },
    },
    mounted () {
        this.getClients()
        this.getStaff()
    },
}
</script>
