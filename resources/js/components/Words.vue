<template>
    <div id="words">
        <word-definition v-for="(word, index) in items" :word="word" :key="word.id"></word-definition>
    </div>
</template>

<script>
    import ItemsRetrieval from '../mixins/ItemsRetrieval'

    export default {
        name: "words",

        mixins: [ItemsRetrieval],

        props: ['api'],

        created() {
            //component mounted
        },

        data() {
            return {}
        },

        methods: {
            url(page = 1) {
                if (this.api) {
                    return  this.api + "?page=" + page;
                }

                return 'apis' + location.pathname + "?page=" + page;
            },
        }
    }
</script>

<style scoped>

</style>
