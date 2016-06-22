(function(){
    'use strict';

    // Default scripts
    var app = {
        socialButton:   document.querySelectorAll('.social-share .social-button')
    };

    // Initial configs
    var initialConfigMidia = {

        // Start functions
        init: function(){
            var self = this;
            self.clickSocialLink();
        },

        // socialShare
        socialShare: function(redesocial, url, descricao, hashtag) {
            hashtag = (arguments[3] !== undefined) ? hashtag : '';
            switch (redesocial) {
                case 'facebook':
                    url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&t=' + encodeURIComponent(descricao);
                    break;
                case 'twitter':
                    url = 'https://twitter.com/share?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(descricao) + '&hashtags=' + encodeURIComponent(hashtag);
                    break;
                case 'googleplus':
                    url = 'https://plus.google.com/share?url=' + encodeURIComponent(url);
                    break;
                case 'linkedin':
                    url = 'https://www.linkedin.com/shareArticle?mini=true&url='+ encodeURIComponent(url) +'&title=' + encodeURIComponent(descricao) + '&summary=&source=';
                    break;
                case 'whatsapp':
                    url = 'whatsapp://send?text=' + encodeURIComponent(descricao) + ' ' + encodeURIComponent(url);
                    break;
            }
            var title = (redesocial.charAt(0).toUpperCase() + redesocial.slice(1));
            var width = 600;
            var height = 300;
            var top = ((screen.height - height) / 2);
            var left = ((screen.width - width) / 2);
            var popup = 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left + ',menubar=no,toolbar=no,resizable=no,scrollbars=0';
            window.open(url, title, popup);
        },

        // Click Social link
        clickSocialLink: function(){

            [].forEach.call(app.socialButton, function(el) {
                var redesocial  = el.getAttribute('data-social');
                var url         = el.getAttribute('href');
                var descricao   = el.getAttribute('data-title');
                var hashtag     = el.getAttribute('data-hashtags');

                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    initialConfigMidia.socialShare(redesocial, url, descricao, hashtag);
                });
            });
        }

    };

    initialConfigMidia.init();

})();

