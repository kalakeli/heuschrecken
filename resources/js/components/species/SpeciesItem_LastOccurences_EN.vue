<template>
    <transition name="fade" class="slide-fade">
        <div v-if="((occurrences) && (occurrences.length>0))">
            <div class="row">
                <div class="col-12">
                    <form class="row gy-2 gx-3 mb-3 align-items-center">
                        <div class="col-auto">
                            <h4 class="mb-3">
                                <label for="autoSizingInput" class="float-start me-2">Last</label>
                                <select class="btn btn-sm btn-outline-dark float-start me-2" v-model="nrItems">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                <label for="autoSizingInput" class="float-start">recordings</label>
                            </h4>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div v-if="(note==='')"> 
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center scroll-600">
                                <img src="images/icons/ajax_loading.svg" class="mt-4" v-if="loading" alt="loading ...">
                                <div v-if="!loading">
                                    <div class="row" v-for="item in occurrences" :key="item.id">
                                        <div class="col-12" >
                                            <a :href="`https://daten.heuschrecken-portal.de/kartierliste/${item.id}`" target="_blank">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-sm btn-outline-dark text-start mb-2" @mouseover="highlightedItem=item" @mouseout="highlightedItem=null">
                                                        <span class="icon more"></span> |
                                                        <span v-html="new Intl.DateTimeFormat('de-DE').format(new Date(item.date.from))"></span> |
                                                        MTB
                                                        <span v-html="item.locality.position.mtb.mtb"></span> |
                                                    </button>                                        
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Map -->
                            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                                <div id="map" class="rounded map">
                                    <l-map ref="map" v-model:zoom="zoom" v-model:center="center" :useGlobalLeaflet="false"  @update:zoom="zoomUpdated">>
                                        <l-tile-layer :url="url" :attribution="attribution"
                                                    layer-type="base"
                                                    name="Occurrences"></l-tile-layer>
                                        <l-circle  class="layer-circle" v-for="item in circles" :lat-lng="item.center" :radius="item.radius" :color="item.color" :fill-color="item.fillColor" :fill-opacity="item.fillOpacity" :key="item.key" :weight="item.weight">
                                                <l-popup ref="myPopup" >
                                                    <h6 class="text-center">
                                                        <span v-if="item.description" v-html="item.description"></span> 
                                                        <span v-if="item.mtb" v-html="`<small><br>MTB: ${item.mtb}</small>`"></span>
                                                    </h6>
                                                    <hr>
                                                    <a :href="`https://daten.heuschrecken-portal.de/kartierliste/${item.key}`" target="_blank">
                                                        <button class="btn btn-sm btn-custom-darkgreen">
                                                            <span class="icon more"></span>
                                                            show in portal
                                                        </button>
                                                    </a>
                                                </l-popup>                                        
                                        </l-circle>     
                                    </l-map>
                                </div>                                    
                            </div>
                        </div>
                    </div>    
                    <div v-else v-html="note"></div>      
                </div>
            </div>        
        </div>
        <div v-else>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-danger" v-html="note"></div>
                </div>
            </div>                
        </div>
    </transition>   


</template>

<script>

  import { defineComponent } from 'vue';
//   import * as dayjs from 'dayjs'
//   import 'dayjs/locale/de' 

  import { LMap, LTileLayer, LControl, LCircle, LPopup } from "@vue-leaflet/vue-leaflet";
  import "leaflet/dist/leaflet.css";

  export default defineComponent({
        name: "ListOccurrences",
        data() {
            return {
                exists: null,
                highlightedItem: null,                
                loading: false,
                note: '',
                nrItems: 10,
                resultSet: [],
                theOrthopteraID: -1, 
                theSpeciesID: -1, 
                theScientificName: '', 


                isLoaded: false,
                attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                map: null,
                options: {
                    opacity: 0.75,            
                },
                circles: [],  // Funddaten so wie in der Übersichtskarte
                rsResults: [],   // dito
                url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                zoom: 6,
                center: [51.5, 9],                   
            }
        },
        props: {
            speciesid: {
                type: Number,
                required: true,
            },
            orthopteraid: {
                type: Number,
                required: true,
            },
            speciesscientific: {
                type: String,
                required: true,
            },
        },           
        components: {
            LMap,
            LControl,
            LTileLayer,
            LCircle, 
            LCircle,
            LPopup,            
        }, 
        computed: {
            occurrences() {
                if (this.resultSet) 
                {
                    return this.resultSet.map( (item) => {
                        return item.sample;
                    })
                }
            }
        },
        watch: {
            nrItems() {
                if (this.nrItems != this.resultSet.length) 
                {
                    this.getLastOccurrences()
                }
            },
            highlightedItem() 
            {
                if (this.highlightedItem!==null) 
                {
                    this.circles = this.circles.map( (item) => { 
                        if (item.key == this.highlightedItem.id)
                        {
                            item.fillColor = "#000000"
                            item.color = "#000000"
                        }
                        return item;
                    })  
                } 
                else 
                {
                    this.circles = this.circles.map( (item) => { 
                        item.fillColor = "#dc3545"
                        item.color = "#dc3545"
                        return item;
                    })                     
                }
            }            
        },
        methods: {
            // letzte 10 Funde abfragen 
            getLastOccurrences() {
                let self=this;
                self.loading=true;
                $('#cover-spin').show(0);
                axios.get(`${API_URL}/api/species/${self.speciesid}/occurences/last/${self.nrItems}`, { params: {
                        orthopteraID: self.theOrthopteraID
                    }})  
                    .then(function(response) {
                        // console.log(response);
                        if ((response.data) && (response.data.occurrences) && (response.data.occurrences.length>0))
                        {
                            self.resultSet = response.data.occurrences;
                            self.circles = response.data.occurrences.map( (item) => {
                                    return {
                                        key: item.sample.id,
                                        description: new Intl.DateTimeFormat('de-DE').format(new Date(item.sample.date.from)),
                                        // description: dayjs(item.sample.date.from).locale('de').format('DD.MM.YYYY'),
                                        mtb: item.sample.locality.position.mtb.mtb,
                                        color: "#dc3545",
                                        fillColor: "#dc3545",
                                        fillOpacity: 0.8,
                                        center: [item.sample.locality.position.posCenterLatitude, item.sample.locality.position.posCenterLongitude],
                                        radius: 10000,
                                        weight: 1,
                                    }   
                                })                             
                        }
                        else 
                        {
                            self.note = "<h1 style='text-center'>Ups! Entschuldigen Sie, aber ...</h1><p>... zu <em><strong>" + self.$route.params.url + "</strong></em> konnten keine Funde gefunden werden!</p>"
                        }
                        self.loading=false;
                        setTimeout(() => ($('#cover-spin').hide(0)), 400); 
                    })
                    .catch(() => {
                        PersistantToast.fire({
                            icon: 'error',
                            title: 'Funde konnten nicht geladen werden!'
                        })
                        self.loading=false;
                        setTimeout(() => ($('#cover-spin').hide(0)), 400); 
                    });                    
            },

            // map even zoom
            zoomUpdated(zoom) {
                this.zoom = zoom
                let theCircles;
                if (zoom > 11) 
                {
                      theCircles = this.circles.forEach( (item) => { 
                            item.radius = 250  
                      })  
                } 
                else if ((zoom > 9) && (zoom <= 11)) 
                {
                      theCircles = this.circles.forEach( (item) => { 
                            item.radius = 1250  
                      })  
                } 
                else if ((zoom > 7) && (zoom <= 9)) 
                {
                      theCircles = this.circles.forEach( (item) => { 
                            item.radius = 4000  
                      })  
                } 
                else if ((zoom > 5) && (zoom <= 7)) 
                {
                      theCircles = this.circles.forEach( (item) => { 
                            item.radius = 7000  
                      })  
                } 
                else 
                {
                    theCircles = this.circles.forEach( (item) => { 
                          item.radius = 10000  
                    })  
                }
                self.circles = theCircles;
            }            
     
        },

        mounted() {
            // const map = this.$refs.map.mapObject;
            // this.map = map;

            this.theSpeciesID = this.speciesid;
            this.theOrthopteraID = this.orthopteraid;
            this.theScientificName = this.speciesscientific;
            this.getLastOccurrences();

        }
  });


</script>
<style scoped>
    .map {
        border: 1px solid #d9d9d9;
        height: 600px;
        width: 100%;
        position:relative;
    }
    .icon-load {
        position:absolute;
        top: 25%;
        left: 48%;
    }
    .map::before {
        content: '';
    }
</style>
