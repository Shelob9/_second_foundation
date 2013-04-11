jQuery(document).ready(function($) {
//http://stackoverflow.com/questions/15534385/slide-two-divs-at-the-same-time/15545241#15545241
    $(document).foundation();
    $(document).ready(function () {
        var fromSlide1 = false;
        var fromSlide2 = false;
        var slider1 = $("#slider1");
        var slider2 = $("#slider2");
        var slider1Prev = slider1.parent().find(".orbit-prev");
        var slider2Prev = slider2.parent().find(".orbit-prev");
        var slider1Next = slider1.parent().find(".orbit-next");
        var slider2Next = slider2.parent().find(".orbit-next");

        slider1Prev.click(function () {
            if (fromSlide1) return;
            fromSlide1 = true;              
            slider2Prev.click();
            fromSlide1 = false;
        });
        slider2Prev.click(function () {
            if (fromSlide2) return;
            fromSlide2 = true;
            slider1Prev.click();
            fromSlide2 = false;
        });
        slider1Next.click(function () {
            if (fromSlide1) return;
            fromSlide1 = true;              
            slider2Next.click();
            fromSlide1 = false;
        });
        slider2Next.click(function () {
            if (fromSlide2) return;
            fromSlide2 = true;
            slider1Next.click();
            fromSlide2 = false;
        });
    });
});