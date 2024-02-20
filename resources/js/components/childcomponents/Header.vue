<template> 
    <de-header v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='DE'))"></de-header>
    <en-header v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='EN'))"></en-header>
</template>

<script>
    import Header_DE from './Header_DE.vue'
    import Header_EN from './Header_EN.vue'

    import { defineComponent } from 'vue';
    export default defineComponent({
        name: 'HeaderElement',

        data() {
            return {
                crtLanguage: null
            }
        },

        components: {
            'de-header': Header_DE,
            'en-header': Header_EN,
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
