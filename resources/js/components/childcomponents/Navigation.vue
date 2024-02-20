<template>
    <template v-if="crtLanguage==='DE'">
    <h4 class="text-white float-start mx-3 pt-2" id="topbar-title">
        <a href="./" class="text-white">Die Heuschrecken Deutschlands</a>
    </h4>
    <ul class="nav justify-content-end topbar-ul" id="myNav">
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="./">Home</a>
        </li>
      
        <li class="nav-item">
            <a class="nav-link" :class="((path) && (path.startsWith('orthopteraweb'))) ? 'active-item' : ''"  href="orthopteraweb">OrthopteraWeb</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="((path) && (path.startsWith('projekte'))) ? 'active-item' : ''" href="projekte">Projekte</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="((path) && (path.startsWith('methodik'))) ? 'active-item' : ''" href="methodik">Methodik</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" :class="((path) && (path.startsWith('artenliste'))) ? 'active-item' : ''" href="artenliste">Arten</a>
        </li>

        <language-switch></language-switch>
    </ul>
    </template>
    <template v-if="crtLanguage==='EN'">
        <h4 class="text-white float-start mx-3 pt-2" id="topbar-title" >
            <a href="./" class="text-white">Grasshoppers of Germany</a>
        </h4>    
        <ul class="nav justify-content-end topbar-ul" id="myNav" >
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="((path) && (path.startsWith('orthopteraweb'))) ? 'active-item' : ''" href="orthopteraweb">OrthopteraWeb</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="((path) && (path.startsWith('projects'))) ? 'active-item' : ''" href="projects">Projects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="((path) && (path.startsWith('methods'))) ? 'active-item' : ''" href="methods">Methods</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" :class="((path) && (path.startsWith('species'))) ? 'active-item' : ''" href="species">Species</a>
            </li>

            <language-switch></language-switch>
        </ul>
    </template>

</template>

<script>
    import LanguageSwitch from './LanguageSwitch.vue';
    export default {
      name: 'Navigation',
      components: {
          'language-switch': LanguageSwitch 
      },

      data() {
        return {
            languages: [
                { lang: "DE", language: "Deutsch", switchTo: "EN" },
                { lang: "EN", language: "English", switchTo: "DE" }
            ], 
            crtLanguage: "DE",
            path: null,
        }
      },

      computed: {

      },

      methods: {



      },
      mounted() {
          this.path = location.pathname.substring(1);
          if (sessionStorage.getItem('language')) 
          {
              this.crtLanguage = sessionStorage.getItem('language')
          }
      }
    }
</script>
