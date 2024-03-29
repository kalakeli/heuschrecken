<template>
    <div class="container-fluid">
 
        <div class="row">
            <div class="col-12">
                <p>
                    The following checklist contains all grasshopper species native to Germany. 
                    According to <span class="authors">Poniatowski et al.</span> (2024) there 
                    are currently 82 species. Of these, 78 species occur in the wild. The remaining 
                    four species had historical occurrences in Germany. They are considered extinct. 
                    The species spectrum of Orthoptera is completed by the European mantis 
                    <em>Mantis religiosa</em> (Linnaeus, 1758). It is the only Mantodea in Germany 
                    with native occurrences. </p>
                <h3>Literature</h3>
                <ul class="pubList">
                    <li>
                        <span class="authors">Poniatowski, D., Detzel, P., Drews, A., Hochkirch, A., Hundertmark, I., 
                        Husemann, M., Klatt, R., Klugkist, H., Köhler, G., Kronshage, A., Maas, S., Moritz, R., Pfeifer, 
                        M. A., Stübing, S. Voith, J., Winkler, C., Wranik, W., Helbing, F. &amp; T. Fartmann</span> (2024): 
                        Rote Liste und Gesamtartenliste der Heuschrecken und Fangschrecken (Orthoptera et Mantodea) Deutschlands. <em>Naturschutz und Biologische Vielfalt</em> 170: 1–88.

                    </li>
                </ul>
                <hr>
            </div>
        </div>       

        <div class="card border-custom-green mt-4 mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-3 col-xs-3 my-3 text-end pt-1">
                        <label for="suche">Suche: </label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9 my-3">
                        <form>
                            <input type="text" class="form-control" placeholder="Suche beginnt ab 3. Buchstaben" v-model="srch" />
                            <p class="pt-2" v-if="((itemList) && (itemList.length===0))">
                                <small class="text-danger ">
                                    Keine Art(en) entspricht dieser Angabe!
                                </small>
                            </p>
                        </form>
                    </div>
                    <!-- <div class="col-12"><hr></div> -->
                </div>    
            </div>    
        </div>    


        <transition name="fade" class="slide-fade">
            <div class="row" v-if="((ensiferaFamilies) && (ensiferaFamilies.length>0))">
                <div class="col-lg-12 col-md-12 col-sm-12 col-6 border-end">
                    <h2 class="text-center">
                        Orthoptera - Grasshoppers, crickets, bush-crickets
                    </h2>
                    <!-- Unterordnungen -->
                    <div class="row">
                        <!-- Langfühlerschrecken -->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <h3 class="my-4">
                                <strong>Ensifera </strong> <small>[Long-horned Orthoptera]</small>
                            </h3>

                            <template v-if="((ensiferaFamilies) && (ensiferaFamilies.length>0))">
                                <div v-for="item in ensiferaFamilies" :key="item.familyID">
                                    <h4>
                                        <strong v-html="item.familyScientific"></strong>  
                                        <small v-if="((item.familyEnglish) && (item.familyEnglish.length>5))" v-html="`&nbsp; [${item.familyEnglish}]`"></small> 
                                    </h4>
                                    <div v-for="el in ensiferaSubFamilies" :key="el.subFamilyID">
                                        <h5 class="mt-3" v-if="el.familyID===item.familyID">
                                            <span v-html="el.subFamilyScientific"></span>
                                        </h5>
                                        <div v-for="species in itemList" :key="species.speciesPKID">
                                            <a :href="`./species/${species.scientificName}`" v-if="species.subFamilyID === el.subFamilyID">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-outline-dark mb-2">
                                                        <em v-html="species.scientificName"></em> 
                                                        <span v-if="((species.englishName) && (species.englishName.length>0))" v-html="` - ${species.englishName}`"></span>
                                                        <small v-html="`<br>${species.author}`"></small>
                                                    </button>
                                                </div>
                                            </a>
                                        </div>   <!-- Ende speciesList -->                                      
                                    </div>   <!-- Ende subFamilies -->                             
                                </div>  <!-- Ende families -->      
                            </template>
                            
                        </div>
                        <!-- Kurzfuehlerschrecken -->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <h3 class="my-4">
                                <strong>Caelifera </strong> <small>[Grasshoppers]</small>
                            </h3>

                            <template v-if="((caeliferaFamilies) && (caeliferaFamilies.length>0))">
                                <div v-for="item in caeliferaFamilies" :key="item.familyID">
                                    <h4>
                                        <strong v-html="item.familyScientific"></strong>
                                        <small v-if="((item.familyEnglish) && (item.familyEnglish.length>5))" v-html="`&nbsp; [${item.familyEnglish}]`"></small> 
                                    </h4>

                                    <div v-for="el in caeliferaSubFamilies" :key="el.subFamilyID">
                                        <h5 class="mt-3" v-if="el.familyID===item.familyID">
                                            <span v-html="el.subFamilyScientific"></span>
                                        </h5>
                                        <div v-for="species in itemList" :key="species.speciesPKID">
                                            <a :href="`./species/${species.scientificName}`" v-if="species.subFamilyID === el.subFamilyID">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-outline-dark mb-2">
                                                        <em v-html="species.scientificName"></em> 
                                                        <span v-if="((species.englishName) && (species.englishName.length>0))" v-html="` - ${species.englishName}`"></span>
                                                        <small v-html="`<br>${species.author}`"></small>
                                                    </button>
                                                </div>
                                            </a>
                                        </div>   <!-- Ende speciesList -->                                       
                                    </div>   <!-- Ende subFamilies -->                             
                                </div>  <!-- Ende families -->      
                            </template>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-6">
                    <h2 class="text-center">
                        Mantodea - Mantids
                    </h2>
                    <!-- Unterordnungen -->
                    <div class="row">
                        <div class="col-12">
                            <h3 class="my-4">
                                &nbsp;
                            </h3>
                                
                            <template v-if="((mantidaFamilies) && (mantidaFamilies.length>0))">
                                <div v-for="item in mantidaFamilies" :key="item.familyID">
                                    <h4>
                                        <strong v-html="item.familyScientific"></strong>
                                        <small v-if="((item.familyEnglish) && (item.familyEnglish.length>5))" v-html="`&nbsp; [${item.familyEnglish}]`"></small> 
                                    </h4>

                                    <div v-for="el in mantidaeSubFamilies" :key="el.subFamilyID">
                                        <h5 class="mt-3" v-if="el.familyID===item.familyID">
                                            <span v-html="el.subFamilyScientific"></span>
                                        </h5>
                                        <div v-for="species in itemList" :key="species.speciesPKID">
                                            <a :href="`./species/${species.scientificName}`" v-if="species.subFamilyID === el.subFamilyID">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-outline-dark mb-2">
                                                        <em v-html="species.scientificName"></em> 
                                                        <span v-if="((species.englishName) && (species.englishName.length>0))" v-html="` - ${species.englishName}`"></span>
                                                        <small v-html="`<br>${species.author}`"></small>
                                                    </button>
                                                </div>
                                            </a>
                                        </div>   <!-- Ende speciesList -->                                       
                                    </div>   <!-- Ende subFamilies -->                             
                                </div>  <!-- Ende families -->      
                            </template>                                         
                        </div>
                    </div>   
                </div>
            </div>
        </transition>
    </div>
</template>


<script>

function dynamicSort(property) {
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        /* next line works with strings and numbers, 
         * and you may want to customize it to your needs
         */
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}


  import { defineComponent } from 'vue';

  export default defineComponent({
    name: "SpeciesList",
    data() {
      return {
          rsList: [],
          speciesList: [], 
          srch: ''
      }
    },
  
    components: {
        
    }, 
    computed: {

        itemList() {
            if ((this.speciesList) && (this.speciesList.length>0)) 
            {
                if (this.srch.length>=3) 
                {
                    return this.speciesList.filter( (item) => {
                         let searchStr = this.srch.toLowerCase();
                         if ((item.englishName.toLowerCase().indexOf(searchStr)!==-1) || 
                             (item.scientificName.toLowerCase().indexOf(searchStr)!==-1) )
                         {
                            return item;
                         }
                    });
                } 
                else 
                {
                    return this.speciesList;
                }
            }
        },

        caeliferaFamilies() {
            if ((this.speciesList) && (this.speciesList.length>0)) 
            {
                let theItems = [];
                let theFamilies = [];
                this.speciesList.forEach( (item) => {
                    if (item.subOrderID===20) // subOrder Caelifera
                    {
                        if (theFamilies.indexOf(item.familyID)===-1) 
                        {
                            theItems.push(
                                {
                                    "familyID": item.familyID,
                                    "familyGerman": item.familyEnglish,
                                    "familyScientific": item.familyScientific,
                                }
                            )
                            theFamilies.push(item.familyID)
                        }
                    }
                })
                theItems.sort(dynamicSort("familyScientific"));                
                return theItems;
            }
        },

        caeliferaSubFamilies() {
            if ((this.speciesList) && (this.speciesList.length>0)) 
            {
                let theItems = [];
                let theSubFamilies = [];
                this.speciesList.forEach( (item) => {
                    if (item.subOrderID===20) // subOrder Caelifera
                    {
                        if (theSubFamilies.indexOf(item.subFamilyID)===-1) 
                        {
                            theItems.push(
                                {
                                    "familyID": item.familyID,
                                    "subFamilyID": item.subFamilyID,
                                    "subFamilyGerman": item.subFamilyGerman,
                                    "subFamilyScientific": item.subFamilyScientific,
                                }
                            )
                            theSubFamilies.push(item.subFamilyID)
                        }
                    }
                })
                theItems.sort(dynamicSort("subFamilyScientific"));                
                return theItems;
            }
        },        

        ensiferaFamilies() {
            if ((this.speciesList) && (this.speciesList.length>0)) 
            {
                let theItems = [];
                let theFamilies = [];
                this.speciesList.forEach( (item) => {
                    if (item.subOrderID===15) // subOrder Ensifera
                    {
                        if (theFamilies.indexOf(item.familyID)===-1) 
                        {
                            theItems.push(
                                {
                                    "familyID": item.familyID,
                                    "familyGerman": item.familyEnglish,
                                    "familyScientific": item.familyScientific,
                                }
                            )
                            theFamilies.push(item.familyID)
                        }
                    }
                })
                theItems.sort(dynamicSort("familyScientific"));                
                return theItems;
            }
        },

        ensiferaSubFamilies() {
            if ((this.speciesList) && (this.speciesList.length>0)) 
            {
                let theItems = [];
                let theSubFamilies = [];
                this.speciesList.forEach( (item) => {
                    if (item.subOrderID===15) // subOrder Ensifera
                    {
                        if (theSubFamilies.indexOf(item.subFamilyID)===-1) 
                        {
                            theItems.push(
                                {
                                    "familyID": item.familyID,
                                    "subFamilyID": item.subFamilyID,
                                    "subFamilyGerman": item.subFamilyGerman,
                                    "subFamilyScientific": item.subFamilyScientific,
                                }
                            )
                            theSubFamilies.push(item.subFamilyID)
                        }
                    }
                })
                theItems.sort(dynamicSort("subFamilyScientific"));                
                return theItems;
            }
        },

        mantidaFamilies() {
            if ((this.speciesList) && (this.speciesList.length>0)) 
            {
                let theItems = [];
                let theFamilies = [];
                this.speciesList.forEach( (item) => {
                    if (item.orderID===11) // subOrder Mantidea
                    {
                        if (theFamilies.indexOf(item.familyID)===-1) 
                        {
                            theItems.push(
                                {
                                    "familyID": item.familyID,
                                    "familyGerman": item.familyEnglish,
                                    "familyScientific": item.familyScientific,
                                }
                            )
                            theFamilies.push(item.familyID)
                        }
                    }
                })
                return theItems;
            }
        },

        mantidaeSubFamilies() {
            if ((this.speciesList) && (this.speciesList.length>0)) 
            {
                let theItems = [];
                let theSubFamilies = [];
                this.speciesList.forEach( (item) => {
                    if (item.subOrderID===11) // subOrder Mantidea
                    {
                        if (theSubFamilies.indexOf(item.subFamilyID)===-1) 
                        {
                            theItems.push(
                                {
                                    "familyID": item.familyID,
                                    "subFamilyID": item.subFamilyID,
                                    "subFamilyGerman": item.subFamilyGerman,
                                    "subFamilyScientific": item.subFamilyScientific,
                                }
                            )
                            theSubFamilies.push(item.subFamilyID)
                        }
                    }
                })
                return theItems;
            }
        },          
        
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
                      self.items = response.data.map( (item) => {
                          item.speciesURL = "./artenliste/" + item.englishName
                          return item;
                      })
                  }
              })
              .catch(() => {
                  PersistantToast.fire({
                      icon: 'error',
                      title: 'Artenliste konnte nicht geladen werden!'
                  })
              });            
      },

      // click in table
      showSpecies(item) {
          console.log("ZEILE angeklickt ... " );
          console.log(item);
      }       

    }, 
    mounted() {
        this.getSpecies();

    }
  });
</script>
