const reviewList = document.querySelector('#review-list')
const scrollBtn = document.querySelector('#scroll-to-top')

if ($(reviewList).scrollTop() < 300){
    $(scrollBtn).fadeOut().hide()
}

$(reviewList).scroll(function(){
    if ($(this).scrollTop() > 300) {
        $(scrollBtn).show().fadeIn();
    } else {
        $(scrollBtn).fadeOut().hide();
    }
});

$(scrollBtn).click(function(){
    $(reviewList).animate({scrollTop : 0},360);
    return false;
});