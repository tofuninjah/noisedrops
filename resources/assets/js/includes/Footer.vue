<template>
    <nav class="navbar fixed-bottom">
        <social-sharing
            url="http://www.noisedrops.com" inline-template
            title="Drops some background noises to help you focus or relax."
            description="Noisedrops generates ambient sounds that allow you to concentrate or focus by drowning out distracting noises.  May also be used for relaxation."
            quote="Vue is a progressive framework for building user interfaces."
            hashtags="noisedrops, concentrate, focus, relax, whitenoise"
            media="http://www.noisedrops.com/images/noisedrops-dark.svg"
        >
            <footer class="container-fluid d-flex justify-content-around footer">
                <network network="facebook">
                    <a href="javascript:;;" class="footer__link"><icon name="facebook-square" scale="2" class="footer__icon"></icon></a>
                </network>
                <network network="twitter">
                    <a href="javascript:;;" class="footer__link"><icon name="twitter-square" scale="2" class="footer__icon"></icon></a>
                </network>
                <network network="googleplus">
                    <a href="javascript:;;" class="footer__link"><icon name="google-plus-square" scale="2" class="footer__icon"></icon></a>
                </network>
                <network network="pinterest">
                    <a href="javascript:;;" class="footer__link"><icon name="pinterest-square" scale="2" class="footer__icon"></icon></a>
                </network>
                <network network="linkedin">
                    <a href="javascript:;;" class="footer__link"><icon name="linkedin-square" scale="2" class="footer__icon"></icon></a>
                </network>
                <network network="weibo">
                    <a href="javascript:;;" class="footer__link"><icon name="weibo" scale="2" class="footer__icon"></icon></a>
                </network>
            </footer>
        </social-sharing>
    </nav>
</template>

<script>
    import SocialSharing from 'vue-social-sharing';

    export default {
        components: {
            'SocialSharing': SocialSharing
        },
        mounted() {}
    }
</script>

<style>
    .footer {
        width: 100%;
    }
    .footer__link {
        color: #FFF;
    }
    .footer__link:hover {
        color: powderblue;
    }
</style>
