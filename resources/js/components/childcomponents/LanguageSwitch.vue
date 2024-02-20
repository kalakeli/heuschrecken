<template>
    <div>
        <button v-for="item in languages" :key="item.lang" class="btn btn-sm btn-outline-dark text-white mt-2" style="border-color:transparent" @click="switchLanguage(item.lang)">
            <span v-html="item.lang"></span>
        </button>
    </div>
</template>

<script>
    export default {
      name: 'LanguageSwitch',

      data() {
        return {
            languageList: [
                { lang: "DE", language: "Deutsch", switchTo: "EN" },
                { lang: "EN", language: "English", switchTo: "DE" }
            ], 
            crtLanguage: null
        }
      },

      computed: {
          languages() 
          {
              if (this.languageList) 
              {
                  if (sessionStorage.getItem('language')) 
                  {
                      return this.languageList.filter( (item) => {
                          return item.lang!==sessionStorage.getItem('language')
                      })
                  }
                  else 
                  {
                      sessionStorage.setItem('language', this.languageList[0].lang)
                      return this.languageList.filter( (item) => {
                          return item.lang!=='DE'
                      })                      
                  }
              }
          }
      },

      methods: {

        // Sprachwechsel
        switchLanguage(lang) {
            sessionStorage.setItem('language', lang)
            location.href="./"
            // if (lang === "DE") 
            // {
            //     location.href="./"
            // } 
            // else 
            // {
            //     location.href="./"+lang.toLowerCase()
            // }
        },

      },
      mounted() {

      }
    }
</script>
