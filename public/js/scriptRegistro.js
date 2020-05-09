var aplicacion = new Vue({
    el: '.app',
    data: {
        token: "no hay token",
        nombre: "",
        mail: "",
        passwd: "",
    },
    methods: {
        enviar: function(){
            //alert(this.nombre + ' , ' + this.mail + ' , ' + this.passwd)
            axios.post('api/registro/', {
                name: this.nombre,
                email: this.mail,
                password: this.passwd,
            })
            .then(response => {
                console.log(response);
                this.token = response.data.success.token
                localStorage.setItem("token", this.token);
            })
            .catch(error => {
                console.log(error);
                alert("fallo al loguear");
            });
        }
    }
})
