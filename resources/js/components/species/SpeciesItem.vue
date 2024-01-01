<template>
    <div v-if="(note==='')"> 
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-7 col-12">
                <h2 class="mb-3">
                    <strong>
                        <span v-html="theSpecies.germanName"></span>
                        <span v-html="` <em>(${theSpecies.scientificName})</em>`"></span>                        
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

  import ImageGallery from './SpeciesItem_ImageGallery.vue';
  import OccurenceMap from './SpeciesItem_OccurenceMap.vue';
  import OccurenceList from './SpeciesItem_LastOccurences.vue';


  export default defineComponent({
        name: "SpeciesItem",
        data() {
            return {
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
                            self.note = "<h1 style='text-center'>Ups! Entschuldigen Sie, aber ...</h1><p>Zu <em><strong>" + self.theURL + "</strong></em> konnte auf unseren Seiten nichts gefunden werden! Bitte überprüfen Sie den Namen.</p>"
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Art konnte nicht geladen werden!'
                        })
                    });                    
            },
     
        },

        mounted() {

            this.theURL = this.$route.params.url
            this.getSpeciesByName(this.theURL);
        }
  });


</script>
