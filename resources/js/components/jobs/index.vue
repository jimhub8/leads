<template>
<v-content>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Jobs</el-breadcrumb-item>
                    </el-breadcrumb>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <myFilter :form="form" :user="user" style></myFilter> -->
            </v-flex>
            <v-flex sm12>
                <v-card style="padding: 10px 0;">
                    <v-layout row>
                        <v-flex sm1 style="margin-left: 10px;">
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getJobs">
                                        <v-icon color="blue darken-2" small>refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Jobs</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm3>
                            <v-btn color="info" @click="openCreate" text>Create Job</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <v-pagination v-model="jobs.current_page" :length="jobs.last_page" total-visible="5" @input="next_page(jobs.path, jobs.current_page)" circle v-if="jobs.last_page > 1"></v-pagination>
            </v-flex>
            <v-flex sm12>
                <vue-good-table class="table-hover" :columns="columns" :rows="jobs.data" :search-options="{ enabled: true }" :pagination-options="{enabled: true,mode: 'pages'}" v-loading="loading" :sort-options="{enabled: true, initialSortBy: {field: 'id', type: 'asc'}}">
                    <template slot="table-row" slot-scope="props">
                        <span v-if="props.column.field == 'created_at'">
                            <span>
                                <el-tag type="success">{{props.formattedRow.created_at}}</el-tag>
                            </span>
                        </span>
                        <span v-else-if="props.column.field == 'description'" id="description">
                            <el-tooltip class="item" effect="dark" :content="props.row.description" placement="top-start">
                                <span>
                                    {{ props.row.description }}
                                </span>
                            </el-tooltip>
                        </span>
                        <span v-else-if="props.column.field == 'actions'">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openEdit(props.row)" slot="activator">
                                        <v-icon small color="blue darken-2">edit</v-icon>
                                    </v-btn>
                                </template>
                                <span>Edit {{ props.row.job_type }}</span>
                            </v-tooltip>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openStatus(props.row)" slot="activator">
                                        <v-icon small color="blue darken-2">update</v-icon>
                                    </v-btn>
                                </template>
                                <span>update {{ props.row.job_type }} status</span>
                            </v-tooltip>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openShow(props.row)" slot="activator">
                                        <v-icon small color="blue darken-2">visibility</v-icon>
                                    </v-btn>
                                </template>
                                <span>{{ props.row.job_type }} details</span>
                            </v-tooltip>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" class="mx-0" @click="confirm_delete(props.row)" slot="activator">
                                        <v-icon small color="pink darken-2">delete</v-icon>
                                    </v-btn>
                                </template>
                                <span>Delete {{ props.row.name }}</span>
                            </v-tooltip>
                        </span>
                        <span v-else>{{ props.formattedRow[props.column.field] }}</span>
                    </template>
                </vue-good-table>
            </v-flex>
        </v-layout>
    </v-container>
    <Create></Create>
    <Edit></Edit>
    <Show></Show>
    <Status></Status>
</v-content>
</template>

<script>
import Create from "./create";
import Edit from "./edit";
import Show from "./show";
import Status from "./status";

export default {
    props: ['user'],
    components: {
        Create,
        Edit,
        Show,
        Status
    },
    data() {
        return {
            search: "",
            payload: {
                model: 'jobs',
                update: 'updateJobList'
            },
            jobs_det: {
                data: []
            },
            jobs_search: [],
            columns: [{
                    label: "Id#",
                    field: "id",
                    type: "number"
                },
                // {
                //     label: "Created by",
                //     field: "user_name"
                // },
                {
                    label: "Assigned to",
                    field: "staff_name"
                },
                // {
                //     label: "Job Type",
                //     field: "job_type"
                // },
                {
                    label: "Description",
                    field: "description"
                },
                {
                    label: "status",
                    field: "status"
                },
                {
                    label: "Start date",
                    field: "start_date"
                },
                {
                    label: "End date",
                    field: "end_date"
                },
                // {
                //     label: "Created On",
                //     field: "created_at",
                //     // type: "date",
                //     // dateInputFormat: "YYYY-MM-DD",
                //     // dateOutputFormat: "Do MMMM YYYY"
                // },
                {
                    label: "Actions",
                    field: "actions",
                    sortable: false
                }
            ]
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreateJob");
            var payload = {
                model: 'groups',
                update: 'updateGroupList',
            }
            this.$store.dispatch("getItems", payload);
        },
        openEdit(data) {
            eventBus.$emit("openEditJob", data);
        },
        openStatus(data) {
            eventBus.$emit("openStatusJob", data);
        },
        openShow(data) {
            eventBus.$emit("openShowJob", data);
        },

        confirm_delete(item) {
            this.$confirm('This will permanently delete the job. Continue?', 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(() => {
                this.deleteItem(item)
            }).catch(() => {
                this.$message({
                    type: 'error',
                    message: 'Delete canceled'
                });
            });
        },

        deleteItem(item) {
            this.$store.dispatch("deleteItem", "jobs/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getJobs();
            });
        },
        getJobs() {
            this.$store.dispatch("getItems", this.payload);
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateJobsList'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        jobs() {
            return this.$store.getters.jobs;
        },
        isLoading() {
            return this.$store.getters.loading;
        }
    },
    mounted() {
        // this.$store.dispatch('getJobs');
        eventBus.$emit("LoadingEvent");
        this.getJobs();
    },
    created() {
        eventBus.$on("jobEvent", data => {
            this.getJobs();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditJob");
            } else {
                eventBus.$emit("openCreateJob");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view jobs"]) {
    //         next();
    //       } else {
    //         next("/");
    //       }
    //     });
    //   }
};
</script>

<style scoped>
.el-input--prefix .el-input__inner {
    border-radius: 50px !important;
}

.v-toolbar__content,
.v-toolbar__extension {
    height: auto !important;
}

.v-avatar {
    height: 10px !important;
    width: 10px !important;
    margin-left: 40% !important;
}
</style>
