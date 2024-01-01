<template>
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <h1>Gespeicherte Bilder etc.</h1>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-2">
                <router-link to="artbilder">
                    <div class="d-grid gap-2">
                        <button class="btn btn-sm btn-dark">&nbsp;&nbsp;Artbilder</button>
                    </div>                    
                </router-link>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-2">
                <router-link to="liste">                
                    <div class="d-grid gap-2">
                        <button class="btn btn-sm btn-dark">&nbsp;&nbsp;Andere Bilder</button>
                    </div>
                </router-link>
            </div>
        </div>

        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
           
        }
    }
</script>
<style scoped>
.router-link-exact-active button:before {
   display: inline-block;
   font-style: normal;
   font-variant: normal;
   text-rendering: auto;
   -webkit-font-smoothing: antialiased;
   font-family: "Font Awesome 5 Free";
   font-weight: 900;
   color: 'inherit'; content: "\f00c";
}
</style>