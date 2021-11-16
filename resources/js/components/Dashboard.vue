<template>
    <div class="w-full pt-4 mx-auto flex flex-col items-center justify-center" id="app">
        <div>
            <ticker :data="this.btc">{{ this.btc.symbol }}</ticker>
        </div>
        <!--
        <div class="pt-4 grid grid-cols-6 gap-4">
            <ticker :data="token" v-for="(token, index) in this.others" :key="index">{{ token.symbol }}</ticker>
        </div>
        <div v-if="this.btc.rel_variation < 0.1" class="absolute top-0 right-0 mt-10 mr-20">
            <div class="rounded p-10 bg-green-500 text-white font-bold text-xl">Death Needle possible conditions</div>
        </div>
        <div v-else class="absolute top-0 right-0 mt-10 mr-20">
            <div class="rounded p-10 bg-gray-500 text-white font-bold text-xl">No Death Needle conditions</div>
        </div>
        -->
    </div>
</template>
<script>
    export default {
        data () {
            return {
                btc: {},
                others: {},
                index: null,
                polling: null
            }
        },

        mounted() {
        },

        methods: {
            pollData () {
                this.polling = setInterval(() => {

                    axios.get('tickers').then(resp => {
                        this.btc = resp.data.btc;
                        //this.others = resp.data.others;
                        //console.log(this.others.length);
                    });

                }, 1000)
            }
        },

        beforeDestroy () {
            clearInterval(this.polling)
        },

        created () {
            this.pollData()
        }
    }
</script>
