export default  {
    data() {
        return {
            dataSet: false,
            items: [],
            endpoint: location.pathname,
        }
    },

    created() {
        this.fetch();
        Event.listen('nextPageRequested', page => this.fetch(page));
        Event.listen('search-word', searchString => this.search(searchString))
    },

    methods: {
        fetch(page = 1){
            axios.get(this.url(page))
                .then(this.refresh)
        },

        refresh({data}) {
            this.dataSet = data;

            this.items = data.data;
        },

        search(searchString) {
            axios.post('/search', {searchString})
                .then(response => {
                    this.dataSet = response.data;

                    this.items = response.data.data;
                });
        }
    }
}
