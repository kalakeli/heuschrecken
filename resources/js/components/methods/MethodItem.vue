<template>
    <div>
        <transition name="fade" class="slide-fade">
            <div class="row" v-if="( (theMethods) && (theMethods.length>0))">
                <div v-for="item in theMethods" :key="item.methodPKID">
                    <div class="col-12">
                        <h2 v-html="item.methodTitle" class="mb-3"></h2>
                        <figure v-if="item.imgID>0" class="float-start me-3 mt-2 mb-3" style="max-width:400px;position:relative;">
                            <span class="icon search" style="position:absolute; top:10px; right:10px; color:#000; opacity:.5; z-index:1000;"></span>
                            <a :href="item.img_xl" data-lightbox="gallery" :data-title="`${item.imgTitle}. &copy; ${item.copyrightTitle}`">
                                <img :src="item.theImg_mi" class="img-fluid rounded" :alt="item.imgTitle">
                            </a>
                            <figcaption v-if="item.imgText" >
                                <span v-html="item.imgText"></span>
                                <span v-if="item.copyrightTitle!='anonym'" v-html="`&nbsp;&nbsp; &copy; ${item.copyrightTitle}`"></span>
                            </figcaption>
                        </figure>
                        <template v-if="((item.methodText) && (item.methodText.length>0))">
                            <div v-html="item.methodText"></div>
                        </template>
                    </div>
                </div>
            </div>
        </transition>  
    </div>
</template>


<script>

  import { defineComponent } from 'vue';

  export default defineComponent({
        name: "MethodItem",
        data() {
            return {
                theURL: '',
                theMethods: [], 
            }
        },
        components: {
           
        },
        methods: {
            getMethod(url) {
                let self=this;
                axios.get(`${API_URL}/api/methods/by/url/${url}`)
                    .then(function(response) {
                        if ((response.data))
                        {
                            self.theMethods = response.data.map( (item) => {
                                item.formattedDate = new Intl.DateTimeFormat('de-DE').format(new Date(item.dateOfPublication));
                                item.img_sm = "images/" + item.imgPath + "/" + item.imgFN.substr(0, item.imgFN.lastIndexOf(".")) + "_sm." + item.imgFN.substr((item.imgFN.lastIndexOf(".")+1) - item.imgFN.length);
                                item.img_lg = "images/" + item.imgPath + "/" + item.imgFN.substr(0, item.imgFN.lastIndexOf(".")) + "_lg." + item.imgFN.substr((item.imgFN.lastIndexOf(".")+1) - item.imgFN.length);
                                item.img_xl = "images/" + item.imgPath + "/" + item.imgFN.substr(0, item.imgFN.lastIndexOf(".")) + "_xl." + item.imgFN.substr((item.imgFN.lastIndexOf(".")+1) - item.imgFN.length);
                                                                
                                return item;
                            });
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Eintrag konnte nicht geladen werden!'
                        })
                    });                    
            },
     
        },

        mounted() {

            this.theURL = this.$route.params.url
            this.getMethod(this.theURL);
        }
  });


</script>
