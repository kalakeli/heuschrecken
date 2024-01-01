<template>
  <div class="container-fluid mt-3 mb-5">
    <div class="row">
      <div class="col-12">
        <h3 class="mb-3">Liste aller eingetragenen <strong class="text-dda-blue" v-if="count>0" v-html="count"></strong> Bilder und Grafiken</h3>
        <p>
          <small>Klicke auf den Spaltennamen um zu sortieren, auf das "dropdown"-Menu um zu filtern. </small> <br>
          <small><strong class="text-primary">Neue Bilder</strong> müssen aktuell händisch vorbereitet und hochgeladen werden. Dafür werden von jeder Aufnahme 4 Versionen hochgeladen.</small> <br>
          <small>Aus Gründen der Ästhetik empfehle ich für den Fall, dass kein Bild vorliegt, als <strong>ID 179</strong> einzugeben, den Dummy.</small>

        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 border-end">
        <h5>Bilder (16:9)</h5>
        <ul class="checkedList">
            <li><small><strong>_sm </strong> - 250x141 Pixel</small></li>
            <li><small><strong>_mi </strong> - 400x225 Pixel</small></li>
            <li><small><strong>_lg </strong> - 600x337 Pixel</small></li>
            <li><small><strong>_xl </strong> - 800x450 Pixel</small></li>
        </ul>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-12">
        <router-link to="/cms/images/-1">
          <button type="submit" class="btn btn-primary float-end mb-3" title="Neuen Eintrag">
            <i class="fas fa-plus-circle"></i>
          </button>
        </router-link>        
      </div>
    </div>     -->
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
                <template #item-flagSlider="item">
                    <input type="checkbox" :checked="item.flagSlider" disabled>
                </template>
                <template #item-img="item">
                    <img :src="`/${item.img_sm}`" alt="Bild" class="img-fluid img-thumbnail my-1" />
                </template>                             
                <template #item-operation="item">
                    <div class="operation-wrapper">
                        <button class="btn btn-sm btn-danger btnWidth me-1 my-1" @click="onDelete(item)"> 
                            <span class="icon delete"></span>
                        </button>
                        <!-- <button class="btn btn-sm btn-primary btnWidth me-1 my-1" @click="onEdit(item)"> 
                            <span class="icon edit"></span>
                        </button> -->
                    </div>
                </template>                                
            </EasyDataTable> 
    </transition>
    
  </div>


</template>

<script>
  import { defineComponent } from 'vue';

  export default defineComponent({
    data() {
      return {
          count: 0,
          headers: [
              { text: " ", value: "operation" },
              { text: "ID", value: "imgPKID", sortable: true  },
              { text: "Art", value: "imgTitle", sortable: true },
              { text: "Geschlecht", value: "gender", sortable: true },
              { text: "Copyright", value: "copyrightTitle", sortable: true },
              { text: "Pfad", value: "imgPath", sortable: true },
              { text: "Dateiname", value: "imgFN", sortable: true},
              { text: "Bild", value: "img", sortable: false},
              { text: "Banner", value: "flagSlider", sortable: true},
          ],
          items: [], 
      }
    },
    components: {
    }, 
    methods: {
        getImages() {
            let self=this;
            axios.get(`${API_URL}/api/images/nonspecies`)
                .then(function(response) {
                    console.log(response.data);
                    self.count = response.data.length;
                    self.items = response.data.map( (item) => {
                        if (item.flagSlider == 0)
                        {
                          item.img_sm = "images/" + item.imgPath + "/" + item.imgFN.substr(0, item.imgFN.lastIndexOf(".")) + "_sm." + item.imgFN.substr((item.imgFN.lastIndexOf(".")+1) - item.imgFN.length);
                        }
                        else 
                        {
                          item.img_sm = "images/" + item.imgPath + "/" + item.imgFN.substr(0, item.imgFN.lastIndexOf(".")-2) + "_sm." + item.imgFN.substr((item.imgFN.lastIndexOf(".")+1) - item.imgFN.length);
                          console.log(item.img_sm);
                        }
                        return item;                      
                    });
                    // response.data.forEach(element => {
                    //     self.items.push(
                    //       [element.imgPKID, element.germanName + " ("+element.scientificName+")", element.genderHTML, element.imgTitle, element.copyrightTitle, element.imgPath, element.imgFN, "<img src='./../../../images/"+element.imgPath+"/"+element.imgFN.substr(0, element.imgFN.indexOf(".")) + "_sm" + element.imgFN.substr(element.imgFN.indexOf("."))+"' alt='bild' class='img-fluid rounded mx-1 my-1'>", (element.flagSlider==0) ? false : true]
                    //     )
                    // });

                })
                .catch(() => {
                    PersistantToast.fire({
                        icon: 'error',
                        title: 'Liste der Bilder / Grafiken konnte nicht geladen werden!'
                    })
                });            
        },

        onDelete(item) {
                var self = this;
                let theImage = JSON.parse(JSON.stringify(item));
                Swal.fire({
                    title: "Aufnahme löschen?",
                    text: "Soll die Aufnahme wirklich gelöscht werden? ",
                    showCancelButton: true,
                    showConfirmButton: true,
                    focusCancel: true,
                    icon: 'warning',
                })
                .then(function(tobeDeleted) {
                    if (tobeDeleted.value===true) {
                        axios.delete(`${API_URL}/api/images/${theImage.imgPKID}`)
                        .then(function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Die Aufnahme wurde gelöscht! '
                            });
                            self.items = self.items.filter( (item) => { 
                                return item.imgPKID !== theImage.imgPKID
                            })
                        })
                        .catch(() => {
                            PersistantToast.fire({
                                icon: 'error',
                                title: 'Whoops! Die Aufnahme konnte nicht gelöscht werden'
                        })
                        });
                    }
                });
        }, 

        onEdit(item) {
            let theImage = JSON.parse(JSON.stringify(item));
            location.href="./" + theImage.imgPKID;          
        } 

    }, 
    mounted() {
        console.log("Artbilder");
        this.getImages();
    }
  });
</script>

