<template>
    <div v-if="(note==='')"> 
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-7 col-12">
                <h2 class="mb-3">
                    <strong v-if="((theSpecies.englishName) && (theSpecies.englishName.length>0))">
                        <span v-html="theSpecies.englishName"></span>
                        <span v-html="` <em>(${theSpecies.scientificName})</em>`"></span>
                    </strong>
                    <strong v-else v-html="` <em>${theSpecies.scientificName}</em>`">

                    </strong>
                </h2>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5 col-12">
                <h4 class="mt-2 mb-3 text-end">
                    <span v-html="theSpecies.author"></span>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <image-gallery v-if="((theSpecies) && (theSpecies.speciesPKID>0))" :speciesid="theSpecies.speciesPKID" :speciesscientific="theSpecies.scientificName"></image-gallery>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 border-end">
                <div class="row">
                    <div class="col-12">
                        <occurence-list v-if="((theSpecies) && (theSpecies.speciesPKID>0))" :speciesid="theSpecies.speciesPKID" :orthopteraid="theSpecies.orthopteraID" :speciesscientific="theSpecies.scientificName"></occurence-list> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <occurence-map v-if="((theSpecies) && (theSpecies.speciesPKID>0))" :speciesid="theSpecies.speciesPKID" :speciesscientific="theSpecies.scientificName"></occurence-map>
            </div>
        </div>
    </div>
    <!-- Fehler -->
    <div v-else>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-danger" v-html="note"></div>
            </div>
        </div>        
    </div>
</template>

<script>

  import { defineComponent } from 'vue';

  import ImageGallery from './SpeciesItem_ImageGallery_EN.vue';
  import OccurenceMap from './SpeciesItem_OccurenceMap_EN.vue';
  import OccurenceList from './SpeciesItem_LastOccurences_EN.vue';


  export default defineComponent({
        name: "SpeciesItem",
        data() {
            return {
                crtLanguage: 'EN',
                theURL: '',
                theSpecies: {}, 
                note: '',
            }
        },
        components: {
           'image-gallery': ImageGallery,
           'occurence-list': OccurenceList,
           'occurence-map': OccurenceMap
        },
        methods: {
            getSpeciesByName(url) {
                let self=this;
                axios.get(`${API_URL}/api/species/by/url/${url}`)
                    .then(function(response) {
                        if ((response.data) && (response.data.length>0))
                        {
                            self.theSpecies = response.data[0];
                        }
                        else 
                        {
                            self.note = "<h1 style='text-center'>Ups! We are terribly sorry, but ...</h1><p>Zu <em><strong>" + self.theURL + "</strong></em> couldn't be found on our pages! Please double check the name.</p>"
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Species could not be loaded!'
                        })
                    });                    
            },
     
        },

        mounted() {

            // eine Sicherung muss her .. wenn jemand einen englischsprachigen Pfad 
            // bei deutscher oder keiner Sprache eingibt, 
            // wird die Sprache neu gesetzt und die Seite neu geladen
            if (sessionStorage.getItem('language')) 
            {
                if (sessionStorage.getItem('language') !== this.crtLanguage) 
                {
                    sessionStorage.setItem('language', this.crtLanguage);
                    location.reload();
                }
            } 
            else 
            {
                sessionStorage.setItem('language', this.crtLanguage);
                location.reload();                
            }            

            this.theURL = this.$route.params.url
            this.getSpeciesByName(this.theURL);
        }
  });


</script>
