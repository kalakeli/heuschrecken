<template>
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Arten</h1>
                <small>
                    Zur Info: Die Darstellung der Verbreitungskarten aus Daten aus Rostock geschieht 
                    über den Artnamen, z.B. <a href="https://loe2.loe.auf.uni-rostock.de/maps/6/vegetweb-style/Stauroderus%20scalaris.png" target="_blank">https://loe2.loe.auf.uni-rostock.de/maps/6/vegetweb-style/Stauroderus%20scalaris.png</a> 
                    Die OrhtopteraWeb-ID wird verwendet für den Abruf der letzten Meldungen. <br><br>
                </small>
            </div>
        </div>

        <!-- children route outlet -->
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            
        }
    }
</script>
