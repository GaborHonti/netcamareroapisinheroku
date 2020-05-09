var app = new Vue({
    el: '#app',
    data: {
      info: 'LOADING...',
      token: '',
      favs: [],
    },
    created() {
        $('.editP').click();
        //logica de sacar el token y autenticar el usuario
        var existeToken = this.comprobarExistenciaToken();
        if(existeToken){
            this.sacarDatosUser();
            //this.getFavs();
        }else {
            this.info = "sin acceso";
        }
    },
    methods: {
        comprobarExistenciaToken: function(){

            var hayToken = false;
            this.token = localStorage.getItem("token");
            if(this.token != null){
                hayToken =  true;
            }

            return hayToken;

        },
        sacarDatosUser: function(){
            axios.get('/api/userinfo/', {
                headers: {
                    'Accept':'application/json',
                    'Authorization':'Bearer '+this.token}})
            .then((response) => {
                this.info = response.data
                axios.get('/api/myFavs/' + this.info.id, {
                headers: {
                    'Accept':'application/json',
                    'Authorization':'Bearer '+this.token}})
                .then(response => (this.favs = response.data.data))
            })
        },
        /*getFavs: function(){
            alert(this.info)
            axios.get('/api/myFavs/' + this.info.id, {
                headers: {
                    'Accept':'application/json',
                    'Authorization':'Bearer '+this.token}})
            .then(response => (this.favs = response.data))
        },*/
    },
})
