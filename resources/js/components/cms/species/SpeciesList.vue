<template>
    <div >
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Artenliste<span v-if="nrOfEntries>0" v-html="`: <strong class='text-primary'>${nrOfEntries}</strong> Arten`"></span>
                        <router-link to="/cms/arten/-1">
                            <button class="btn btn-sm btn-primary float-end ms-3" title="neuen Eintrag hinzufügen">
                                <span class="icon plus"></span>
                            </button>
                        </router-link>
                    </div>
                    <div class="card-body">
                        <transition name="fade" class="slide-fade">  
                                <EasyDataTable                         
                                    buttons-pagination
                                    alternating
                                    :headers="headers"
                                    :items="items"
                                    @click-row="showRow"
                                    :rows-per-page="100"
                                    :sort-by="sortBy"
                                    :sort-type="sortType"                            
                                > 
                                    <template #item-operation="item">
                                        <div class="operation-wrapper">
                                            <button class="btn btn-sm btn-danger btnWidth me-1 my-1" @click="onDelete(item)"> 
                                                <span class="icon delete"></span>
                                            </button>
                                            <button class="btn btn-sm btn-primary btnWidth me-1 my-1" @click="onEdit(item)"> 
                                                <span class="icon edit"></span>
                                            </button>
                                        </div>
                                    </template>                                
                                </EasyDataTable> 
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  import { defineComponent } from 'vue';

  export default defineComponent({
        name: "SpeciesList",
        data() {
            return {
                nrOfEntries: 0,
                speciesList: [], 
                headers: [
                    { text: " ", value: "operation" },
                    { text: "Artname (de)", value: "germanName", sortable: true  },
                    { text: "Artname (sc)", value: "scientificName", sortable: true },
                    { text: "Autor", value: "author", sortable: true },
                    { text: "Klasse", value: "familyScientific", sortable: true},
                    { text: "UnterKlasse", value: "subFamilyScientific", sortable: true},
                ],
                items: [], 
                sortBy: 'scientificName', 
                sortType: '',
            }
        },
        components: {
            EasyDataTable: window['vue3-easy-data-table'],
        },
        methods: {
            getSpecies() {
                let self=this;
                axios.get(`${API_URL}/api/species`)
                    .then(function(response) {
                        if ((response.data))
                        {
                            self.items = response.data;
                            self.speciesList = response.data;
                            self.nrOfEntries = response.data.length;

                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Artenliste konnte nicht geladen werden!'
                        })
                    });            
            },    
            // click in table to edit
            onDelete(item) {
                var self = this;
                let theSpecies = JSON.parse(JSON.stringify(item));
                Swal.fire({
                    title: "Art löschen?",
                    text: "Soll die Art wirklich gelöscht werden? ",
                    showCancelButton: true,
                    showConfirmButton: true,
                    focusCancel: true,
                    icon: 'warning',
                })
                .then(function(tobeDeleted) {
                    if (tobeDeleted.value===true) {
                        axios.delete(`${API_URL}/api/species/${theSpecies.speciesPKID}`)
                        .then(function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Die Art wurde gelöscht! '
                            });
                            self.items = self.items.filter( (item) => { 
                                return item.speciesPKID !== theSpecies.speciesPKID
                            })
                        })
                        .catch(() => {
                            PersistantToast.fire({
                                icon: 'error',
                                title: 'Whoops! Die Art konnte nicht gelöscht werden'
                        })
                        });
                    }
                });
            },
            // click in table to edit
            onEdit(item) {
                let theSpecies = JSON.parse(JSON.stringify(item));
                location.href="./" + theSpecies.speciesPKID;
            },

        }, 
        mounted() {
            this.getSpecies();

        }
  });


</script>