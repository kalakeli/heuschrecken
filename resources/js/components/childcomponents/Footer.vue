<template> 
    <de-footer v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='DE'))"></de-footer>
    <en-footer v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='EN'))"></en-footer>
</template>

<script>
    import Footer_DE from './Footer_DE.vue'
    import Footer_EN from './Footer_EN.vue'

    import { defineComponent } from 'vue';
    export default defineComponent({
        name: 'HeaderElement',

        data() {
            return {
                crtLanguage: null
            }
        },

        components: {
            'de-footer': Footer_DE,
            'en-footer': Footer_EN,
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
