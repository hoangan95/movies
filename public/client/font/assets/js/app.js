jQuery(document).ready(function ($) {
    'use strict';

    $(".nice-scroll").niceScroll({
        cursorborder: '',
        cursorcolor: '#040310eb'
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    $("#trailer-modal").on("hidden.bs.modal", function (e) {
        $("#iframe-show-trailer").attr("src", $("#iframe-show-trailer").attr("src"));
    });

    $('.media-slider').slick({
        dots: false,
        infinite: true,
        speed: 1000,
        slidesToShow: 5,
        slidesToScroll: 2,
        prevArrow: "<button type='button' class='slick-prev slick-arrow'></button>",
        nextArrow: "<button type='button' class='slick-next slick-arrow'></button>",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    // dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });


    $('.actors').slick({
        dots: false,
        infinite: true,
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 2,
        prevArrow: "<button type='button' class='slick-prev slick-arrow'></button>",
        nextArrow: "<button type='button' class='slick-next slick-arrow'></button>",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    // dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });


    $("input[name='category']").on("click", function(e) {
        var categories = $('input[name="category"]:checked').map(function() {
            return $(this).val();
          }).get();
          ajaxHome(categories, "", "", "")
    })

    $("input[name='type']").on("click",function(e){
        var type = $('input[name="type"]:checked').map(function() {
            return $(this).val();
          }).get();
          ajaxHome("", type , "", "")
    })

    $("input[name='select_year']").on("click",function(e){
        var year = $('input[name="select_year"]:checked').map(function() {
            return $(this).val();
          }).get();
          ajaxHome("", "",year, "")
    })

    $("input[name='quality']").on("click",function(e){
        var quality = $('input[name="quality"]:checked').map(function() {
            return $(this).val();
          }).get();
          ajaxHome("", "", "", quality)
    })
});

function ajaxHome($category, $type, $year, $quality) {
    const url = $(".movie-render").data("url");

    if(!$category) {
        $category = localStorage.getItem('category');
    } else {
        localStorage.setItem('category', $category);
    }

    if(!$type){
        $type = localStorage.getItem('type');
    } else {
        localStorage.setItem('type', $type);
    }

    if(!$year){
        $year = localStorage.getItem('year');
    } else {
        localStorage.setItem('year', $year);
    }

    if(!$quality){
        $quality = localStorage.getItem('quality');
    } else {
        localStorage.setItem('quality', $quality);
    }
    $.ajax({
        url: url,
        method: "POST",
        dataType: "HTML",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {category: $category, type: $type, year: $year,quality: $quality},
        success: function(response) {
            $(".movie-render").html(response)
        }
    })
}
