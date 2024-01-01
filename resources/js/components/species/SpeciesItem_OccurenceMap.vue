<template>
    <div class="row">
        <div class="col-12">
            <h4 class="mb-3 pt-1">
                Nachweise in Deutschland ab 1990</h4>
            <transition name="fade" class="slide-fade">
                <figure v-if="exists">
                    <img :src="`http://loe2.loe.auf.uni-rostock.de/maps/6/vegetweb-style/${this.speciesscientific}.png`" alt="Nachweiskarte" class="img-fluid img-thumbnail">
                    <figcaption class="text-end">
                        <!-- Nachweise von {{ this.speciesscientific }} in Deutschland ab 1990.  -->
                        &copy; Universität Osnabrück
                    </figcaption>
                </figure>
                <div v-else>
                    <div class="row">
                        <div class="col-12 text text-danger">
                            <small>
                                Für diese Art liegt keine Nachweiskarte vor.
                            </small>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>

  import { defineComponent } from 'vue';

  export default defineComponent({
        name: "SpeciesOccurenceMap",
        data() {
            return {
                exists: null,
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
            // Prüfung, ob die Nachweiskarte vorhanden ist, im Callback des Aufrufs 
            // wird entschieden, was zu tun ist -> pointer auf false an dieser Stelle
            checkIfImageExists(url, callback) {
                const img = new Image();
                img.src = url;

                if (img.complete) {
                    callback(true);
                } else {
                img.onload = () => {
                    callback(true);
                };
                
                img.onerror = () => {
                    callback(false);
                };
                }
            }            
        },

        mounted() {
            this.theSpeciesID = this.speciesid;
            this.theScientificName = this.speciesscientific;
            this.checkIfImageExists(`http://loe2.loe.auf.uni-rostock.de/maps/6/vegetweb-style/${this.speciesscientific}.png`, 
                (exists) => {
                    if (exists) {
                        this.exists = true;
                    } else {
                        this.exists = false;
                    }
                }
            ) 
        }
  });


</script>
