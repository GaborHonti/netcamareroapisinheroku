var app = new Vue({
    el: '#app',
    data: {
      info: 'LOADING...',
      token: '',
    },
    created() {
        //logica de sacar el token y autenticar el usuario
        var existeToken = this.comprobarExistenciaToken();
        if(existeToken){
            this.sacarDatosUser();
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
            axios.get('/api/userinfo', {
                headers: {
                    'Accept':'application/json',
                    'Authorization':'Bearer '+this.token}})
            .then(response => (this.info = response.data))
        },
    },
})
