
new Glider(document.querySelector('.glider'), {
    slidesToShow: 4,
    slidesToScroll: 4,
    dots: '.dots',
    draggable: true,
    duration: 3,
    easing: function (x, t, b, c, d) {
        return c*(t/=d)*t + b;
    },
    arrows: {
        prev: '.glider-prev',
        next: '.glider-next'
    }
    });
