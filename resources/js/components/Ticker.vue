<template>
    <!-- Ticker container -->
    <div class="rounded bg-gray-700 font-bold text-2xl p-5">
        <div class="text-white text-center"><slot /></div>
        <div :class="[this.data.previous <= this.data.close ? 'text-green-500' : 'text-red-500', 'text-center', 'pb-4']">{{ this.data.close }}</div>
        <div class="grid grid-cols-8 gap-4 text-center">
            <div class="text-sky-300">10</div>
            <div class="text-sky-300">30</div>
            <div class="text-sky-300">60</div>
            <div class="text-sky-300">120</div>
            <div class="text-sky-300">240</div>
            <div class="text-sky-300">480</div>
            <div class="text-sky-300">960</div>
            <div class="text-sky-300">1920</div>
            <div :class="color(this.data.close_tick_10p)">{{ this.data.close_tick_10p }} %</div>
            <div :class="color(this.data.close_tick_30p)">{{ this.data.close_tick_30p }} %</div>
            <div :class="color(this.data.close_tick_60p)">{{ this.data.close_tick_60p }} %</div>
            <div :class="color(this.data.close_tick_120p)">{{ this.data.close_tick_120p }} %</div>
            <div :class="color(this.data.close_tick_240p)">{{ this.data.close_tick_240p }} %</div>
            <div :class="color(this.data.close_tick_480p)">{{ this.data.close_tick_480p }} %</div>
            <div :class="color(this.data.close_tick_960p)">{{ this.data.close_tick_960p }} %</div>
            <div :class="color(this.data.close_tick_1920p)">{{ this.data.close_tick_1920p }} %</div>
        </div>
    </div>
</template>
<script>
    export default {
        props:['data'],

        mounted() {
        },

        methods: {

            color(number) {
                return number < 0 ? 'text-red-500' : 'text-green-500';
            }

        }
    }
</script>