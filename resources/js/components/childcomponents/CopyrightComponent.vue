<template>
    <div>
        <div class="row">
          <div class="col-12">
            <p v-model="copyright">
              <span class="icon more" v-if="copyright.length>0"></span> &nbsp;
              <span v-html="copyright"></span>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <input type="text" class="form-control" name="filter" autocomplete="off" v-model="term" placeholder="Copyrights filtern">
            <br><br>
            <small for="">Nicht gefunden? Dann ...</small>
            <form @submit.prevent="saveCopyright" @keydown="form.onKeydown($event)">
              <p>
                <input type="text" class="form-control" v-model="form.copyTitle" autocomplete="off" placeholder="neues Copyright eintragen">
              </p>
              <p>
                <button type="button" class="btn btn-primary"
                        name="button" @click="saveCopyright" :disabled="form.copyTitle.length==0">
                  <span class="icon save">&nbsp;&nbsp;&nbsp;Copyright speichern</span>
                </button>
              </p>
            </form>

          </div>
          <div class="col-6 scroll-250">
            <table class="table table-sm table-condensed tbl-borderless table-hover">
              <thead>
                <tr>
                  <td></td><td></td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="copy in showCopyList">
                  <td class="btnWidth">
                      <button type="button" class="btn btn-sm btn-link" name="button" @click="setCopyright(copy)">
<span class="icon plus"></span>
                      </button>

                  </td>
                  <td>
                    <small v-html="copy.copyTitle"></small>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</template>

<script>
    import { Form, HasError, AlertErrors } from 'vform'
    Vue.component(HasError.name, HasError)
    Vue.component(AlertErrors.name, AlertErrors)


    export default {
      name: 'CopyrightOwner',

      data() {
        return {
          form: new Form({
            copyTitle: ''
          }),
          term: '',
          copyright: '',
          copyrightID: -1,
          copyrightList: {}

        }
      },

      computed: {
          showCopyList() {
            let filter = new RegExp(this.term, 'i'); // Groß-Kleinschreibung ignorieren
            if (this.copyrightList.length>0) {
              return this.copyrightList.filter( (item) => {
                  return item.copyTitle.match(filter);
              });
            }
          }
      },

      methods: {

        // Copyright-Eintrag abfragen
        getCopyright(id) {
          axios.get(`api/copyrights/${id}`)
            .then(response => {
                this.copyright = response.data.copyTitle;
                this.copyrightID = response.data.copyPKID;
                this.form.copyTitle = response.data.copyTitle;
                this.$eventBus.$emit('copyrightSelected', response.data.copyPKID, response.data.copyTitle);
            })
        },

        // alle Copyright-Einträge abfragen
        getCopyrights() {
          axios.get(`api/copyrights`)
            .then(response => {
                this.copyrightList = response.data;
            })
            .catch(() => {
              PersistantToast.fire({
                icon: 'error',
                title: 'Whoops! Die Copyright-Einträge konnten nicht geladen werden'
              })
              this.$Progress.fail();
            });
        },

        // Bild abfragen für Copyright
        getImage() {
          let self = this;
          axios.get(`api/images/${this.$route.params.id}`)
            .then(function(response) {
              self.copyrightID = response.data.ownerID;
              self.getCopyright(self.copyrightID);
            });
        },


        // neues Copyright speichern
        saveCopyright() {
          if (this.form.copyTitle!=="") {
            this.form.post(`/api/copyrights`)
            .then(response => {
              Toast.fire({
                icon: 'success',
                title: 'Klasse, das Copyright wurde gespeichert!'
              })
              this.copyright = this.form.copyTitle;
              this.$eventBus.$emit('copyrightSelected', response.data.last_insert_id, this.form.copyTitle);
              this.form.reset();
            })
            .catch(() => {
              PersistantToast.fire({
                icon: 'error',
                title: 'Whoops! Copyright konnte nicht gespeichert werden - Vielleicht gibt es den Eintrag bereits? '
              })
            });
          }
        },

        setCopyright(item) {
          this.copyrightID = item.copyPKID;
          this.copyright = item.copyTitle;
          this.$eventBus.$emit('copyrightSelected', item.copyPKID, item.copyTitle);
        },

      },
      mounted() {
        this.getCopyrights();

        // wenn das Modul aus picturemanagement heraus gerufen wurde, Copyright lesen
        if (this.$route.path.indexOf('picturemanagement')!==-1) {
          this.getImage();
        }
      }
    }
</script>
