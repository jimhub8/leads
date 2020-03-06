export default {
    loading(state) {
        return state.loading;
    },
    errors(state) {
        return state.errors;
    },
    alertEvent(state) {
        eventBus.$emit('alertEvent', state)
        // return state.alertEvent;
    },
    users(state) {
        return state.users
    },
    roles(state) {
        return _.orderBy(state.roles, 'name', 'asc')
    },
    jobs(state) {
        return state.jobs
    },
    clients(state) {
        return state.clients
    },
    jobtypes(state) {
        return state.jobtypes
    },

    user_perm(state) {
        return state.user_perm;
    },
    role_perm(state) {
        return state.role_perm;
    },
    permissions(state) {
        return _.orderBy(state.permissions, 'name', 'asc')
        // return state.permissions;
    },
    staff(state) {
        return state.staff;
    },
}
