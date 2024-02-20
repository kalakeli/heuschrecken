<template>
    <div>
        <de-orthoptera v-if="((crtLanguage) && (crtLanguage.toUpperCase()==='DE'))"></de-orthoptera>
        <en-orthoptera v-if="((crtLanguage) && (crtLanguage.toUpperCase()==='EN'))"></en-orthoptera>       
    </div>
</template>


<script>
  import Orthoptera_DE from './../orthopteraweb/LandingPageOrthopteraWeb_DE.vue'
  import Orthoptera_EN from './../orthopteraweb/LandingPageOrthopteraWeb_EN.vue'

  import { defineComponent } from 'vue';
  export default defineComponent({
        name: "LandingOrthopteraElement",
        data() {
            return {
                crtLanguage: null
            }
        },
        components: {
            'de-orthoptera': Orthoptera_DE,
            'en-orthoptera': Orthoptera_EN,           
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
  });
</script>
