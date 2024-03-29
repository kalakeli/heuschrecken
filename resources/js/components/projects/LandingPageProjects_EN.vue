<template>
    <div>
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="title mt-2 mb-3">Projects</h1>
            </div>
        </div>
        <transition name="fade" class="slide-fade">
            <div v-if="( (projectList) && (projectList.length>0))">
                <div v-for="item in projectList" :key="item.projectPKID">
                    <div class="row" >
                        <div class="col-lg-3 col-md-4 col-sm-5 col-12">
                            <figure v-if="item.theImg_mi">
                                <img :src="item.theImg_mi" class="img-fluid img-thumbnail" :alt="item.imgTitle_EN">
                            </figure>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-7 col-12">
                            <h4  v-html="`<small><small>${item.formattedDate}</small></small>&nbsp; ${item.projectTitle_EN}`"></h4>
                            <small class="card-text" v-html="`${item.projectTeaser_EN}.`"></small>
                            <p>
                                <a :href="`/projects/${item.projectUrl}`" class="btn btn-sm btn-custom-darkgreen text-white"><span class="icon more"></span> show more</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </transition>  
        <div class="row">
            <div class="col-12 text-end">
                <p class="title mt-2 mb-3">
                    <a href="projects">
                        <button class="btn btn-sm btn-custom-lightgreen"> &nbsp;&nbsp;
                            <span class="icon more"></span>
                            to all projects&nbsp;&nbsp;
                        </button>                        
                    </a>
                </p>
            </div>
        </div>        
    </div>
</template>


<script>

  import { defineComponent } from 'vue';
  export default defineComponent({
        name: "LandingPageProjects",
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
                axios.get(`${API_URL}/api/projects/limit/3`)
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