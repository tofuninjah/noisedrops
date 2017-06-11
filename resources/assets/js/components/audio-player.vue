<template>
    <div>
        <div v-if="!single">
            <div class="d-flex justify-content-around">
                <a href="javascript:;;" @click="togglePlayHandler" class="btn btn-secondary btn-play drop-control text-muted" v-if="playing">
                    <icon name="pause-circle" scale="2" @click="togglePlayHandler"></icon>
                </a>
                <a href="javascript:;;" @click="togglePlayHandler" class="btn btn-secondary btn-play drop-control text-muted" v-else>
                    <icon name="play-circle" scale="2"></icon>
                </a>
                <!--
                <a href="javascript:;;" class="btn btn-secondary btn-volume drop-control" @click="lowerVolume()">
                    <icon name="volume-down" scale="2"></icon>
                </a>

                <a href="javascript:;;" class="btn btn-secondary btn-volume drop-control" @click="increaseVolume()">
                    <icon name="volume-up" scale="2"></icon>
                </a> -->
            </div>

            <div class="volume-level">
                <vue-slider
                    @drag-start="setValue(value)"
                    @drag-end="setValue(value)"
                    v-model="value"
                    :processStyle="processStyle"
                    :bgStyle="bgStyle"
                    :clickable="false"
                    :tooltip="false"
                    :min="0"
                    :max="1"
                    :interval=".05"
                    :setValue="value"
                >
                </vue-slider>
            </div>
        </div>
        <div v-else>
            <a href="javascript:;;" @click="togglePlayback" class="drop-control" v-if="playing">
                <icon name="pause-circle" scale="8" @click="togglePlayHandler" class="drop-control-single text-muted"></icon>
            </a>
            <a href="javascript:;;" @click="togglePlayHandler" class="drop-control" v-else>
                <icon name="play-circle" scale="8" class="drop-control-single text-muted"></icon>
            </a>

            <div class="volume-level">
                <vue-slider
                    @drag-start="setValue(value)"
                    @drag-end="setValue(value)"
                    v-model="value"
                    :processStyle="processStyle"
                    :bgStyle="bgStyle"
                    :clickable="false"
                    :tooltip="false"
                    :min="0"
                    :max="1"
                    :interval=".10"
                    :setValue="value"
                >
                </vue-slider>
            </div>
        </div>
    </div>
</template>

<script>
import VueHowler from 'vue-howler';
import Icon from 'vue-awesome/components/Icon';
import vueSlider from 'vue-slider-component';
import { EventBus } from '../app.js';

export default {
    mixins: [VueHowler],
    props: [
        'single'
    ],
    data() {
        return {
            value: .5,
            processStyle: {
                backgroundImage: '-webkit-linear-gradient(left, #3498db, #f05b72)'
            },
            bgStyle: {
                backgroundColor: '#CCC',
                boxShadow: '0px 0px 20px 4px rgba(176, 224, 230, .3)'
            }
        }
    },
    computed: {},
    components: {
        'Icon': Icon,
        'vueSlider': vueSlider
    },
    mounted() {
        this.setVolume(this.value);
        console.log('Audio Player Component mounted.');
    },
    methods: {
        togglePlayHandler() {
            this.togglePlayback();
        },
        increaseVolume() {
            this.value += .10;
            this.setVolume(this.value);
        },
        lowerVolume() {
            this.value -= .10
            this.setVolume(this.value);
        },
        setValue(value) {
            this.setVolume(value);
        }
    }
}
</script>

<style scoped>
.btn {
    padding: 0.250rem 1rem;
}
.btn-play {
    min-width: 100px;
}
.btn-volume {
    min-width: 75px;
}
.volume-level {
    margin: 10px 0 0 0;
    padding: 0;
}
.btn-secondary {
    color: #292b2c;
    background: rgba(255, 255, 255, .5);
    border: 1px solid #FFF;
}
.btn-secondary:hover {
    color: #4193D3;
    background: rgba(99, 108, 114, .5);
    border: 1px solid #4193D3;
}
.drop-control {
    margin: 5px;
}
.drop-control:hover {
    color: #4193D3 !important;
}
.drop-control-single {
    color: #FFF;
    opacity: .5
}
.drop-control-single:hover {
    color: #FFF;
    opacity: 1;
}
</style>
