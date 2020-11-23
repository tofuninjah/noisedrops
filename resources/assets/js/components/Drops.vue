<template>
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-around p-2">
            <div
                v-for="(drop, index) in droplets"
                v-bind:index = "index"
                v-bind:key = "index.id"
                v-bind:title = "drop.title"
                v-bind:description = "drop.description"
                v-bind:filename = "drop.enclosure_url"
            >
                <div class="card card-inverse">
                    <img class="card-img" :src="drop.image_url" alt="Card image" v-lazy="drop.image_url">
                    <div class="card-img-overlay">
                        <a href="javascript:;;" class="card__expand" style="position: absolute;" @click="expandDrop(drop.image_url, drop.enclosure_url)">
                            <icon name="arrows-alt" scale="2" class="icon__expand"></icon>
                        </a>
                        <h4 class="card-title">{{ drop.title }}</h4>
                        <p class="card-text">{{ drop.description }}</p>
                        <p class="card-text text-right nobgcolor"><small>Houston, TX</small></p>

                        <div class="audio-player__container">
                            <audio-player :sources="[drop.enclosure_url]" :single="false" :loop="true" :preload="false" :html5="true"></audio-player>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import AudioPlayer from './audio-player.vue';
    import { EventBus } from '../app.js';

    export default {
        props: [],
        data() {
            return {
                single: false,
                droplets: []
            }
        },
        mounted() {
            axios.get("/drops")
            .then(response => {
                this.droplets = response.data.collection;
            })
            .catch(e => {
                this.errors.push(e);
            });
        },
        components: {
            'AudioPlayer': AudioPlayer
        },
        methods: {
            expandDrop(backdrop, drop) {
                this.single = true;
                EventBus.$emit('addDropBackground', backdrop);
                EventBus.$emit('expandDrop', [drop]);
            }
        }
    }
</script>

<style scoped>
    .card {
        margin: 20px 0 0 0;
        border: 1px solid #e5e7e8;
        min-width: 295px;
        min-height: 295px;
    }
    .card-img {
        opacity: .8;
        width: 295px;
    }
    .card-img-top {
        max-height: 125px;
    }
    .card-title {
        width: 100%;
        color: #F7F7F7;
        text-shadow: 1px 1px 5px #434a4f;
        font-size: 22px;
        font-weight: bold;
        min-height: 50px;
        padding-right: 15px;
    }
    .card__expand {
        right: 10px;
        top: 10px;
        color: #F7F7F7;
        position: absolute;
        opacity: .5;
    }
    .card__expand:hover {
        color: #3a96d7;
        opacity: 1;
    }
    .card-text {
        font-size: 16px;
        font-weight: lighter;
        text-shadow: 1px 1px 5px #000;
        color: #F7F7F7;
    }
    .audio-player__container {
        min-width: 295px;
        position: absolute;
        bottom: 10px;
        padding: 10px;
        margin-left: -20px;
        margin-right: -20px;
    }
    .nobgcolor {
        background-color: transparent !important;
    }
    @media (min-width: 768px) {
        .card {
            margin: 20px 15px 0 15px;
        }
    }
    img[lazy=loading] {
        margin: 0 auto;
        width: 75px;
        height: 75px;
        padding: 10px 10px 10px 10px;
    }
    img[lazy=error] {}
    img[lazy=loaded] {}
</style>
