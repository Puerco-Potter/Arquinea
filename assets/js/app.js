import $ from 'jquery';
import * as AnimateIt from '../AnimateIt/js/css3-animate-it.js';
//import 'moment';
import 'bootstrap';

import 'footable/compiled/footable.js';
import 'featherlight/release/featherlight.min.js';
import 'featherlight/release/featherlight.gallery.min.js';
import '../css/app.scss';

$('.footable').footable();

$('a.gallery').featherlightGallery({
    galleryFadeIn: 100,          /* fadeIn speed when slide is loaded */
    galleryFadeOut: 300          /* fadeOut speed before slide is loaded */
});