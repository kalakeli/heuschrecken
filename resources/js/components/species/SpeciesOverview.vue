<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                  Überblick
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
  import { defineComponent } from 'vue';


  export default defineComponent({
    name: "Species",
    data() {
      return {
          speciesList: []
      }
    },
    // props: {
    //     y: {
    //         type: Number,
    //         required: true,
    //     },
    // },      
//   setup(props) {
//     // setup() receives props as the first argument.
//     console.log(props.y)
//   },    
    components: {
  
    }, 
    watch: {
        speciesChange() {
            console.log("species has changed");
        }
    },
    methods: {
      getSpecies() {
          let self=this;
          axios.get(`api/species`)
              .then(function(response) {
                  if ((response.data))
                  {
                      self.speciesList = response.data;
                  }
              })
              .catch(() => {
                  PersistantToast.fire({
                      icon: 'error',
                      title: 'Artenliste konnte nicht geladen werden!'
                  })
              });            
      },           

    }, 
    mounted() {
        console.log("specific species loaded");
        // this.getSpecies();
    }
  });
</script>
