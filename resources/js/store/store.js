import actions from './actions';
import getters from './getters';
import mutations from './mutations';

export default {
    state: {
        loading: false,
        errors: [],
        users: [],
        roles: [],
        products: [],
        jobs: [],
        clients: [],

        // Deleted
        deleted_clients: [],

        // Api
        jobtypes: [],
        permissions: [],

        role_perm: [],
        user_perm: [],
        cart: [],

    },
    getters,
    mutations,
    actions
}
