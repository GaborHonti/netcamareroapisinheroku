var app = new Vue({
    el: '#app',
    data: {
      message: 'Hello Vue!',
    },
    mounted () {
        axios
          .get('api/restaurants')
          .then(response => (this.message = response.data.data))
    },
    methods: {
        moveURL : function(id){
            console.log(id);
            //el metodo de guardar en el localstorage el id y luego recuperarlo funciona, pero si se borran los datos de navegacion
            //y se refresca la página deja de funcionar, fue reemplazado con esta función:
            //window.location.pathname.split('/')[2];
            /*localStorage.setItem('id',id);*/
            location.href='/restaurants/'+id;
        }
    }
})
