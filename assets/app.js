/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './styles/login.scss';



const $ = require('jquery');

import "@fontsource/roboto-condensed"; // Defaults to weight 400
import "@fontsource/roboto-condensed/400.css"; // Specify weight
import "@fontsource/roboto-condensed/400-italic.css"; // Specify weight and style

global.$ = global.jQuery = $;

import 'jquery-ui/ui/widgets/autocomplete.js';
import 'jquery-ui/ui/widgets/datepicker.js';
import 'jquery-ui/ui/i18n/datepicker-fr.js';
import 'jquery-ui/themes/base/all.css';


import 'bootstrap/dist/js/bootstrap.bundle'
import 'datatables.net'


import './plugins/pace';

const swal = require('sweetalert2');
const swalWithBootstrapButtons = swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success btn-xs sySweetStyle mr-2',
      cancelButton: 'btn btn-secondary btn-xs sySweetStyle'
    },
    buttonsStyling: false
})

global.Swal = swal;
global.swalWithBootstrapButtons = swalWithBootstrapButtons;




// start the Stimulus application
import './bootstrap';
const toastr = require('toastr');
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
global.toastr = toastr;

require('select2')
require('select2/dist/css/select2.min.css')

$.fn.select2.amd.define('select2/i18n/fr',[],require("select2/src/js/select2/i18n/fr"));


import Routing from 'fos-router';

global.Routing = Routing;

// require('pace');

import * as Ladda from 'ladda';
global.ladda = Ladda;

require('ladda/dist/ladda.min.css')

const moment = require('moment');

window.moment = moment;



const axios = require('axios');

import './images/logoHCZ2.png'

import './images/logoHcz.png'
import './images/bg_login.jpg'
import './images/26807.jpg'
import './images/5570863.jpg'





import './images/parametrage/dossiers/logo_HMK.png'
import './images/parametrage/dossiers/logo_HMS.png'
import './images/parametrage/dossiers/logo_HMY.png'
import './images/parametrage/dossiers/logo_HMB.png'
import './images/parametrage/dossiers/_logo_FCZ.png'







$(document).ready(function(){

  $("select").select2();

  // setInterval(checkSession, 5);

  $("#navbarDropdown").on("click", function(){
  
    $("#divMenu").toggle("5ms");
  })
  
  $("html").click(function(e) {
    if ($(e.target).closest('#navbarDropdown').length == 0)
        $("#divMenu").hide("5ms");

  });

  $("body").on("click", ".menuActions" , function(){
    var id = $(this).attr("id");

    $("body #divMenu"+id).toggle("5ms");
    $(".divMenu:not(#divMenu"+id+")").hide();
  })

  $("html").click(function(e) {
    if ($(e.target).closest('.menuActions').length == 0)
        $(".divMenu").hide("5ms");
  });


  const loader = $(".loader-bg");
  global.loader = loader


  function getCurrentDate() {
    const now = new Date();
    return (
        now.getFullYear() + '-' +
        padTo2Digits(now.getMonth() + 1) + '-' +
        padTo2Digits(now.getDate())
    );
  }

  function getCurrentDatetimeLocal() {
    const now = new Date();
    return (
        now.getFullYear() + '-' +
        padTo2Digits(now.getMonth() + 1) + '-' +
        padTo2Digits(now.getDate()) + 'T' +
        padTo2Digits(now.getHours()) + ':' +
        padTo2Digits(now.getMinutes())
    );
  }
  function updateInputValues() {
    $('.current-date').val(getCurrentDate());

    $('.current-datetime').val(getCurrentDatetimeLocal());
  }

  updateInputValues();
  setInterval(updateInputValues, 60000); 


  
})





