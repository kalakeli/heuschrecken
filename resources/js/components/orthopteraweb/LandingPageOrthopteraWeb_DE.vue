<template>
    <!-- <div style="background-color:#e9ecef; box-shadow: 0 30px 30px -10px rgba(0, 0, 0, .15);" class="py-3 px-3 rounded"> -->
    <div style="background-color:#f9f9f9;box-shadow: 0 30px 30px -10px rgba(0, 0, 0, .15);" class="py-3 px-3 rounded">
        <div class="row">
            <div class="col-12">
                <h1 class="title text-center mt-2 mb-3">OrthopteraWeb</h1>
                <p>
                    Werfen Sie einen Blick in die spannende Welt der Heuschrecken und ihrer Verwandten. 
                    Mit dem Portal &bdquo;<em>OrthopteraWeb</em>&ldquo; möchten wir möglichst viele in Deutschland verfügbare Heuschreckenfunde bündeln und sichtbar machen.
                    Hier sehen Sie die letzten Einträge. Klicken Sie einen Eintrag aus der Liste links an, um zum Fund zu gelangen.
                </p>
            </div>
        </div>
        <transition name="fade" class="slide-fade">
            <div class="row">
                <div class="col-12">
                    <occurence-list></occurence-list> 
                </div>
            </div>            
        </transition>  
        <div class="row">
            <div class="col-12 text-end">
                <p class="title mt-2 mb-3">
                    <a href="orthopteraweb">
                        <button class="btn btn-sm btn-custom-lightgreen"> &nbsp;&nbsp;
                            <span class="icon more"></span>
                            mehr Informationen&nbsp;&nbsp;
                        </button>                        
                    </a>
                </p>
            </div>
        </div>        
    </div>
</template>


<script>

  import { defineComponent } from 'vue';
  import OccurenceList from './LastOccurences_DE.vue'

  export default defineComponent({
        name: "LandingPageOrthopteraWeb",
        data() {
            return {
                nrOfEntries: 0,
                projectList: [], 

            }
        },
        components: {
           'occurence-list': OccurenceList,
        },
        methods: {
            getProjects() {
                let self=this;
                axios.get(`${API_URL}/api/projects/limit/3`)
                    .then(function(response) {
                        if ((response.data))
                        {
                            // self.items = response.data;
                            self.projectList = response.data.map( (item) => {
                                item.formattedDate = new Intl.DateTimeFormat('de-DE').format(new Date(item.dateOfPublication));
                                return item;
                            });
                            self.nrOfEntries = response.data.length;
                            self.items = response.data;
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Projektliste konnte nicht geladen werden!'
                        })
                    });                    
            },
     
        },

        mounted() {
            // this.getProjects();
        }
  });


</script>
