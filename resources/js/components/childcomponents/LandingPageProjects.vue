<template>
    <div>
        <de-projects v-if="((crtLanguage) && (crtLanguage.toUpperCase()==='DE'))"></de-projects>
        <en-projects v-if="((crtLanguage) && (crtLanguage.toUpperCase()==='EN'))"></en-projects>       
    </div>
</template>


<script>
  import Projects_DE from './../projects/LandingPageProjects_DE.vue'
  import Projects_EN from './../projects/LandingPageProjects_EN.vue'

  import { defineComponent } from 'vue';
  export default defineComponent({
        name: "LandingProjectsElement",
        data() {
            return {
                crtLanguage: null
            }
        },
        components: {
            'de-projects': Projects_DE,
            'en-projects': Projects_EN,           
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
