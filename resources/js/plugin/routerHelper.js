import Vue from 'vue'

const routerHelper = {
    install(Vue) {
        Vue.mixin({
            created() {

            },
            methods: {
                getParentUrl(route, name, id) {
                    let routeHistory = route.slice(0, -1);
                    if (Array.isArray(routeHistory)) {
                        if (routeHistory[0].name === name+'.show') {
                            return {name: `${name}.show` , params: id};
                        }
                    }
                    return {name: name};
                }
            }
        });
    }
};

Vue.use(routerHelper);

export default routerHelper;