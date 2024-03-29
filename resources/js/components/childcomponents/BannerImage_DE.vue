<template>
    <div>
        <figure class="img-banner" v-if="image">
            <img :src="`images/${image.imgPath}/${image.imgFN}`" :alt="`${image.scientificName}`" class="img-fluid rounded bg-page" style="width:100%;">
            <figcaption v-if="theCopyright" v-html="`&copy; ${theCopyright}`"></figcaption>
            <div class="img-info">
              <h2 class="img-info-text" v-if="((theGermanName) && (theGermanName.length>0))">
                <span v-html="theGermanName"></span> <br>
                <small><em v-html="theScientificName"></em></small> <br><br>
                <span v-if="theGenderID===10" class="text-gender icon male"></span>
                <span v-if="theGenderID===20" class="text-gender icon female"></span>
              </h2>
              <a :href="`artenliste/${theGermanName}`">
                  <div class="d-grid gap-2 img-btn px-2">
                        <button class="btn btn-sm btn-custom-darkgreen text-white">Aktuelle Beobachtungen</button>
                  </div> 
              </a>
            </div>

        </figure>

    </div>
</template>

<script>
    export default {
      name: 'BannerImage',

      data() {
        return {
            images: [], 
            theCopyright: '', 
            theImgTitle: '', 
            theGender: '', 
            theEnglishName: '', 
            theGermanName: '', 
            theScientificName: '', 
        }
      },

      computed: {
          // return random image from list of banner images
          image() {
              if ((this.images) && (this.images.length>0)) 
              {
                  let nrImages = this.images.length;
                  let itemNr = Math.floor(Math.random() * nrImages);
                  let theItem = this.images[itemNr];
                  this.theCopyright = theItem.copyrightTitle;
                  this.theGender = theItem.genderHTML;
                  this.theGenderID = theItem.genderID;
                  this.theEnglishName = theItem.englishName;
                  this.theGermanName = theItem.germanName;
                  this.theScientificName = theItem.scientificName;
                  return theItem;
              }
          }
      },

      methods: {

        // Bilder für Banner
        getBannerImages() {
          let self = this;
          axios.get(`api/images/bannerimages`)
            .then(function(response) {
              self.images = response.data;
            });
        },

      },
      mounted() {
        this.getBannerImages();
      }
    }
</script>
