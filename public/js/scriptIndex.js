var app = new Vue({
    el: '#app',
    data: {
      message: 'Hello Vue!',
      pagination:{
        'total': 0,
        'current_page': 0,
        'per_page': 0,
        'last_page': 0,
        'from': 0,
        'to': 0,
      },
    },
    created(){
        this.getRestaurantes(1);
    },
    /*mounted () {
        axios
          .get('api/restaurants')
          .then(response => {(this.message = response.data.restaurantes.data),
        this.pagination = response.data.pagination})
    },*/
    methods: {
        moveURL : function(id){
            console.log(id);
            //el metodo de guardar en el localstorage el id y luego recuperarlo funciona, pero si se borran los datos de navegacion
            //y se refresca la página deja de funcionar, fue reemplazado con esta función:
            //window.location.pathname.split('/')[2];
            /*localStorage.setItem('id',id);*/
            location.href='/restaurants/'+id;
        },
        changePage: function(page){
            this.pagination.current_page = page;
            this.getRestaurantes(page);
        },
        getRestaurantes: function(page){
            axios
            .get('api/restaurants?page='+page)
            .then(response => {(this.message = response.data.restaurantes.data),
          this.pagination = response.data.pagination})
        }
    },
    computed: {
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }

            var from = this.pagination.current_page - 2; //TODO offset
            if(from < 1){
                from = 1;
            }

            var to = from + (2*2); //TODO offset
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    }
})
