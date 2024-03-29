<template>
    <div class="row mb-3"  v-if="((picSpecies) && (picSpecies.length>0))">
        <div class="col-12">
            <h4>Artbilder </h4>
            <transition name="fade" class="slide-fade">
                <div>
                    <figure v-for="item in picSpecies" :key="item.imgPKID" class="float-start me-2 mb-2" style="max-width:250px; position:relative;">
                        <span class="icon search" style="position: absolute; top: 10px; right: 10px; color: rgb(0, 0, 0); opacity: 0.5; z-index: 1000;"></span>
                        <a v-if="((item.genderHTML) && (item.genderHTML.length>0))" :href="item.img_lg" data-lightbox="img-gallery" :data-title="`${item.imgTitle} <span style='font-size:larger'>${item.genderHTML}</span> &copy; ${item.copyrightTitle}`">
                            <img :src="item.img_sm" alt="SpeciesPicture" class="img-fluid img-thumbnail">
                        </a>
                        <a v-else :href="item.img_lg" data-lightbox="img-gallery" :data-title="`${item.imgTitle} &copy; ${item.copyrightTitle}`">
                            <img :src="item.img_sm" alt="SpeciesPicture" class="img-fluid img-thumbnail">
                        </a>
                        <figcaption>
                            <!-- <span v-if="((item.genderID===10) || (item.genderID===20))" v-html="`${item.imgTitle} <span style='font-size:larger'>${item.genderHTML}</span>`"></span> -->
                            <!-- <span v-if="((item.flagHabitat===1))" v-html="`${item.imgTitle}`"></span> -->
                            <!-- <span v-html="`&copy; ${item.copyrightTitle}`"></span> -->
                        </figcaption>
                    </figure>
                </div>
            </transition>
        </div>
    </div>
    <div class="row mb-3"  v-if="((picHabitats) && (picHabitats.length>0))">
        <div class="col-12">
            <h4>Habitatbilder </h4>
            <transition name="fade" class="slide-fade">
                <div>
                    <figure v-for="item in picHabitats" :key="item.imgPKID" class="float-start me-2 mb-2" style="max-width:250px; position:relative;">
                        <span class="icon search" style="position: absolute; top: 10px; right: 10px; color: rgb(0, 0, 0); opacity: 0.5; z-index: 1000;"></span>
                        <a v-if="((item.genderHTML) && (item.genderHTML.length>0))" :href="item.img_lg" data-lightbox="img-gallery" :data-title="`${item.imgTitle} <span style='font-size:larger'>${item.genderHTML}</span> &copy; ${item.copyrightTitle}`">
                            <img :src="item.img_sm" alt="SpeciesPicture" class="img-fluid img-thumbnail">
                        </a>
                        <a v-else :href="item.img_lg" data-lightbox="img-gallery" :data-title="`${item.imgTitle} &copy; ${item.copyrightTitle}`">
                            <img :src="item.img_sm" alt="SpeciesPicture" class="img-fluid img-thumbnail">
                        </a>
                        <figcaption>
                            <!-- <span v-if="((item.genderID===10) || (item.genderID===20))" v-html="`${item.imgTitle} <span style='font-size:larger'>${item.genderHTML}</span>`"></span> -->
                            <!-- <span v-if="((item.flagHabitat===1))" v-html="`${item.imgTitle}`"></span> -->
                            <!-- <span v-html="`&copy; ${item.copyrightTitle}`"></span> -->
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
        computed: {

            picSpecies() {
                if ((this.imageList) && (this.imageList.length>0)) 
                {
                    return this.imageList.filter( (item) => {
                        return item.imgPath === "species"
                    })
                }
            }, 
            picHabitats() {
                if ((this.imageList) && (this.imageList.length>0)) 
                {
                    return this.imageList.filter( (item) => {
                        return item.imgPath === "habitats"
                    })
                }
            }
           
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
