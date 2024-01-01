<template>
    <div>
        <div class="row">
          <div class="col-6">
            <!-- Titel -->
            <div class="row">
              <div class="col-12">
                <label for="Bild">Titel</label>
              </div>
              <div class="col-11">
                <input type="text" class="form-control" name="title" v-model="title" placeholder="kein Zwang, erleichtert das Auffinden">
              </div>
              <div class="col-1">
                <span class="text-success icon checked"></span>
              </div>
            </div>
            <hr>
            <!-- Copyright -->
            <div class="row">
              <div class="col-12">
                <label for="Copyright">Copyright</label>
              </div>
              <div class="col-11">
                <copyright-owner></copyright-owner>
              </div>
              <div class="col-1">
                <span v-if="copyrightID===-99" class="text-danger icon delete"></span>
                <span v-else class="text-success icon checked"></span>
              </div>
            </div>
            <hr>
            <!-- Speicherort -->
            <div class="row">
              <div class="col-12">
                <label for="Speicherort">Speicherort</label>
              </div>
              <div class="col-11">
                <image-folder></image-folder>
              </div>
              <div class="col-1">
                <span v-if="folder===''" class="text-danger icon delete"></span>
                <span v-else class="text-success icon checked"></span>
              </div>
            </div>
            <hr>
          </div>
          <div class="col-6">
            <label for="Bild">Bild / Cover etc.</label>
            <vue-dropzone ref="myVueDropzone"
                 :class="(uploadActive) ? 'active' : 'inactive'"

                 id="dropzone"
                 v-on:vdropzone-sending="uploadingImage"
                 :options="dropzoneOptions"></vue-dropzone>
            <hr>
            <h5>Aktuelles Bild</h5>
            <div  v-if="imgID>0">
              <small v-html="`${img.folder}${img.fn}`"></small>
              <figure>
                <img :src="`${img.folder}${img.fn}`" class="img-thumbnail img-fluid" alt="" style="max-height:400px;">
              </figure>
              <br>
              <button type="button" class="btn btn-danger"
                      name="button" @click="deleteImage(imgID)">
                <span class="icon delete"></span>&nbsp;&nbsp;Bild löschen
              </button>
            </div>
            <div v-else>
              <small>
                <em>Aktuell ist kein Bild gespeichert.</em>
              </small>
            </div>
          </div>


        </div>
    </div>
</template>

<script>
    import { Form, HasError, AlertErrors } from 'vform'
    Vue.component(HasError.name, HasError)
    Vue.component(AlertErrors.name, AlertErrors)

    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    import CopyrightComponent from './../childcomponents/CopyrightComponent.vue';
    import ImageFolderComponent from './../childcomponents/ImageFolderComponent.vue';

    export default {
      name: 'ImageUploader',
      components: {
        'vueDropzone': vue2Dropzone,
        'copyright-owner': CopyrightComponent,
        'image-folder': ImageFolderComponent
      },
      data() {
        return {
          copyright: '',
          copyrightID: -99,
          folder: '',
          editMode: null,
          title: '',
          typeOfUpload: '',
          id: -1,
          imageExists: false,
          imgID: -1,
          img: new Form({
            fn: '',
            folder: '',
            title: '',
            copyrightID: -99,
          }),
          dropzoneOptions: {
              url: `/api/${this.$attrs.typeOfUpload}/imageupload`,
              thumbnailWidth: 150,
              maxFilesize: 10,
              addRemoveLinks: true,
              // dictDefaultMessage: "<img src=\"/images/pictures/people/39_berlinkarsten_sm.jpg\" class=\"img-thumbnail img-fluid\"/><br><i class='fas fa-cloud-upload-alt'></i><br>Teamfoto reinziehen oder per Mausklick laden",
              dictDefaultMessage: "<i class='fas fa-cloud-upload-alt'></i><br>Bild hineinziehen oder per Mausklick laden",
              headers: { "My-Awesome-Header": "header value" },
              options: {
                acceptedFiles: 'image/*'
              }
          },
          uploadActive: false,
        }
      },

      methods: {

        deleteImage(id) {
          var self = this;
          Swal.fire({
            title: "Bild löschen?",
            text: "Soll dieses Bild wirklich gelöscht werden? ",
            showCancelButton: true,
            showConfirmButton: true,
            focusCancel: true,
            icon: 'warning',
          })
          .then(function(tobeDeleted) {
            if (tobeDeleted.value===true) {
              axios.delete(`api/images/${id}`)
                .then(function(response) {
                    Toast.fire({
                      icon: 'success',
                      title: 'Das Bild wurde gelöscht! '
                    });
                    self.form.imgID = -1;
                    self.imageExists = false;
                    self.img.reset();
                })
                .catch(() => {
                  PersistantToast.fire({
                    icon: 'error',
                    title: 'Whoops! Das Bild konnte nicht gelöscht werden'
                  })
                });
            }
          });
        },

        // versucht das Bild zu laden bzw. prüft die Existenz via jQuery
        getImage() {
          let self = this;
          axios.get(`api/images/${this.imgID}`)
            .then(function(response) {
              let url = response.data.folder+response.data.fn;
              self.img = response.data;
              self.title = response.data.title;
              $.get(url)
                .done(function() {
                    self.imageExists = true;
                }).fail(function() {
                    self.imageExists = false;
                })
            });
        },

        // Person aus URL laden
        getPerson() {
          axios.get(`api/persons/${this.id}`)
            .then(response => {
              if (response.data.imgID>0) {
                this.imgID = response.data.imgID;
                this.getImage();
              }
            })
            .catch(() => {
              PersistantToast.fire({
                icon: 'error',
                title: 'Im URL angehängte ID konnte nicht geladen werden!'
              })
            })
        },

        // zum Bild müssen noch die Infos hinzu
        uploadingImage(file, xhr, formData) {
          formData.append('imgID', this.imgID);
          formData.append('personID', this.userID);
          formData.append('ownerID', this.copyrightID);
          formData.append('folder', this.folder);
          formData.append('title', this.title);
          formData.append('typeOfUpload', this.typeOfUpload);
        }
      },
      mounted() {
        // ohne Metadaten disabled
        this.$refs.myVueDropzone.disable();
        this.uploadActive = false;
        this.editMode = (this.$route.params.id>0);
        this.id = this.$route.params.id;
        this.typeOfUpload = this.$attrs.typeOfUpload;
        switch (this.typeOfUpload) {
          case "all":
              this.imgID = this.$route.params.id;
              this.getImage();
            break;
          case "persons":
              this.getPerson();
            break;
          default:

        }

        // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // Notifications
        this.$eventBus.$on('copyrightSelected', (copyPKID, copyTitle) => {
          this.copyright = copyTitle;
          this.copyrightID = copyPKID;
          if ((this.folder.length>0) && (this.copyrightID>-2)) {
            this.$refs.myVueDropzone.enable();
            this.uploadActive = true;
          }
        });
        this.$eventBus.$on('folderSelected', (folder) => {
          this.folder = folder;
          if ((this.folder.length>0) && (this.copyrightID>-2)) {
            this.$refs.myVueDropzone.enable();
            this.uploadActive = true;
          }
        });
      }
    }
</script>
<style media="screen">
  .active {
      opacity: 1;
      background-color: #e5eff5;
      cursor: pointer;
  }

  .inactive {
      opacity: .3;
      background-color: $e0e0e0;
      cursor: default;
  }

</style>
