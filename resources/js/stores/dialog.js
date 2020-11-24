export default {
    namespaced: true,
    state: {
        status: false,
        component: 'search', //dialog component that will be used in App.vue, i.e. search, login, etc...
    },
    mutations: {
        setStatus: (state, status) => {
            state.status = status
        },
        setComponent: (state, component) => {
            state.component = component
        },
    },
    actions: {
        setStatus: ({commit}, status) => {
            commit('setStatus', status)
        },
        setComponent: ({commit}, component) => {
            commit('setComponent', component)
            commit('setStatus', true)
        },
    },
    getters: {
        status: state => state.status,
        component: state => state.component,
    }
}