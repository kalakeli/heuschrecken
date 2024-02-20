<template>
    <div class="container">
        <div class="nav-non-mobile" >
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7 col-6">
                    <h1 class="title mb-4">Grasshoppers of Germany</h1>
                    <h4>Department of Biodiversity and Landscape Ecology </h4>
                    <h5>Osnabrück University</h5>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-6">
                    <a href="./" class="nosign">
                        <img src="images/logo_biodiversitymonitoring.png" alt="Logo Biodiversitätsmonitoring" class="img-fluid header-logo mb-5">
                    </a>
                </div>
            </div>
        </div>
        <div class="nav-mobile">
            <div class="mobile-topbar">
                <div class="row">
                    <div class="col-10">
                        <h1 class="title mb-4">Grasshoppers of Germany</h1>
                        <h4>Department of Biodiversity and Landscape Ecology </h4>
                        <h5>Osnabrück University</h5>
                        <br>
                        <a href="./" class="nosign">
                            <img src="images/logo_biodiversitymonitoring.png" alt="Logo Biodiversitätsmonitoring" class="img-fluid header-logo">
                        </a>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-link btn-lg" >
                            <span class="icon hamburger" data-hamburger></span>
                        </button>
                    </div>
                </div>

            </div>
        </div> 
    </div>
</template>

<script>
    export default {
      name: 'EnglishHeader',
      data() {
        return {
        }
      },
      computed: {

      },
      methods: {

      },
      mounted() {

      }
    }
</script>
