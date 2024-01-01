<template>
  <div>
    <div class="row">
      <div class="col-12">
        <p v-model="folder">
          <span class="icon more" v-if="folder.length>0"></span> &nbsp;
          <span v-html="folder"></span>
        </p>
      </div>
    </div>
    <div>
      <ul class="folderList">
        <li v-for="folder in folders" :key="folder">
          <input type="radio" name="folder" v-bind:value="folder" v-on:click="selectImageFolder($event.target.value)">  {{ folder }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
    export default {
      name: "ImageFolders",
      data() {
        return {
          folder: '',
          folders: {}
        }
      },
      methods: {
        getFolders() {
          axios.get("/api/imagefolders")
               .then( (data) => {
                 this.folders = data.data;
               })
               .catch( (error) => {
                 Toast.fire({
                   type: 'error',
                   title: 'Verzeichnisse konnten nicht gelesen werden!'
                 })
               });
        },

        // Bild abfragen für Copyright
        getImage() {
          let self = this;
          axios.get(`api/images/${this.$route.params.id}`)
            .then(function(response) {
              self.folder = "./" + response.data.folder;

            });
        },

        selectImageFolder(folder) {
          this.folder=folder;
          this.$eventBus.$emit("folderSelected", folder);
        }
      },
      mounted() {
        this.getFolders();

        // wenn das Modul aus picturemanagement heraus gerufen wurde, Copyright lesen
        if (this.$route.path.indexOf('picturemanagement')!==-1) {
          this.getImage();
        }
      }
    }
</script>

<style>
ul.folderList {
  height: 250px;
  list-style-type: none;
  border-bottom: 1px solid #f0f0f0;
  overflow-x: scroll;
}
ul.folderList li:hover {
  background-color: #f0f0f0;
  transition: all 0.3s;
}
</style>
