"use strict";

(function () {
  var mmpopupIn = function mmpopupIn() {

    /* REMOVE ALL DUPLICATE IFRAMES FIRST */
    if (document.querySelectorAll('.mm-widget iframe')) {
      document.querySelectorAll('.mm-widget iframe').forEach(function (el) {
        el.remove();
      });
    }
          
    /* THEN RENDER IFRAME */
    var inlines = document.querySelectorAll('.mm-widget');
    // inlines.forEach(element => {
    inlines.forEach(function(element) {
      var quizId = 'quiz-model';
      var url = element.dataset.url;
      var iframe = document.createElement('iframe');
      iframe.src = url;
      iframe.id = quizId;
      iframe.style.cssText = 'padding: 0; border: none; margin: 0 auto; flex-grow: 1; background: url(https://admin.revenuehunt.com/rolling.svg) no-repeat center;';
      element.appendChild(iframe);
      document.getElementById(quizId).onload = function () {
        document.getElementById(quizId).contentWindow.focus();
      };
    });
  };

  var blockPopup = function blockPopup() {
    var links = document.querySelectorAll('a');
    // links.forEach(element => {
    links.forEach(function(element) {
      if (element.href.match(/\#mmquiz\-/)) {
        var quizId = element.href.split('#mmquiz-')[1];

        element.addEventListener('click', function (event) {
          event.preventDefault();
          /* REMOVE ALL IDs FIRST */
          if(document.getElementById(quizId)){
            document.getElementById(quizId).remove();    
          }
          /* THEN RENDER IFRAME */
          mmStartquiz(quizId, false, 'true');
        });
      }
    });
  };
  var mmStartquiz = function mmStartquiz(quizId, resultsId, isPopup) {
   // alert(atob(quizId));
    Cookies.set('quizId', quizId);
    var quizUrl = 'https://script.mirrormate.com/mirrormate_quiz/';
    var modal = document.createElement('div');
    modal.id='main-div';
    modal.style.cssText = "display: block; position: fixed; z-index: 9999999998 !important; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(254,254,254,0.6);";
   /* var close = document.createElement('span');
    close.id='close-div';
    close.innemmTML = '&times;';
    close.style.cssText = "position: fixed; color: #aaaaaa; width: 24px; height: 24px ; background-size: contain ; margin-top: 15px; background-image: url(https://cdn.shopify.com/s/files/1/0350/5894/1996/files/cross-out.png?v=1602495645); z-index: 9999999998 !important; font-size: 50px; font-weight: bold; right: 25px; top: 5px; cursor: pointer;";
  
    close.onclick = function () {
      modal.style.display = 'none';
    };*/
    var iframeUrl = quizUrl + 'public/index.php/mmquiz/'+quizId+'?popup=' + isPopup;

    var content = document.createElement('div');
    content.id = quizId;
    content.className = 'mm-widget';
    content.dataset.url = iframeUrl;
    content.style.cssText = "display: flex; background-color: rgba(254,254,254,0.4); margin: 0; padding: 0; height: 100%;";
    content.style['flex-grow'] = 1;
    // content.onload = 'this.contentWindow.focus()';

    window.onclick = function (event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };

    modal.appendChild(content);
  //  content.appendChild(close);
    // element.parentNode.insertBefore(modal, element);

    document.getElementsByTagName('body')[0].appendChild(modal);
    mmpopupIn();
  };
  var mmApp = function mmApp() {
    blockPopup();
    var hash = window.top.location.hash;

    if (hash.match(/\#mmquiz\-/)) {
      var qId = hash.split('#mmquiz-')[1];
      mmStartquiz(qId, false, 'true');
    }
  };

  mmApp();

  jQuery('#AddToCart-product-template').click(function(){
    var qid = Cookies.get('quizId');
    var price = jQuery('.same-price-step').html();
    //alert(qid);
   // alert(price);
    var url = 'https://script.mirrormate.com/mirrormate_quiz/public/index.php/finish_Quiz';
    var cart = '3';
        var url1 = url+'/'+qid+'/'+cart;
          jQuery.ajax({
              url: url1,
              type: "POST",
              dataType: "html",
              data: {
               _token: "{{ csrf_token() }}",
               price:price
             },
             cache: false,
             success: function(data){ 
             }
           });
  });
})();
