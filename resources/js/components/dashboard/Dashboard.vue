<template>
<v-content style="margin-top: 50px !important;">
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <!-- <v-flex sm6 v-if="user.can['filter dashboard by country']">
                <el-select v-model="form.country_id" clearable placeholder="Country" style="width: 100%;" @change="country_filter">
                    <el-option v-for="item in countries" :key="item.id" :label="item.name" :value="item.id">
                    </el-option>
                </el-select>
            </v-flex>
            <v-flex sm6>
                <el-select v-model="form.year_f" clearable placeholder="Country" style="width: 100%;" @change="country_filter">
                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                    </el-option>
                </el-select>
            </v-flex> -->
            <el-row :gutter="24" style="width: 100%">
                <el-col :span="6">
                    <div style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ jobs_count }}</p>
                                <h5 style="color: #fff">Jobs</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ complete_jobs_count }}</p>
                                <h5 style="color: #fff">Completed Jobs</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div @click="openPage('To be delivered')" style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ pedding_jobs_count }}</p>
                                <h5 style="color: #fff">Pending</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div @click="openPage('Returned')" style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ today_jobs_count }}</p>
                                <h5 style="color: #fff">Today Jobs</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
            </el-row>
            <div style="margin: 50px"></div>
            <el-row :gutter="24" style="width: 100%">
                <el-col :span="6">
                    <div style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ open_leads_count }}</p>
                                <h5 style="color: #fff">Total revenue</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ avarage_revenue }}</p>
                                <h5 style="color: #fff">Average month revenue</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div @click="openPage('To be delivered')" style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ closed_leads_count }}</p>
                                <h5 style="color: #fff">Today Revenue</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div @click="openPage('Returned')" style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ user_count }}</p>
                                <h5 style="color: #fff">Users</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
            </el-row>

            <div style="margin: 50px"></div>
            <el-row :gutter="24" style="width: 100%">
                <el-col :span="6">
                    <div style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ client_count }}</p>
                                <h5 style="color: #fff">Jobs</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ open_leads_count }}</p>
                                <h5 style="color: #fff">Open Leads</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div @click="openPage('To be delivered')" style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ closed_leads_count }}</p>
                                <h5 style="color: #fff">Closed Leads</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
                <el-col :span="6">
                    <div @click="openPage('Returned')" style="cursor: pointer">
                        <el-card shadow="hover">
                            <div class="text-center">
                                <p style="font-size: 36px;color: #fff;">{{ cancelled_leads_count }}</p>
                                <h5 style="color: #fff">Cancelled Leads</h5>
                            </div>
                        </el-card>
                    </div>
                </el-col>
            </el-row>
        </v-layout>
    </v-container>
</v-content>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            user_count: null,
            client_count: null,
            jobs_count: null,
            complete_jobs_count: null,
            pedding_jobs_count: null,
            open_leads_count: null,
            closed_leads_count: null,
            cancelled_leads_count: null,
            today_jobs_count: null,
            avarage_revenue: null,
        }
    },
    methods: {
        get_user_count() {
            axios.get('user_count').then((response) => {
                this.user_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_client_count() {
            axios.get('client_count').then((response) => {
                this.client_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_jobs_count() {
            axios.get('jobs_count').then((response) => {
                this.jobs_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_complete_jobs_count() {
            axios.get('complete_jobs_count').then((response) => {
                this.complete_jobs_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_pedding_jobs_count() {
            axios.get('pedding_jobs_count').then((response) => {
                this.pedding_jobs_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_open_leads_count() {
            axios.get('open_leads_count').then((response) => {
                this.open_leads_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_closed_leads_count() {
            axios.get('closed_leads_count').then((response) => {
                this.closed_leads_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_cancelled_leads_count() {
            axios.get('cancelled_leads_count').then((response) => {
                this.cancelled_leads_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_today_jobs_count() {
            axios.get('today_jobs_count').then((response) => {
                this.today_jobs_count = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        get_avarage_revenue() {
            axios.get('avarage_revenue').then((response) => {
                this.avarage_revenue = response.data
            }).catch((error) => {
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    return
                }
                this.errors = error.response.data.errors
            })
        },
        refresh_dashboard() {

        },
    },
    computed: {

    },
    mounted() {
        this.get_user_count()
        this.get_client_count()
        this.get_jobs_count()
        this.get_complete_jobs_count()
        this.get_pedding_jobs_count()
        this.get_open_leads_count()
        this.get_closed_leads_count()
        this.get_today_jobs_count()
        this.get_cancelled_leads_count()
        this.get_avarage_revenue()
    },
    created() {

    },
    // filters: {
    //     moment(date) {
    //         return moment(date).format('ddd, MMM Do YYYY');
    //     },
    // },
}
</script>

<style scoped>
.justify-center {
    margin-top: -100px !important;
}

.card-stats {
    margin-top: -10px;
    padding: 20px 0;
}

/* .statistics {
    background: #f0f0f0 !important;
} */

.progress-Ship {
    margin-top: 100px !important;
}

.v-icon {
    font-size: 64px !important;
}

.v-icon {
    box-shadow: 0 9px 30px -6px rgba(255, 54, 54, .5);
    padding: 5px;
    border-radius: 50%;
}

.info-title {
    margin-top: 20px;
}

.el-card {
    border: 1px solid #EBEEF5;
    background-color: #FFF;
    color: #303133;
    transition: .3s;
    background: #67c23a;
}
</style>
