var app = new Vue({
    el: '#app',
    data: {
        logged: 0 , //por defecto no esta logueado
        valor: ''
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
        },
        //Lógica para buscar: >>>> guardamos en el localstorage el criterio y el valor, para en la siguiente página hacer la consulta.
        busca(){
            //obtenemos el valor del select
            var criterio = document.getElementById("selectCriterio").value;
            //obtenemos el valor del input
            var intro = this.valor;
            //guardamos los valores para poder trabajarlos posteriormente
            localStorage.setItem("crit", criterio);
            localStorage.setItem("val", intro);
            location.replace('/busca');
        }
    }
})
