
export default function guest ({ next, store }){
    if(store.getters.status){
        return next({
           name: 'home'
        })
    }

    return next()
}
