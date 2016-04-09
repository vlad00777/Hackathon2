$(document).ready(function() {
    
$('.go-top').click(function(e){ 
    e.preventDefault();
    $('html,body').animate({ scrollTop: 0 }, 'slow');
});
    
$(".percent-bars-bar").each(function(index,element){
    var el = $(this);
    var percent = el.find('.black').data("percent");
    el.find('.black').css("width",percent)
});
    
    
$('.owl-carousel').owlCarousel({
    items:1,
    margin:0,
    autoHeight:true
});
    
//fix placeholder ie9
  if(!Modernizr.input.placeholder){
    $("input").each(function(){
      if($(this).val()=="" && $(this).attr("placeholder")!=""){
        $(this).val($(this).attr("placeholder"));
        $(this).focus(function(){
          if($(this).val()==$(this).attr("placeholder")) $(this).val("");
        });
        $(this).blur(function(){
          if($(this).val()=="") $(this).val($(this).attr("placeholder"));
        });
      }
    });
  }
    
    $('.wForm').each(function() {
        var formValid = $(this);
        formValid.validate({
            showErrors: function(errorMap, errorList) {
                if (errorList.length) {
                    var s = errorList.shift();
                    var n = [];
                    n.push(s);
                    this.errorList = n;
                }
                this.defaultShowErrors();
            },
            invalidHandler: function(form, validator) {
                $(validator.errorList[0].element).trigger('focus');
                formValid.addClass('no_valid');
            },
            submitHandler: function(form) {
                formValid.removeClass('no_valid');
                if (form.tagName === 'FORM') {
                    form.submit();
                } else {
                    $.ajax({
                        type: 'POST',
                        url: $(form).attr('data-form-url'), /* path/to/file.php */                        
                        data: $(form).find('select, textarea, input').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            
                        },
                        error: function() {
                            console.error('Для верстальщика все ок :)');
                        }
                    });
                }
            }
        });
    });

    /* Без тега FORM */
    $('.wSubmit').on('click', function(event) {
        var form = $(this).closest('.wForm');
        form.valid();
        if (form.valid()) {
            form.submit();
        }
    });
    
    function re() {
        if(Modernizr.mq('(max-width: 800px)')) {
            $('.quotes-block-cols .last').prependTo('.quotes-block-cols').parent();
        } else{
            $('.quotes-block-cols .first').prependTo('.quotes-block-cols').parent();
        }
    }
    re();
    $(window).resize(function(){
        re();
    });

});

$(window).load(function(){
    
       var $container = $('#homepage-grid');
    var $win = $(window),
        $con = $('#homepage-grid'),
        $imgs = $("img.lazy");

    $container.isotope({
        itemSelector: 'article',
        resizable: false,
        filter: '*',
        masonry: {
            isFitWidth: true,
            resizesContainer: true,
            gutter: 20
        },
        transformsEnabled: true,
        transitionDuration: '1s',
    });

    var iso = $container.data('isotope');
    $imgs.lazyload({
        effect: "fadeIn",
        failure_limit: 8,
        skip_invisible: true
    });
    $container.isotope('layout');
    $(window).resize(function (event) {
        setTimeout(function () {
            $container.isotope('layout');
        }, 200);
    });


    $('.cat-links > span').on('click', function (e) {
        var el = $(this);
        if (!el.hasClass('selected')) {
            $('.cat-links > span').removeClass('selected');
            el.addClass('selected');

            var curr = el.data('filter');
            if (curr !== undefined) {
                curr = curr.slice(1);
            }
        }
        if ($('#homepage-grid').length) {
            var filt = el.data('filter');
            $('.b43 > article').removeClass('random');
            var filterValue = el.attr('data-filter');
            console.log(filterValue);
            if (filt != 'all') {
                $container.isotope({
                    filter: '.'+filterValue
                });
            } else {
                $container.isotope({
                    filter: '*'
                });
            }
            var iso = $container.data('isotope');
            var need;
        }
        setTimeout(function () {
            $(window).trigger("scroll");
            $container.isotope('reLayout');
        }, 1000);
        
    });

    $('.top_line3 .top_menu li ').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'a', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });
});