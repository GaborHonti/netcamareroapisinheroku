var app = new Vue({
    el: '#app',
    data: {
        logged: 0 , //por defecto no esta logueado
        valor: '',
        rsdo : [],
        queEs: ''
    },
    created () {
        this.cargaFiltro();
        //estas logueado?
        token = localStorage.getItem("token");
        if(token != null){
            this.logged = 1; //esta logged el user
        }
        this.queEs = localStorage.getItem("val");
    },
    methods: {
        salir: function(){
            localStorage.removeItem("token");
            location.reload();
        },
        cargaFiltro: function(){
            axios.get('../api/' + localStorage.getItem("crit") + '/' + localStorage.getItem("val"))
            .then(response => {
                this.rsdo = response.data;
                console.log(this.rsdo);
            })
            .catch(error => {
                console.log(error);
                //alert("fallo al crear favoritos");
            });
        },
        moveURL : function(id){
            console.log(id);
            //el metodo de guardar en el localstorage el id y luego recuperarlo funciona, pero si se borran los datos de navegacion
            //y se refresca la página deja de funcionar, fue reemplazado con esta función:
            //window.location.pathname.split('/')[2];
            /*localStorage.setItem('id',id);*/
            location.href='/restaurants/'+id;
        },
    }
})
