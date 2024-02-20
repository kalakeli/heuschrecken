<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Projekt <span v-html="theAction"></span>
                        <router-link to="/cms/methodik/liste">
                            <button class="btn btn-sm btn-primary float-end ms-3" title="Methodikliste anzeigen">
                                <span class="icon list"></span>
                            </button>
                        </router-link>                        
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="onSave" @keydown="form.onKeydown($event)" >

                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-8 col-12">
                                    <div class="form-group mb-3">
                                        <label for="Title"><small>Titel <sup class="icon mandatory"></sup></small></label>
                                        <input v-model="form.methodTitle"
                                                name="methodTitle"
                                                type="text"
                                                @blur="onBlur"
                                                class="form-control"
                                                >
                                        <div class="form-error" v-if="form.errors.has('methodTitle')" v-html="form.errors.get('methodTitle')" />
                                    </div>
                                    <hr>
                                    <div class="form-group mb-3">
                                        <label for="Title"><small>URL <sup class="icon mandatory"></sup></small></label>
                                        <input v-model="form.methodUrl"
                                                name="methodUrl"
                                                type="text"
                                                class="form-control"
                                                >
                                        <div class="form-error" v-if="form.errors.has('methodUrl')" v-html="form.errors.get('methodUrl')" />
                                    </div>
                                    <hr>
                                    <div class="form-group mb-3">
                                        <label for="Title"><small>Teaser <sup class="icon mandatory"></sup></small></label>
                                        <small><small class="text-body-tertiary"><br>Das ist der Text, der in der Übersicht zur Meldung angezeigt wird und die Leute animieren soll, die Meldung zu öffnen</small></small>
                                        <input v-model="form.methodTeaser"
                                                name="methodTeaser"
                                                type="text"
                                                class="form-control"
                                                >
                                        <div class="form-error" v-if="form.errors.has('methodTeaser')" v-html="form.errors.get('methodTeaser')" />
                                    </div>
                                    <hr>
                                </div>
                                <!-- Bild zur Kontrolle -->
                                <div class="col-lg-3 col-md-3 col-sm-4 col-12 text-end">
                                    <figure v-if="form.theImg">
                                        <img :src="`/${form.theImg}`" alt="Bild - muss als _mi.jpg vorliegen" class="img-fluid rounded">
                                    </figure>
                                    <div v-else>- kein Titelbild -</div>
                                    
                                    <!-- (neues) Bild -->
                                    <div class="form-group mb-3">
                                        <label for="Bild-ID" class="text-start"><small>Bild-ID - <router-link to="./../images/liste" target="_blank"><button type="button" class="btn btn-sm btn-outline-dark">in neuem Tab suchen</button></router-link></small></label>
                                        <input v-model="form.imgID"
                                                name="imgID"
                                                type="number"
                                                @blur="getImage()"
                                                class="form-control">
                                                <small class="text-primary" v-html="`<em>${form.imgTitle}</em>`"></small>
                                        <div class="form-error" v-if="form.errors.has('imgID')" v-html="form.errors.get('imgID')" />

                                    </div>
                                    
                                    <!-- Bei Bild auch Bildtext einblenden -->
                                    <div class="form-group mb-3" v-if="form.theImg">
                                        <label for="Title"><small>Bildunterschrift</small></label>
                                        <textarea v-model="form.imgText"
                                                name="imgText"
                                                type="text"
                                                rows="5"
                                                class="form-control"
                                                ></textarea>
                                        <div class="form-error" v-if="form.errors.has('imgText')" v-html="form.errors.get('imgText')" />
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="Title"><small>Projekttext <sup class="icon mandatory"></sup></small></label>
                                    <small><small class="text-body-tertiary"><br>Der große Rest des Textes; unter VIEW kann man auch den Quellcode ansehen und kontrollieren, ob alles passt. </small></small>
                                    <html-editor v-model="form.methodText" :class="{ 'is-invalid': form.errors.has('methodText') }" name="methodText" id="methodText"></html-editor>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 border-end"> 
                                            <label for="Datum"><small>Datum Eintrag <sup class="icon mandatory"></sup></small></label>
                                            <input v-model="form.dateOfPublication"
                                                    name="dateOfPublication"
                                                    type="date"
                                                    class="form-control"
                                                    >
                                            <div class="form-error" v-if="form.errors.has('dateOfPublication')" v-html="form.errors.get('dateOfPublication')" />
                                        </div>
                                        <div class="col-6">

                                                <label for="Anzeige"><small>Sichtbarkeit <sup class="icon mandatory"></sup></small></label> <br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flagActive" value="1" id="flagActive1" v-model="this.form.flagActive" >
                                                    <label class="form-check-label" for="flagActive1">
                                                        <small>Eintrag wird angezeigt</small>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flagActive" value="0" id="flagActive2" v-model="this.form.flagActive">
                                                    <label class="form-check-label" for="flagActive2">
                                                       <small> Eintrag wird <strong>nicht</strong> angezeigt</small>
                                                    </label>
                                                </div>
                                                <div class="form-error" v-if="form.errors.has('flagActive')" v-html="form.errors.get('flagActive')" />
                                        </div>                                        
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                    <button type="type" class="btn btn-primary" :disabled="form.busy" @click="onSave">
                                        <span class="icon save"></span>&nbsp;&nbsp; 
                                        <span v-if="editMode">aktualisieren</span>
                                        <span v-else>speichern</span>
                                    </button> 
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
  import HtmlEditor from './../../../components/childcomponents/HtmlEditor.vue'; // Tiny; https://www.tiny.cloud/docs/tinymce/

  
  export default defineComponent({
        name: "MethodItem",
        data() {
            return {
                editMode: null,
                theAction: '',
                theID: null,
                form: new Form({
                    dateOfPublication: '', // dayjs().locale('de').format('DD.MM.YYYY'),
                    flagActive: 1, 
                    methodTitle: '', 
                    methodTeaser: '', 
                    methodText: '', 
                    methodUrl: '', 
                    imgID: -1, 
                    imgPath: '', 
                    imgText: '', 
                    imgTitle: '', 
                    theImg: null,
                })
            }
        },
        components: { "html-editor": HtmlEditor},
        methods: {
            // Projekt abfragen
            getImage() {
                let self=this;
                axios.get(`${API_URL}/api/images/${self.form.imgID}`)
                    .then(function(response) {
                        if ((response.data) && (response.data.length==1))
                        {
                            self.form.imgTitle = response.data[0].imgTitle
                            self.form.imgPath = response.data[0].imgPath
                            self.form.imgFN = response.data[0].imgFN
                            self.form.theImg = "./../../images/"+self.form.imgPath+'/'+self.form.imgFN.substr(0,self.form.imgFN.indexOf('.'))+'_mi.'+self.form.imgFN.substr(self.form.imgFN.indexOf('.')+1-self.form.imgFN.length)
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Bild konnte nicht geladen werden!'
                        })
                    }); 
            },
            // Projekt abfragen
            getMethod() {
                let self=this;
                axios.get(`${API_URL}/api/methods/${self.theID}`)
                    .then(function(response) {
                        if (response.data)
                        {
                            self.form.dateOfPublication = response.data.dateOfPublication; 
                            self.form.flagActive = response.data.flagActive; 
                            self.form.methodPKID = response.data.methodPKID; 
                            self.form.methodTitle = response.data.methodTitle; 
                            self.form.methodText = response.data.methodText;
                            self.form.methodTeaser = response.data.methodTeaser;
                            self.form.methodUrl = response.data.methodUrl;
                            self.form.imgID = response.data.imgID;
                            self.form.theImg = response.data.theImg;
                            self.form.imgPath = response.data.imgPath;
                            self.form.imgText = response.data.imgText;
                            self.form.imgTitle = response.data.imgTitle;

                            // Text an Editor schiclen
                            self.emitter.emit('methodtext-loaded', self.form.methodText);
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Art konnte nicht geladen werden!'
                        })
                    }); 
            },


            // wird das Titelfeld verlassen, wird ein lesbarer URL für die Anzeige generiert
            onBlur(event) {
                let val = event.target.value;
                axios.post(`${API_URL}/api/methods/friendlyurl`, { params: {
                   url: this.form.methodTitle
                }})  
                .then(({ data }) => {
                    this.form.methodUrl = data;
                });
            },

            onSave() {
                if (this.form.methodPKID>0) 
                {
                    axios.put(`${API_URL}/api/methods/${this.form.methodPKID}`, { params: {
                            id: this.form.methodPKID, 
                            form: this.form
                        }})  
                        .then(function(response) {
                            if ((response.data))
                            {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Eintrag wurde aktualisiert'
                            })                            
                            }
                        })
                        .catch(() => {
                            PersistantToast.fire({
                                icon: 'error',
                                title: 'Der Eintrag konnte nicht aktualisiert werden!'
                            })
                        });  
                }
                else 
                {
                    this.form.post(`${API_URL}/api/methods`)
                        .then(function(response) {
                            if ((response.data))
                            {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Eintrag wurde gespeichert'
                            })                            
                            }
                        })
                        .catch(() => {
                            PersistantToast.fire({
                                icon: 'error',
                                title: 'Eintrag konnte nicht gespeichert werden!'
                            })
                        });                  
                }
            }, 

        },
        mounted() {            
            this.form.dateOfPublication = new Date().toLocaleDateString("de-DE");;
            
            this.theID = this.$route.params.id; 
            this.editMode = (this.theID > 0) ? true : false;
            this.theAction = (this.theID > 0) ? " bearbeiten " : " eingeben ";
            if (this.theID>0)
            {
                this.getMethod();
            }

            // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
            // E V E N T S
            // - ein Eintrag wurde gemacht ... 
            let self = this
            self.emitter.on('editor-text', (item) => {
                self.form.methodText = item

            });                
        }
  });


</script>
