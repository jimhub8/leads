export default {
    loading(state, payload) {
        state.loading = payload
    },
    errors(state, payload) {
        state.errors = payload
    },
    alertEvent(state, payload) {
        state.alertEvent = payload
    },
    updateUsersList(state, payload) {
        state.users = payload
    },
    updateRoleList(state, payload) {
        state.roles = payload
    },
    updateProductsList(state, payload) {
        state.products = payload
    },
    updateSupplierList(state, payload) {
        state.suppliers = payload
    },
    updateClientList(state, payload) {
        state.clients = payload
    },
    updateJobtypeList(state, payload) {
        state.jobtypes = payload
    },
    // Unique
    updateJobList(state, payload) {
        state.jobs = payload
    },
    updateunique_inv(state, payload) {
        state.unique_inv = payload
    },
    updateunique_pkg(state, payload) {
        state.unique_pkg = payload
    },

    updateDiscountList(state, payload) {
        state.discounts = payload
    },
    updateGroupList(state, payload) {
        state.groups = payload
    },
    updateDrawerList(state, payload) {
        state.drawers = payload
    },

    updateCategoryList(state, payload) {
        state.categories = payload
    },

    updatePermissionList(state, payload) {
        state.permissions = payload
    },

    // Deleted
    updateDeletedClients(state, payload) {
        state.deleted_clients = payload
    },

    updateOptionsList(state, payload) {
        state.options = payload
    },
    updateOptionValuesList(state, payload) {
        state.option_values = payload
    },


    updateCartList(state, payload) {
        state.cart = payload

        var exists = state.cart.some(function (product_1) {
            return product_1.id === payload.id
        });
        if (!exists) {
            payload.ordered = 1
            state.cart.push(payload)
        } else {
            var index = state.cart.indexOf(payload);
            var add_item = (Object.assign({}, payload));
            add_item.ordered += 1
            // console.log(add_item);
            Object.assign(state.cart[index], add_item)
        }
        state.cart = state.cart
    },
}
