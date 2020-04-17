var app = new Vue({
    el: '#app',
    data: {
      message: 'Hello Vue!'
    },
    mounted () {
        axios
          .get('api/restaurantes')
          .then(response => (this.message = response.data.data))
    },methods: {
        verURL: function () {
            var URLactual = window.location;
            alert(URLactual);
        }
    }
})
