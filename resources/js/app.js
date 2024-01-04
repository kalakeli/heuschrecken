import './bootstrap';

// window.API_URL = 'http://localhost:8000';
window.API_URL = 'https://www.heuschrecken-monitoring.de/heuschrecken/Live';

import * as Vue from 'vue';
import * as VueRouter from 'vue-router';


// ------------------------------------------------ SWEEETALERT 2 -------------
import swal from 'sweetalert2'
window.Swal = swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000
});
window.Toast = Toast;
const PersistantToast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: null
});
window.PersistantToast = PersistantToast;
const CenteredToast = Swal.mixin({
  toast: true,
  showConfirmButton: false,
  timer: null
});
window.CenteredToast = CenteredToast;

// ------------------------------------------------ jQUERY   ----------------
import jQuery from "jquery";
const $ = jQuery;
window.$ = $;

// ------------------------------------------------ DAYJS -------------------
import * as dayjs from 'dayjs'


// ----------------------------------- MITT (sort of eventBus in vue3) ------
// funktioniert wie das frühere eventBus-System und sollte selbstredend zukünftig bei 
// größeren Projekten vermieden werden
import mitt from 'mitt'
const emitter = mitt()


// ------------------------------------------------ TABLE vue3-easy-data  ---
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

// ------------------------------------------------ COMPONENTS  -------------
import BannerImage from './components/childcomponents/BannerImage.vue';
import LandingProjects from './components/projects/LandingPageProjects.vue';
import LandingOrthopteraWeb from './components/orthopteraweb/LandingPageOrthopteraWeb.vue';
// import MobileNav from './components/childcomponents/MobileNavIcon.vue';


// --------------------------------------------------------
// import ROUTES
let routes = [
    // { path: '/cms/images', name: 'Start', component: () => import('./components/images/ImageList.vue') },
    { path: '/cms/arten', name: 'SpeciesStart', component: () => import('./components/cms/species/SpeciesStart.vue'), 
        redirect: { name: 'SpeciesListCMS'}, 
        children: 
        [
            {
                path: '/cms/arten/liste',   
                name: 'SpeciesListCMS',
                component: () => import('./components/cms/species/SpeciesList.vue')
            },            
            {
                path: '/cms/arten/:id',   
                name: 'SpeciesItemCMS',
                component: () => import('./components/cms/species/SpeciesItem.vue')
            },            
        ]
    },
    { path: '/cms/images', name: 'ImagesStart', component: () => import('./components/cms/images/ImagesStart.vue'), 
        redirect: { name: 'NonSpeciesImageList'}, 
        children: 
        [
            {
                path: '/cms/images/artbilder',   
                name: 'SpeciesImageList',
                component: () => import('./components/cms/images/ImageList.vue')
            },            
            {
                path: '/cms/images/liste',   
                name: 'NonSpeciesImageList',
                component: () => import('./components/cms/images/NonSpeciesImageList.vue')
            },             
        ]
    },
    { path: '/cms/methodik', name: 'MethodStart', component: () => import('./components/cms/methods/MethodStart.vue'), 
        redirect: { name: 'MethodListCMS'}, 
        children: 
        [
            {
                path: '/cms/methodik/liste',   
                name: 'MethodListCMS',
                component: () => import('./components/cms/methods/MethodList.vue')
            },            
            {
                path: '/cms/methodik/:id',   
                name: 'MethodItemCMS',
                component: () => import('./components/cms/methods/MethodItem.vue')
            },            
        ]
    },
    { path: '/cms/projekte', name: 'ProjectStart', component: () => import('./components/cms/projects/ProjectsStart.vue'), 
        redirect: { name: 'ProjectListCMS'}, 
        children: 
        [
            {
                path: '/cms/projekte/liste',   
                name: 'ProjectListCMS',
                component: () => import('./components/cms/projects/ProjectList.vue')
            },            
            {
                path: '/cms/projekte/:id',   
                name: 'ProjectItemCMS',
                component: () => import('./components/cms/projects/ProjectItem.vue')
            },            
        ]
    },
    { path: '/artenliste', name: 'SpeciesStartWeb', component: () => import('./components/species/SpeciesStart.vue'), 
        redirect: { name: 'SpeciesList'}, 
        children: 
        [
            {
                path: '/artenliste',   
                name: 'SpeciesList',
                component: () => import('./components/species/SpeciesList.vue')
            },            
            {
                path: '/artenliste/:url',   
                name: 'SpeciesItemWeb',
                component: () => import('./components/species/SpeciesItem.vue')
            },            
        ]
    },
    { path: '/methodik', name: 'MethodStartWeb', component: () => import('./components/methods/MethodsStart.vue'), 
        redirect: { name: 'MethodListWeb'}, 
        children: 
        [
            {
                path: '/methodik',   
                name: 'MethodListWeb',
                component: () => import('./components/methods/MethodsList.vue')
            },            
            {
                path: '/methodik/:url',   
                name: 'MethodItemWeb',
                component: () => import('./components/methods/MethodItem.vue')
            },            
        ]
    },
    { path: '/projekte', name: 'ProjectStartWeb', component: () => import('./components/projects/ProjectsStart.vue'), 
        redirect: { name: 'ProjectListWeb'}, 
        children: 
        [
            {
                path: '/projekte',   
                name: 'ProjectListWeb',
                component: () => import('./components/projects/ProjectList.vue')
            },            
            {
                path: '/projekte/:url',   
                name: 'ProjectItemWeb',
                component: () => import('./components/projects/ProjectItem.vue')
            },            
        ]
    },
    { 
        // path: '/artenliste', name: 'SpeciesList', component: () => import('./components/species/SpeciesStart.vue') ,
        path: '/artenliste:name', 
        name: 'SpecificSpecies',
        component: () => import('./components/species/SpeciesStart.vue') ,
        // redirect: { name: 'SpeciesOverview' }, // default
        children: 
        [ 
            {
                path: '/artenliste/:name/bilder',   
                name: 'SpeciesPictures',
                component: () => import('./components/species/SpeciesPictures.vue')
            },
            {
                path: '/artenliste/:name/karte',   
                name: 'SpeciesMap',
                component: () => import('./components/species/SpeciesMap.vue')
            },
            {
                path: '/artenliste/:name/funde',   
                name: 'SpeciesObservations',
                component: () => import('./components/species/SpeciesObservations.vue')
            },
        ]
     },


];


// Create the router instance and pass the `routes` option
const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes, // short for `routes: routes`
})


// ------------------------------------------------ CREATE APP -------------
const app = Vue.createApp({})

// add the importent component to the app
app.component( 'banner-image', BannerImage )
app.component( 'landing-projects', LandingProjects )
app.component( 'landing-orthoptera', LandingOrthopteraWeb )
app.component('EasyDataTable', Vue3EasyDataTable)

// Make sure to _use_ the router instance to make the
// whole app router-aware.
app.use(router)
// Emitter
app.config.globalProperties.emitter = emitter;
app.config.globalProperties.dayjs = dayjs;


app.mount('#app')

