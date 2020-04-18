var app = new Vue({
    el: '#app',
    data: {
      info: 'LOADING...',
      id: 0
    },
    mounted () {
        axios
          .get('../api/restaurants/'+this.id)
          .then(response => (this.info = response.data.data))
    },
    created(){
        this.id = window.location.pathname.split('/')[2];
    }
})
