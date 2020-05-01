var elemento = new Vue({
    el: '.app',
    data: {
        menu:0,
        datos: [],
        comments: [],
        respuestaBorrado: "",
        editRestaurant: [],
        editCity: [],
        editCat: [],
        borraCity: [],
        borraCat: [],
        borraRestaurant: [],
        borraComentario: [],
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
        newNameCity: '',
        newNameCat: '',
    },
    created: function(){
        this.cargaRestaurantes();
        this.cargaCities();
        this.cargaCats();
        this.cargaComentarios();
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
        cargaComentarios: function(){
            axios
            .get('api/comments')
            .then((response) => {
                this.comments = response.data.data
            })
        },
        cargaCities: function(){
            axios
            .get('api/cities')
            .then((response) => {
                this.cities = response.data.data
                this.editCity = response.data.data[0];
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
        borraCiudad: function(id){
            console.log(id);
            axios
            .delete('api/cities/' + id)
            .then((response) => {
                this.respuestaBorrado = response.data
                alert(this.respuestaBorrado);
                //this.cargaRestaurantes();
                for(var i= 0; i < this.cities.length; i++){
                if(id == this.cities[i].id){
                    this.cities.splice( i , 1);
                    break;
                }
            }
                $('#modalBorrarCity').modal('hide');
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
        },
        rellenaborra: function(id){
            for(var i= 0; i < this.datos.length; i++){
                if(id == this.datos[i].id){
                    this.borraRestaurant = this.datos[i];
                    break;
                }
            }
        },
        rellenaborraComment: function(id){
            for(var i= 0; i < this.comments.length; i++){
                if(id == this.comments[i].id){
                    this.borraComentario = this.comments[i];
                    break;
                }
            }
        },
        borraComment: function(id){
            console.log(id);
            axios
            .delete('api/comments/' + id)
            .then((response) => {
                this.respuestaBorrado = response.data
                alert(this.respuestaBorrado);
                //this.cargaRestaurantes();
                for(var i= 0; i < this.comments.length; i++){
                if(id == this.comments[i].id){
                    this.comments.splice( i , 1);
                    break;
                }
            }
                $('#modalBorrarComment').modal('hide');
            })
        },
        //OPERACIONES DE CITY----------------------------------------------------------------------------------------------------
        rellenainputCity: function(id){
            for(var i= 0; i < this.cities.length; i++){
                if(id == this.cities[i].id){
                    this.editCity = this.cities[i];
                    break;
                }
            }
        },
        rellenaborraCity: function(id){
            for(var i= 0; i < this.cities.length; i++){
                if(id == this.cities[i].id){
                    this.borraCity = this.cities[i];
                    break;
                }
            }
        },
        guardaCambiosCity: function(id, nombre){
            //CAMBIAR ORDEN
                    axios.put('api/cities/' + id, {
                        name: nombre
                    })
                    .then(response => {
                        console.log(response);
                        //this.cargaRestaurantes();
                        for(var i= 0; i < this.cities.length; i++){
                            if(id == this.cities[i].id){
                                //alert("update");
                                this.cities[i].name = nombre;
                                alert(name);
                                break;
                            }
                        }
                        for(var i= 0; i < this.datos.length; i++){
                            if(id == this.datos[i].city.id){
                                this.datos[i].city.name = nombre;
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        alert("fallo al actualizar");
                    });
            $('#modalEditarCity').modal('hide');
        },
        //OPERACIONES CATEGORIA ----------------------------------------------------------------------------------------------------
        rellenaborraCat: function(id){
            for(var i= 0; i < this.categories.length; i++){
                if(id == this.categories[i].id){
                    this.borraCat = this.categories[i];
                    break;
                }
            }
        },
        rellenainputCat: function(id){
            for(var i= 0; i < this.categories.length; i++){
                if(id == this.categories[i].id){
                    this.editCat = this.categories[i];
                    break;
                }
            }
        },
        borraCategoria: function(id){
            console.log(id);
            axios
            .delete('api/categories/' + id)
            .then((response) => {
                this.respuestaBorrado = response.data
                alert(this.respuestaBorrado);
                for(var i= 0; i < this.categories.length; i++){
                if(id == this.categories[i].id){
                    this.categories.splice( i , 1);
                    break;
                }
            }
                $('#modalBorrarCat').modal('hide');
            })
        },
        guardaCambiosCat: function(id, nombre){
            //CAMBIAR ORDEN
                    axios.put('api/categories/' + id, {
                        name: nombre
                    })
                    .then(response => {
                        console.log(response);
                        for(var i= 0; i < this.categories.length; i++){
                            if(id == this.categories[i].id){
                                //alert("update");
                                this.categories[i].name = nombre;
                                alert(name);
                                break;
                            }
                        }
                        for(var i= 0; i < this.datos.length; i++){
                            if(id == this.datos[i].category.id){
                                this.datos[i].category.name = nombre;
                            }
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        alert("fallo al actualizar");
                    });
            $('#modalEditarCat').modal('hide');
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
        createNewCity: function(nombre){
            axios.post('api/cities/', {
                        name: nombre,
                    })
                    .then(response => {
                        console.log(response);
                        $('#modalNewCity').modal('hide');
                        this.cargaCities();
                    })
                    .catch(error => {
                        console.log(error);
                        alert("fallo al crear restaurante, faltan datos");
                    });
        },
        createNewCat: function(nombre){
            axios.post('api/categories/', {
                        name: nombre,
                    })
                    .then(response => {
                        console.log(response);
                        $('#modalNewCat').modal('hide');
                        this.cargaCats();
                    })
                    .catch(error => {
                        console.log(error);
                        alert("fallo al crear categoria, faltan datos");
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
