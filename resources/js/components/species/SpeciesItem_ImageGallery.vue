<template>
    <div class="row mb-3"  v-if="((this.imageList) && (this.imageList.length>0))">
        <div class="col-12">
            <h4>Bildergalerie <small>[klicken Sie ein Bild an für eine vergrößerte Version]</small> </h4>
            <transition name="fade" class="slide-fade">
                <div v-if="((this.imageList) && (this.imageList.length>0))">
                    <figure v-for="item in imageList" :key="item.imgPKID" class="float-start me-2 mb-2" style="max-width:250px;">
                        <a :href="item.img_lg" data-lightbox="gallery" :data-title="`${item.imgTitle}. &copy; ${item.copyrightTitle}`">
                        <!-- <a :href="item.img_lg" data-lightbox="gallery" :data-title="`${item.genderHTML} ${theScientificName}. &copy; ${item.copyrightTitle}`"> -->
                            <img :src="item.img_sm" alt="SpeciesPicture" class="img-fluid img-thumbnail">
                        </a>
                        <figcaption>
                            <span v-if="((item.genderID===10) || (item.genderID===20))" v-html="`${item.genderDesc}.`"></span>
                            <span v-if="((item.flagHabitat===1))" v-html="`${item.imgTitle}.`"></span>
                            <span v-html="`&copy; ${item.copyrightTitle}`"></span>
                        </figcaption>
                    </figure>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>

  import { defineComponent } from 'vue';

  export default defineComponent({
        name: "SpeciesImageGallery",
        data() {
            return {
                imageList: [],
                theSpeciesID: -1, 
                theScientificName: '', 
            }
        },
        props: {
            speciesid: {
                type: Number,
                required: true,
            },
            speciesscientific: {
                type: String,
                required: true,
            },

        },           
        components: {
           
        },
        methods: {
            getImages() 
            {
                let self=this;
                axios.get(`api/species/${this.speciesid}/images`)
                    .then(function(response) {
                        if ((response.data))
                        {
                            self.imageList = response.data.map( (item) => {
                                item.img_sm = "images/" + item.imgPath + "/" + item.imgFN.substr(0, item.imgFN.lastIndexOf(".")) + "_sm." + item.imgFN.substr((item.imgFN.lastIndexOf(".")+1) - item.imgFN.length);
                                item.img_lg = "images/" + item.imgPath + "/" + item.imgFN.substr(0, item.imgFN.lastIndexOf(".")) + "_lg." + item.imgFN.substr((item.imgFN.lastIndexOf(".")+1) - item.imgFN.length);
                                return item;
                            });
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Bildergalerie konnte nicht geladen werden!'
                        })
                    });                    
            }
        },

        mounted() {
            this.theSpeciesID = this.speciesid;
            this.theScientificName = this.speciesscientific;
            if (this.speciesid) 
            {
                this.getImages();
            }
        }
  });


</script>
