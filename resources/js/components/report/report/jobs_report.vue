<template>
<div>
    <!-- <v-text-field color="success" :loading="loading"></v-text-field> -->
    <v-card class="mx-auto" style="padding: 10px;text-align: center;">
        <VCardTitle primary-title>
            <h1 style="margin: auto;">Jobs Report</h1>
        </VCardTitle>
        <VDivider />
        <v-card-text>
            <v-layout row wrap>
                <v-flex sm12>
                    <div>
                        <el-radio v-model="selects.client_select" label="all_clients">All clients</el-radio>
                        <el-radio v-model="selects.client_select" label="custom_clients">Select clients</el-radio>
                    </div>
                </v-flex>
                <v-flex sm12>
                    <div v-if="selects.client_select == 'custom_clients'">
                        <label for="">Client</label>
                        <el-select v-model="jobs_report.client" multiple filterable remote reserve-keyword placeholder="type at least 3 characters" :remote-method="search_client" :loading="loading" style="width: 100%;">
                            <el-option v-for="item in clients.data" :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </div>
                </v-flex>
                <div style="margin: 20px" v-if="selects.client_select == 'custom_clients'"></div>
                <v-flex sm12>
                    <div>
                        <el-radio v-model="selects.staff_select" label="all_staffs">All Staffs</el-radio>
                        <el-radio v-model="selects.staff_select" label="custom_staffs">Select Staffs</el-radio>
                    </div>
                </v-flex>
                <v-flex sm12>
                    <div v-if="selects.staff_select == 'custom_staffs'">
                        <label for="">Staff</label>
                        <el-select v-model="jobs_report.staff" multiple filterable remote reserve-keyword placeholder="type at least 3 characters" :remote-method="search_staff" :loading="loading" style="width: 100%;">
                            <el-option v-for="item in staff.data" :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </div>
                </v-flex>
                <div style="margin: 20px" v-if="selects.client_select == 'custom_staffs'"></div>
                <v-flex sm12>
                    <div>
                        <el-radio v-model="selects.jobs_select" label="all_jobs">All Job types</el-radio>
                        <el-radio v-model="selects.jobs_select" label="custom_jobs">Select Job types</el-radio>
                    </div>
                </v-flex>
                <v-flex sm12>
                    <div v-if="selects.jobs_select == 'custom_jobs'">
                        <label for="">Job Type</label>
                        <el-select v-model="jobs_report.jobtype_id" multiple="" filterable style="width: 100%" placeholder="Select">
                            <el-option v-for="item in jobtypes.data" :key="item.id" :label="item.jobtype" :value="item.id">
                            </el-option>
                        </el-select>
                    </div>
                </v-flex>
                <v-flex sm12>
                    <div>
                        <label for="">Status</label>
                        <el-select v-model="jobs_report.status" multiple filterable clearable placeholder="status" style="width: 100%;">
                            <el-option v-for="item in status" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </div>
                </v-flex>
                <div class="block">
                    <span class="demonstration" style="float: left">Start Date</span>
                    <el-date-picker v-model="jobs_report.start_date" type="date" placeholder="Pick a day" style="width: 100%;">
                    </el-date-picker>
                </div>
                <div class="block">
                    <span class="demonstration" style="float: left">End Date</span>
                    <el-date-picker v-model="jobs_report.end_date" type="date" placeholder="Pick a day" style="width: 100%;">
                    </el-date-picker>
                </div>
            </v-layout>
        </v-card-text>
        <v-card-actions>

            <v-btn text color="info" @click="getReport" :loading="loading" :disabled="loading">
                Get Report
            </v-btn>
            <VSpacer />
            <!-- <v-btn text color="primaryv-btn text
            Download excel
        </v-btn> -->
            <download-excel :data="job_data" type="csv" :fields="json_fields" v-if="job_data.length> 0">
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on" slot="activator" class="mx-0" color="primary">
                            <i color="info" class="fas fa-file-excel"></i>
                        </v-btn>
                    </template>
                    <span>Download report</span>
                </v-tooltip>
            </download-excel>
            <el-tag type="red" v-if="job_data.length > 0">{{ job_data.length }}</el-tag>

        </v-card-actions>
    </v-card>
</div>
</template>

<script>
export default {
    props: ['user'],
    data() {
        return {
            form: {
                search: ''
            },
            selects: {
                staff_select: 'all_staffs',
                client_select: 'all_clients',
                jobs_select: 'all_jobs',
            },
            jobs_report: {
                start_date: '',
                end_date: '',
                client: [],
            },
            job_data: [],
            json_fields: {
                'Created by': 'user_name',
                'Assigned to': 'staff_name',
                'Client Name': 'client_name',
                'Job(s)': 'job_type',
                'Description': 'description',
                'Start date': 'start_date',
                'End date': 'end_date',
                'Total Price': 'total_price',
                'Status': 'status',
                'staff Comment': 'staff_comments',
                'Completed on': 'completed_on',
                'Cancelled on': 'cancelled_on',
                'Created On': 'created_at',
            },
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
        }
    },
    methods: {
        getReport() {
            this.jobs_report.selects = this.selects
            this.loading = true;
            axios.post('jobs_report', this.jobs_report).then((response) => {
                this.loading = false
                this.job_data = response.data
                if (response.data.length < 1) {
                    eventBus.$emit('errorEvent', 'No data found')
                } else {
                    this.$store.dispatch('alertEvent', 'Data fetched')
                }
            }).catch((error) => {
                this.loading = false;
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                }
            })
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

        getJobtypes() {
            var payload = {
                model: 'jobtypes',
                update: 'updateJobtypeList'
            }
            this.$store.dispatch("getItems", payload);
        },

    },
    mounted() {
        this.getJobtypes()
    },
    computed: {
        loading() {
            return this.$store.getters.loading;
        },
        staff() {
            return this.$store.getters.staff;
        },
        clients() {
            return this.$store.getters.clients
        },
        jobtypes() {
            return this.$store.getters.jobtypes
        }
    },
}
</script>

<style scoped>
label {
    float: left;
}

.theme--light.v-card>.v-card__text {
    /* height: 410px; */
}
</style>
