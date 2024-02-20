<template>
    <div>
      <de-banner v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='DE'))"></de-banner>
      <en-banner v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='EN'))"></en-banner>
    </div>
</template>

<script>
    import BannerImage_DE from './BannerImage_DE.vue'
    import BannerImage_EN from './BannerImage_EN.vue'

    import { defineComponent } from 'vue';
    export default defineComponent({
        name: 'BannerElement',

        data() {
            return {
                crtLanguage: null
            }
        },

        components: {
            'de-banner': BannerImage_DE,
            'en-banner': BannerImage_EN,
        },
        computed: {

        },
        methods: {

        },
        mounted() {
            if (sessionStorage.getItem('language')) 
            {
                this.crtLanguage = sessionStorage.getItem('language')
            } 
            else 
            {
                this.crtLanguage = 'DE'
            }
        }
    })
</script>
