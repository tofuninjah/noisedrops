<template>
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-around p-2">
            <div
                v-for="(drop, index) in droplets"
                v-bind:index = "index"
                v-bind:key = "index.id"
                v-bind:title = "drop.name"
                v-bind:link = "drop.link"
                v-bind:description = "drop.description"
                v-bind:filename = "drop.filename"
            >
                <div class="card" style="width: 18rem;">
                    <a href="javascript:;;" class="card__expand" style="position: absolute;" @click="expandDrop(drop.link, drop.filename)">
                        <icon name="arrows-alt" scale="2" class="icon__expand"></icon>
                    </a>

                    <img class="card-img-top" v-lazy="drop.link" alt="Card image caption" width="100%" height="100%">

                    <div class="card-block">
                        <h4 class="card-title">{{ drop.name }}</h4>
                        <p class="card-text">{{ drop.description }}</p>
                        <audio-player :sources="[drop.filename]" :single="false" :loop="true"></audio-player>
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
                this.droplets = response.data;
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
    }
    .card-img-top {
        max-height: 150px;
    }
    .card__expand {
        right: 10px;
        top: 10px;
        color: #FFF;
        position: absolute;
        opacity: .5;
    }
    .card__expand:hover {
        opacity: 1;
    }
    .card-text {
        font-size: 12px;
    }
    @media (min-width: 768px) {
        .card {
            margin: 20px 15px 0 15px;
        }
    }

    img[lazy=loading] {
        /*your style here*/
        margin: 0 auto;
        width: 75px;
        height: 75px;
        padding: 10px 10px 10px 10px;
    }
    img[lazy=error] {}
    img[lazy=loaded] {}
</style>
