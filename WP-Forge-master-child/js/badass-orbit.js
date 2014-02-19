/* =========================================================
 * badass-orbit.js
 * =========================================================
 * Authors: Brandon Scott
 * Purpose: Provide javascript behaviors to augment foundation orbit image slider
 * ========================================================= */

jQuery(document).ready(function($) {

    // add classes to appropriate next and previous slides

    $('.badass-orbit .orbit-slides-container li.active').prevWrap().addClass('prev-slide');
    $('.badass-orbit .orbit-slides-container li.active').nextWrap().addClass('next-slide');

    $('.orbit-next, .orbit-prev').on('click', function(){
        
        $('.prev-slide').removeClass('prev-slide');
        $('.next-slide').removeClass('next-slide');

        setTimeout(function(){
            $('.badass-orbit .orbit-slides-container li.active').prevWrap().addClass('prev-slide');
            $('.badass-orbit .orbit-slides-container li.active').nextWrap().addClass('next-slide');        
        }, 300);
    })
})