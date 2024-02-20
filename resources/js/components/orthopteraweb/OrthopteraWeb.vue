<template>
    <div>
      <de-orthopteraweb v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='DE'))"></de-orthopteraweb>
      <en-orthopteraweb v-if="((crtLanguage) && (crtLanguage.toUpperCase()=='EN'))"></en-orthopteraweb>
    </div>
</template>

<script>
    import OrthopteraWeb_DE from './OrthopteraWeb_DE.vue'
    import OrthopteraWeb_EN from './OrthopteraWeb_EN.vue'

    import { defineComponent } from 'vue';
    export default defineComponent({
        name: 'OrthopteraWeb',

        data() {
            return {
                crtLanguage: null
            }
        },

        components: {
            'de-orthopteraweb': OrthopteraWeb_DE,
            'en-orthopteraweb': OrthopteraWeb_EN,
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
