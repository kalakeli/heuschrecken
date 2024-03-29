<template>
    <div>
        <transition name="fade" class="slide-fade">
            <div class="row" v-if="( (methodList) && (methodList.length>0))">
                <div class="col-12 card-deck justify-center">
                    <div class="card float-start mx-2 mb-3"  style="width: 400px;" v-for="item in methodList" :key="item.methodPKID">
                        <img :src="item.theImg_mi" class="card-img-top" :alt="item.imgTitle" v-if="item.theImg_mi">
                        <div class="card-body">
                            <h4 class="card-title" v-if="((item.methodTitle_EN) && (item.methodTitle_EN.length>0))" v-html="`${item.methodTitle_EN}`"></h4>
                            <h4 class="card-title" v-else v-html="`${item.methodTitle}`"></h4>
                            <small class="card-text" v-if="((item.methodTeaser_EN) && (item.methodTeaser_EN.length>0))" v-html="item.methodTeaser_EN"></small>
                            <small class="card-text" v-else v-html="item.methodTeaser"></small>
                        </div>
                        <div class="card-footer">
                            <p class="text-center mt-3 mb-0 pb-0">
                                <router-link :to="`/methods/${item.methodUrl}`" class="btn btn-sm btn-custom-darkgreen text-white"><span class="icon more"></span> show more</router-link>
                            </p>
                        </div>
                    </div>                
                </div>
            </div>
        </transition>  
    </div>
</template>


<script>

  import { defineComponent } from 'vue';
  export default defineComponent({
        name: "MethodList",
        data() {
            return {
                nrOfEntries: 0,
                methodList: [], 

            }
        },
        components: {
           
        },
        methods: {
            getMethods() {
                let self=this;
                axios.get(`${API_URL}/api/methods`)
                    .then(function(response) {
                        if ((response.data))
                        {
                            // self.items = response.data;
                            self.methodList = response.data.map( (item) => {
                                item.formattedDate = new Intl.DateTimeFormat('de-DE').format(new Date(item.dateOfPublication));
                                return item;
                            });
                            self.nrOfEntries = response.data.length;
                            self.items = response.data;
                        }
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Methodikliste konnte nicht geladen werden!'
                        })
                    });                    
            },
     
        },

        mounted() {
            this.getMethods();
        }
  });


</script>
<style scoped>
.card-deck {
  display: flex;
  flex-wrap: wrap;
  align-items: stretch;
}

.card {
  /* flex: 1 0 auto; */
}
</style>