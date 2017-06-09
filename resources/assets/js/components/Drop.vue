<template>
    <div>
        <div class="d-flex justify-content-between drop-container">
            <div class="align-self-center">
                <a href="javascript:;;" class="card__back" style="" @click="goBack">
                    <icon name="chevron-left" scale="4" class="icon__left"></icon>
                </a>
            </div>
            <div class="align-self-center icon__play text-center">
                <audio-player :sources="drop" :loop="true" :single="true" :autoplay="true"></audio-player>
            </div>
            <div class="align-self-center">
                <a href="javascript:;;" class="card__forward" style="" @click="goBack">
                    <icon name="chevron-right" scale="4" class="icon__right"></icon>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import AudioPlayer from './audio-player.vue';
import { EventBus } from '../app.js';

export default {
    props: [
        'drop'
    ],
    data() {
        return {
            audioSources: [
                'https://s3-us-west-2.amazonaws.com/noisedrops/basketball.mp3'
            ]
        }
    },
    components: {
        'AudioPlayer': AudioPlayer
    },
    mounted() {
        console.log('a Drop Component mounted.')
    },
    methods: {
        goBack() {
            EventBus.$emit('goBack', true);
        }
    }
}
</script>

<style scoped>
h1, h2, h3, h4, h5, h6 {
    font-family: 'Raleway', sans-serif;
    color: powderblue;
}
.drop-container {
    margin: 25px;
    height: 50vh;
}
.card__back {
    margin-left: 2%;
}
.card__forward {
    margin-right: 2%;
    visibility: hidden;
}
.icon__play {
    min-width: 200px;
}
.icon__left, .icon__right {
    color: #FFF;
    opacity: .6;
}
.icon__left:hover, .icon__right:hover {
    opacity: 1;
    color: powderblue;
}
</style>
