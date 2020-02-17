<script>
    export default {
        name: "search",

        data() {
            return {
                searchString: ''
            }
        },

        methods: {
            search() {
                Event.fire('search-word', this.searchString);
            }
        }
    }
</script>

