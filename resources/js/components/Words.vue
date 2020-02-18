<template>
    <div id="words" class="mb-5">
        <word-definition v-for="(word, index) in items" :word="word" :key="word.id"></word-definition>

        <paginator :dataSet="dataSet"></paginator>

        <empty
            v-show="items.length < 1"
            message="Word Not found! You can define it though."
            :algolia="true"
        ></empty>
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
