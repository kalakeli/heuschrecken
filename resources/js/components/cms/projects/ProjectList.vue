<template>
    <div >
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Projektliste<span v-if="nrOfEntries>0" v-html="`: <strong class='text-primary'>${nrOfEntries}</strong> Projekte`"></span>
                        <router-link to="/cms/projekte/-1">
                            <button class="btn btn-sm btn-primary float-end ms-3" title="neues Projekt hinzufügen">
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
                                    <template #item-flagActive="item">
                                        <input type="checkbox" :checked="item.flagActive" disabled>
                                    </template>                                
                                    <template #item-img="item">
                                        <img :src="`/${item.theImg}`" alt="Bild" class="img-fluid img-thumbnail my-1" />
                                    </template>                                
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
        name: "ProjectItem",
        data() {
            return {
                nrOfEntries: 0,
                projectList: [], 
                headers: [
                    { text: " ", value: "operation" },
                    { text: "Angezeigt", value: "flagActive", sortable: false  },
                    { text: "Bild", value: "img", sortable: false  },
                    { text: "Titel", value: "projectTitle", sortable: true },
                    { text: "Teaser", value: "projectTeaser", sortable: true },
                    { text: "Datum", value: "dateOfPublication", sortable: true},
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
            getProjects() {
                let self=this;
                axios.get(`${API_URL}/api/projects`)
                    .then(function(response) {
                        if ((response.data))
                        {
                            // self.items = response.data;
                            self.projectList = response.data;
                            self.nrOfEntries = response.data.length;
                            self.items = response.data;
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
                let theProject = JSON.parse(JSON.stringify(item));
                Swal.fire({
                    title: "Projekt löschen?",
                    text: "Soll das Projekt wirklich gelöscht werden? ",
                    showCancelButton: true,
                    showConfirmButton: true,
                    focusCancel: true,
                    icon: 'warning',
                })
                .then(function(tobeDeleted) {
                    if (tobeDeleted.value===true) {
                        axios.delete(`${API_URL}/api/project/${theProject.projectPKID}`)
                        .then(function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Das Projekt wurde gelöscht! '
                            });
                            self.items = self.items.filter( (item) => { 
                                return item.projectPKID !== theProject.projectPKID
                            })
                        })
                        .catch(() => {
                            PersistantToast.fire({
                                icon: 'error',
                                title: 'Whoops! Das Projekt konnte nicht gelöscht werden'
                        })
                        });
                    }
                });
            },
            // click in table to edit
            onEdit(item) {
                let theProject = JSON.parse(JSON.stringify(item));
                location.href="./" + theProject.projectPKID;
            },            
        },
        mounted() {
            this.getProjects();
        }
  });


</script>