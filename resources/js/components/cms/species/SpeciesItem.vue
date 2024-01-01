<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card bg-white">
                    <div class="card-header">
                        Art <span v-html="theAction"></span>
                        <router-link to="/cms/arten/liste">
                            <button class="btn btn-sm btn-primary float-end ms-3" title="Artenliste anzeigen">
                                <span class="icon list"></span>
                            </button>
                        </router-link>                        
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="onSubmit" @keydown="species.onKeydown($event)">

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                    <small>OrthopteraWeb (TaxonID)</small>
                                    <input type="text" class="form-control" v-model="species.orthopteraID" name="orthopteraID" placeholder="TaxonID (OrthopteraWeb)">
                                    <div class="form-error" v-if="species.errors.has('orthopteraID')" v-html="species.errors.get('orthopteraID')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <small>Ordnung</small>
                                    <select class="form-control" v-model="species.orderID" >
                                        <option value="-1">- bitte auswählen -</option>
                                        <option v-for="item in theOrders" :value="item.lutPKID" :key="item.lutPKID" v-html="`${item.scientificName} - ${item.germanName}`"></option>
                                    </select>
                                    <div class="form-error" v-if="species.errors.has('orderID')" v-html="species.errors.get('orderID')" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <small>Unterordnung</small>
                                    <select class="form-control" v-model="species.subOrderID" >
                                        <option value="-1">- bitte auswählen -</option>
                                        <option v-for="item in theSubOrders" :value="item.lutPKID" :key="item.lutPKID" v-html="`${item.scientificName} - ${item.germanName}`"></option>
                                    </select>
                                    <div class="form-error" v-if="species.errors.has('subOrderID')" v-html="species.errors.get('subOrderID')" />
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <small>Familie</small>
                                    <select class="form-control" v-model="species.familyID" >
                                        <option value="-1">- bitte auswählen -</option>
                                        <option v-for="item in theFamilies" :value="item.lutPKID" :key="item.lutPKID" v-html="`${item.scientificName} `"></option>
                                    </select>
                                    <div class="form-error" v-if="species.errors.has('familyID')" v-html="species.errors.get('familyID')" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                    <small>Unterfamilie</small>
                                    <select class="form-control" v-model="species.subFamilyID" >
                                        <option value="-1">- bitte auswählen -</option>
                                        <option v-for="item in theSubFamilies" :value="item.lutPKID" :key="item.lutPKID" v-html="`${item.scientificName} `"></option>
                                    </select>
                                    <div class="form-error" v-if="species.errors.has('subFamilyID')" v-html="species.errors.get('subFamilyID')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                    <small>Artname (dtsch.)</small>
                                    <input type="text" class="form-control" v-model="species.germanName" name="germanName" placeholder="dtsch. Artname">
                                    <div class="form-error" v-if="species.errors.has('germanName')" v-html="species.errors.get('germanName')" />
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                    <small>Artname (wiss.)</small>
                                    <input type="text" class="form-control" v-model="species.scientificName" name="scientificName" placeholder="wiss. Artname">
                                    <div class="form-error" v-if="species.errors.has('scientificName')" v-html="species.errors.get('scientificName')" />
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                    <small>Artname (engl.)</small>
                                    <input type="text" class="form-control" v-model="species.englishName" name="englishName" placeholder="engl. Artname">
                                    <div class="form-error" v-if="species.errors.has('englishName')" v-html="species.errors.get('englishName')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                    <small>Art-Autor</small>
                                    <input type="text" class="form-control" v-model="species.author" name="author" placeholder="Autor">
                                    <div class="form-error" v-if="species.errors.has('author')" v-html="species.errors.get('author')" />
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-12"><hr></div>
                            </div>       
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-sm btn-primary" type="submit" :disabled="species.busy">
                                            <span class="icon save"></span> &nbsp;&nbsp;
                                            <span v-html="theAction"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-3">
                                    <div class="d-grid gap-2">
                                        <button type="button" :disabled="species.speciesPKID===-1" class="btn btn-sm btn-danger" @click="onDelete">
                                            <span class="icon times"></span> &nbsp;&nbsp;
                                            löschen
                                        </button>
                                    </div>
                                </div>
                            </div>       

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  import { defineComponent } from 'vue';
  import Form from 'vform'

  export default defineComponent({
        name: "SpeciesItem",
        data() {
            return {
                theAction: '',
                theID: null,
                theFamilies: [],
                theSubFamilies: [],
                theOrders: [],
                theSubOrders: [],
                theSpecies: {}, 
                species: new Form({
                    author: '', 
                    englishName: '', 
                    familyID: -1, 
                    germanName: '', 
                    orderID: -1, 
                    orthopteraID: -1,
                    subFamilyID: -1, 
                    subOrderID: -1, 
                    scientificName: '', 
                    speciesPKID: -1,
                })
            }
        },
    
        components: {
            
        }, 
        methods: {
            getFamilies() {
                let self=this;
                axios.get(`${API_URL}/api/taxonomies/families`)
                    .then(function(response) {
                        if ((response.data) && (response.data.length>0))
                        {
                            self.theFamilies = response.data;
                        }
                    })
                    .catch(() => {});  
            },
            getSubFamilies() {
                let self=this;
                axios.get(`${API_URL}/api/taxonomies/subfamilies`)
                    .then(function(response) {
                        if ((response.data) && (response.data.length>0))
                        {
                            self.theSubFamilies = response.data;
                        }
                    })
                    .catch(() => {});  
            },
            getOrders() {
                let self=this;
                axios.get(`${API_URL}/api/taxonomies/orders`)
                    .then(function(response) {
                        if ((response.data) && (response.data.length>0))
                        {
                            self.theOrders = response.data;
                        }
                    })
                    .catch(() => {});  
            },
            getSubOrders() {
                let self=this;
                axios.get(`${API_URL}/api/taxonomies/suborders`)
                    .then(function(response) {
                        if ((response.data) && (response.data.length>0))
                        {
                            self.theSubOrders = response.data;
                        }
                    })
                    .catch(() => {});  
            },

            getSpecies() {
                let self=this;
                axios.get(`${API_URL}/api/species/by/id/${self.theID}`)
                    .then(function(response) {
                        if ((response.data) && (response.data.length>0))
                        {
                            self.species.speciesPKID = response.data[0].speciesPKID;                            
                            self.species.orderID = response.data[0].orderID;                            
                            self.species.subOrderID = response.data[0].subOrderID;                            
                            self.species.familyID = response.data[0].familyID;                            
                            self.species.subFamilyID = response.data[0].subFamilyID;                            
                            self.species.germanName = response.data[0].germanName;                            
                            self.species.scientificName = response.data[0].scientificName;                            
                            self.species.englishName = response.data[0].englishName;                            
                            self.species.author = response.data[0].author;                            
                            self.species.orthopteraID = response.data[0].orthopteraID;                            
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Art konnte nicht geladen werden!'
                        })
                    });            
            },    

            onDelete() {
                var self = this;
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
                        axios.delete(`${API_URL}/api/species/${self.species.speciesPKID}`)
                        .then(function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Die Art wurde gelöscht! '
                            });
                            setTimeout(() => {location.href='./../arten'}, 1500)
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
    
            onSubmit() {
                let self = this;
                if (this.species.speciesPKID === -1)  // Neueintrag
                {
                    self.species.post(`${API_URL}/api/species`)
                        .then(({ data }) => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Die Art wurde hinzugefügt.'
                            })
                    })
                    .catch((error) => {
                        // let errCode = error.response.status;
                        let errMsg = (error.response.data.message.indexOf("Duplicate entry")!==-1) ? "Doppelter Eintrag!" : "Serverfehler beim Eintrag" ;
                        PersistantToast.fire({
                            icon: 'error',
                            html: 'Leider konnte der Eintrag nicht durchgeführt werden! <br><strong>' + errMsg + '</strong>'
                        })
                    });  
                }  
                else                                  // Aktualisieren 
                {
                    self.species.put(`${API_URL}/api/species/${self.species.speciesPKID}`)
                        .then(({ data }) => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Die Art wurde aktualisiert.'
                            })
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Leider konnte der Eintrag nicht aktualisiert werden!'
                        })
                    });  
                }
            }

        }, 
        mounted() {
            this.getFamilies();
            this.getSubFamilies();
            this.getOrders();
            this.getSubOrders();
            this.theID = Number(this.$route.params.id); 
            this.theAction = (this.theID > 0) ? " aktualisieren " : " hinzufügen ";
            if (this.theID>0) 
            {
                this.getSpecies();
            }
        }
  });


</script>
