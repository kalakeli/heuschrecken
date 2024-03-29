<template>
    <div>
        <button v-for="item in languages" :key="item.lang" class="btn btn-lg btn-outline-dark text-white pt-1 mt-0" style="border-color:transparent" @click="switchLanguage(item.lang)">
            <!-- <span v-html="item.lang"></span> -->
            <img :src="item.icon" :alt="`Flag ${item.lang}`" class="img-fluid">
        </button>
    </div>
</template>

<script>
    export default {
      name: 'LanguageSwitch',

      data() {
        return {
            languageList: [
                { lang: "DE", language: "Deutsch", switchTo: "EN", icon: 'images/icons/flag_german.svg'  },
                { lang: "EN", language: "English", switchTo: "DE", icon: 'images/icons/flag_english.svg' }
            ], 
            menuItems: [
                { item_de: "orthopteraweb", item_en: "orthopteraweb" },
                { item_de: "projekte", item_en: "projects" },
                { item_de: "methodik", item_en: "methods" },
                { item_de: "artenliste", item_en: "species" },
            ],
            path: null,
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
            let newPath = "";
            sessionStorage.setItem('language', lang)

            let theItem = this.menuItems.filter( (item) => {
                if (lang==="EN") 
                {
                    if (this.path.includes(item.item_de)) { return item; }
                }
                else 
                {
                    if (this.path.includes(item.item_en)) { return item; }
                }
            })

            if (theItem.length==1) 
            {
                if (lang === "EN")  { newPath = this.path.replace(theItem[0].item_de, theItem[0].item_en) }
                else  { newPath = this.path.replace(theItem[0].item_en, theItem[0].item_de) }

                location.href="./"+newPath;
            } 
            else 
            {
                location.href="./"

            }
        },

      },
      mounted() {
        this.path = location.pathname.substring(1);
      }
    }
</script>
