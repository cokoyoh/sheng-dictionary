<template>
    <div id="word" class="bg-white px-5 py-8 pb-12 rounded shadow tracking-wide leading-6 text-sm cursor-pointer mb-3">
        <h3 class="text-blue-600 focus:underline font-bold hover:underline text-xl">{{word.title}}</h3>
        <div class="text-gray-800 mt-2 break-words">
           <pre>{{word.description}}</pre>
        </div>
        <p class="pt-4 ml-1 text-blue-600 font-semibold">Examples</p>
        <div class="text-gray-700 text-sm leading-5 mt-3 ml-5">
            <pre>{{word.examples}}</pre>
        </div>
        <div class="mt-5 ml-2 text-xs text-gray-600">
            @<span class="text-blue-600 font-semibold">{{word.user}}</span> <span class="text-gray-700 font-normal">{{word.date}}</span>
        </div>
        <div class="flex items-center justify-around w-1/2 mt-5 relative">
            <div @click="liked"
                 :class="{'border border-green-400': voted === 'like'}"
                class="flex items-center shadow px-2 py-1 rounded-full cursor-pointer w-3/12">
                <svg viewBox="0 0 20 20"
                     :class="{'text-green-600 border-white': voted === 'like'}"
                     class="fill-current h-6 w-6 px-1 rounded-full mr-1 text-gray-600">
                    <path d="M11 0h1v3l3 7v8a2 2 0 0 1-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 0 1 2-2h7V2a2 2 0 0 1 2-2zm6 10h3v10h-3V10z"/></svg>
                <span
                    :class="{'text-green-600': voted === 'like'}"
                    class="font-bold text-gray-700 text-xs font-sans">{{likes}}</span>
            </div>

            <div  @click="disliked"
                  :class="{'border border-red-400': voted === 'dislike'}"
                class="flex items-center shadow px-2 py-1 rounded-full cursor-pointer w-3/12">
                <svg viewBox="0 0 20 20"
                     :class="{'text-red-600 border-white': voted === 'dislike'}"
                     class="fill-current h-6 w-6 px-1 rounded-full mr-1 text-gray-600">
                    <path d="M11 20a2 2 0 0 1-2-2v-6H2a2 2 0 0 1-2-2V8l2.3-6.12A3.11 3.11 0 0 1 5 0h8a2 2 0 0 1 2 2v8l-3 7v3h-1zm6-10V0h3v10h-3z"/>
                </svg>
                <span
                    :class="{'text-red-600': voted === 'dislike'}"
                    class="font-bold text-gray-700 text-xs font-sans">{{dislikes}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "word-definition",

        props: ['word'],

        data() {
          return {
              likes:  0,
              dislikes: 0,
              voted: null,
          };
        },

        methods: {
            liked() {
                let vote = this.voted;

                if (!vote) {
                    this.likes++;
                    this.voted = 'like';
                }

                if (vote && vote === 'dislike') {
                    this.likes++;
                    this.dislikes--;
                    this.voted = 'like'
                }
            },

            disliked() {
                let vote = this.voted;

                if (vote && vote === 'like') {
                    this.likes--;
                    this.dislikes++;
                    this.voted = 'dislike';
                }

                if (! vote) {
                    this.dislikes++;
                    this.voted = 'dislike';
                }
            },
        },
    }
</script>
