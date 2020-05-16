var app = new Vue({
    el: '#app',
    data: {
        logged: 0 //por defecto no esta logueado
    },
    created () { //estas logueado?
       token = localStorage.getItem("token");
       if(token != null){
           this.logged = 1; //esta logged el user
       }
    },
    methods: {
        salir: function(){
            localStorage.removeItem("token");
            location.reload();
        }
    }
})
