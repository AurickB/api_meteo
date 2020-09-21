/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
require ('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
const $ = require('jquery');

class DOMAnimation {

    static refreshWeather (){

        const id = 'dedfb42820fae0a5b66e65a71f001bc0';
        let city;
        let temp;
        city = $('#city_search_name').val();
        if (city){
            console.log('city: '+ city)
            let units= '';
            if ($('#metric').is(':checked')){
                units = "&units=metric";
            }
            if ($('#imperial').is(':checked')){
                units = "&units=imperial";
            }
            let  url =  'https://api.openweathermap.org/data/2.5/weather?q=' + city + units +'&appid=' + id +'&lang=fr';
            console.log(url);
            $.ajax(url,{
                method: "POST",
                dataType: 'JSON',
                error: function(){
                    // message utilisateur
                },
                success: function(data){
                    $('#weather').show();

                    temp = data.main.temp;

                    $("#city").text(data.name);
                    $("#country").text(data.sys.country);
                    $("#temp").text(Math.round(temp));
                    $("#pressure").text(data.main.pressure);
                    $("#humidity").text((data.main.humidity))
                },
            })
        } else {
            // gestion erreur si il n'y a pas de ville
        }
    }

    static getTemp() {

        $('#imperial').on('click', DOMAnimation.refreshWeather);

        $('#metric').on('click', DOMAnimation.refreshWeather);
    }
}

function init(){
    DOMAnimation.getTemp();
}

window.onload = init();




console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
