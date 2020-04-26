var elemento = new Vue({
    el: '.app',
    data: {
        menu:0,
        datos: [],
        respuestaBorrado: "",
        editRestaurant: [],
        borraRestaurant: [],
        cities: [],
        categories: [],
        buscaIdCity: '0',
        buscaIdCat: '0',
        newCity: '0',
        newCat: '0',
        newCityName: 'Introduce ID',
        newCatName: 'Introduce ID',
        newTel: '',
        newDesc: '',
        newName: '',
    },
    created: function(){
        this.cargaRestaurantes();
        this.cargaCities();
        this.cargaCats();
    },
    methods:{
        cargaRestaurantes: function(){
            axios
            .get('api/restaurantsAll')
            .then((response) => {
                this.datos = response.data.data
                this.editRestaurant = response.data.data[0];
            })
        },
        cargaCities: function(){
            axios
            .get('api/cities')
            .then((response) => {
                this.cities = response.data.data
            })
        },
        cargaCats: function(){
            axios
            .get('api/categories')
            .then((response) => {
                this.categories = response.data.data
            })
        },
        borra: function(id){
            console.log(id);
            axios
            .delete('api/restaurants/' + id)
            .then((response) => {
                this.respuestaBorrado = response.data
                alert(this.respuestaBorrado);
                //this.cargaRestaurantes();
                for(var i= 0; i < this.datos.length; i++){
                if(id == this.datos[i].id){
                    this.datos.splice( i , 1);
                    break;
                }
            }
                $('#modalBorrar').modal('hide');
            })
        },
        rellenainput: function(id){
            for(var i= 0; i < this.datos.length; i++){
                if(id == this.datos[i].id){
                    this.editRestaurant = this.datos[i];
                    this.buscaIdCity = this.editRestaurant.city.id;
                    this.buscaIdCat = this.editRestaurant.category.id;
                    break;
                }
            }
            /*axios
            .get('api/restaurants/' + id)
            .then((response) => {
                this.editRestaurant = response.data.data
                //console.log(this.editRestaurant);
                //this.cargaRestaurantes();
            })*/
        },
        rellenaborra: function(id){
            for(var i= 0; i < this.datos.length; i++){
                if(id == this.datos[i].id){
                    this.borraRestaurant = this.datos[i];
                    break;
                }
            }
        },
        createNew: function(nombre, categoria, ciudad, descripcion, telefono){
            axios.post('api/restaurants/', {
                        name: nombre,
                        category: categoria,
                        city: ciudad,
                        description: descripcion,
                        phonenumber: telefono
                    })
                    .then(response => {
                        console.log(response);
                        $('#modalNewRestaurant').modal('hide');
                        this.cargaRestaurantes();
                    })
                    .catch(error => {
                        console.log(error);
                        alert("fallo al crear restaurante, faltan datos");
                    });
        },
        guardaCambios: function(id, nombre, categoria, ciudad){
            //CAMBIAR ORDEN
                    axios.put('api/restaurants/' + id, {
                        name: nombre,
                        category: categoria,
                        city: ciudad
                    })
                    .then(response => {
                        console.log(response);
                        for(var i= 0; i < this.datos.length; i++){
                if(id == this.datos[i].id){
                    //alert("update");
                    this.datos[i].name = nombre;
                    //this.datos[i].category.name = categoria;
                    //this.datos[i].city.id = ciudad;
                    alert(ciudad);
                    break;
                }
            }
                    })
                    .catch(error => {
                        console.log(error);
                        alert("fallo al actualizar");
                    });
            $('#modalEditar').modal('hide');
        },
        busca: function(){
            //coger city
            console.log(this.buscaIdCity);
            for(var i= 0; i < this.cities.length; i++){
                if(this.buscaIdCity == this.cities[i].id){
                    this.editRestaurant.city = this.cities[i];
                    break;
                }
            }
        },
        buscav2: function(){
            //coger categoria
            console.log(this.buscaIdCat);
            for(var i= 0; i < this.categories.length; i++){
                if(this.buscaIdCat == this.categories[i].id){
                    this.editRestaurant.category = this.categories[i];
                    break;
                }
            }
        },
        buscav3: function(){
            //coger city
            //console.log(this.buscaIdCity);
            for(var i= 0; i < this.cities.length; i++){
                if(this.newCity == this.cities[i].id){
                    this.newCityName = this.cities[i].name;
                    break;
                }
            }
        },
        buscav4: function(){
            //coger categoria
            //console.log(this.buscaIdCat);
            for(var i= 0; i < this.categories.length; i++){
                if(this.newCat == this.categories[i].id){
                    this.newCatName = this.categories[i].name;
                    break;
                }
            }
        },
    }
})
