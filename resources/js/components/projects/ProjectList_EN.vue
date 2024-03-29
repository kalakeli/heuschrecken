<template>
    <div>
        <transition name="fade" class="slide-fade">
            <div class="row" v-if="( (projectList) && (projectList.length>0))">
                <div class="col-12 card-deck justify-center">
                    <div class="card float-start mx-2 mb-3" style="width: 403px;" v-for="item in projectList" :key="item.projectPKID">
                        <img :src="item.theImg_mi" class="card-img-top" :alt="item.imgTitle">
                        <div class="card-body">
                            <h4 class="card-title" v-if="((item.projectTitle_EN) && (item.projectTitle_EN.length>0))"  v-html="`<small><small>${item.formattedDate}</small></small>&nbsp; ${item.projectTitle_EN}`"></h4>
                            <h4 class="card-title" v-else v-html="`<small><small>${item.formattedDate}</small></small>&nbsp; ${item.projectTitle}`"></h4>
                            <small class="card-text" v-if="((item.projectTeaser_EN) && (item.projectTeaser_EN.length>0))" v-html="item.projectTeaser_EN"></small>
                            <small class="card-text" v-else v-html="item.projectTeaser"></small>

                        </div>
                        <div class="card-footer">
                            <p class="text-center mt-3 mb-0 pb-0">
                                <router-link :to="`/projects/${item.projectUrl}`" class="btn btn-sm btn-custom-darkgreen text-white"><span class="icon more"></span> show more</router-link>
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
        name: "ProjectList",
        data() {
            return {
                nrOfEntries: 0,
                projectList: [], 

            }
        },
        components: {
           
        },
        methods: {
            getProjects() {
                let self=this;
                axios.get(`${API_URL}/api/projects`)
                    .then(function(response) {
                        if ((response.data))
                        {
                            // self.items = response.data;
                            self.projectList = response.data.map( (item) => {
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
                            title: 'Projektliste konnte nicht geladen werden!'
                        })
                    });                    
            },
     
        },

        mounted() {
            this.getProjects();
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