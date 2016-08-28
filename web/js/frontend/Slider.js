function Slider() {
    var me = this;

    this.toggleClass = "wy-full-images";
    this.slider = $(".unslider");
    this.sliderControls = $(".unslider-arrow");
    this.banner = $(".wy-banner");
    this.moveIcon = $(".wy-banner-move");
    this.details = $(".wy-details");


    $(this.sliderControls).on('click', function () {
        me.expand();
    });

    $(".wy-slider__slide").on('click', function () {
        me.toggle();
    });

    $(this.moveIcon).on('click', function () {
        me.toggle();
    });

    return this;
}


Slider.prototype.expand = function () {
    this.banner.addClass(this.toggleClass);
    this.moveIcon.addClass(this.toggleClass);
    this.details.addClass(this.toggleClass);
};

Slider.prototype.collapse = function () {
    this.banner.removeClass(this.toggleClass);
    this.moveIcon.removeClass(this.toggleClass);
    this.details.removeClass(this.toggleClass);
};

Slider.prototype.toggle = function () {
    this.banner.toggleClass(this.toggleClass);
    this.moveIcon.toggleClass(this.toggleClass);
    this.details.toggleClass(this.toggleClass);
};

