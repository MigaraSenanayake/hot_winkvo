// Sync scrolling between top-scroll and table-scroll
var topScroll = document.getElementById('top-scroll');
var tableScroll = document.getElementById('table-scroll');

topScroll.onscroll = function() {
    tableScroll.scrollLeft = topScroll.scrollLeft;
};

tableScroll.onscroll = function() {
    topScroll.scrollLeft = tableScroll.scrollLeft;
};


