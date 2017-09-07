(function() {
    'use strict';

    $(sidebarNav);

    function sidebarNav() {

        var $sidebarNav = $('.sidebar-nav');
        var $sidebarContent = $('.sidebar-content');

        activate($sidebarNav);

        $sidebarNav.on('click', function(event) {
            var item = getItemElement(event);
            // check click is on a tag
            if (!item) return;

            var ele = $(item),
                liparent = ele.parent()[0];

            var lis = ele.parent().parent().children(); // markup: ul > li > a
            // remove .active from childs
            lis.find('li').removeClass('active');
            // remove .active from siblings ()
            $.each(lis, function(idx, li) {
                if (li !== liparent)
                    $(li).removeClass('active');
            });

            var next = ele.next();
            if (next.length && next[0].tagName === 'UL') {
                ele.parent().toggleClass('active');
                event.preventDefault();
            }
        });

        // find the a element in click context
        // doesn't check deeply, asumens two levels only
        function getItemElement(event) {
            var element = event.target,
                parent = element.parentNode;
            if (element.tagName.toLowerCase() === 'a') return element;
            if (parent.tagName.toLowerCase() === 'a') return parent;
            if (parent.parentNode.tagName.toLowerCase() === 'a') return parent.parentNode;
        }

        function activate(sidebar) {
            sidebar.find('a').each(function() {
                var $this = $(this),
                    href = $this.attr('href').replace('#', '');
                if (href !== '' && window.location.href.indexOf('/' + href) >= 0) {
                    var item = $this.parents('li').addClass('active');
                    // Animate scrolling to focus active item
                    $sidebarContent.animate({
                        scrollTop: $sidebarContent.scrollTop() + item.position().top - (window.innerHeight / 2)
                    }, 100);
                    return false; // exit foreach
                }
            });
        }

        var layoutContainer = $('.layout-container');
        var $body = $('body');
        // Handler to toggle sidebar visibility on mobile
        $('.sidebar-toggler').click(function(e) {
            e.preventDefault();
            layoutContainer.toggleClass('sidebar-visible');
            // toggle icon state
            $(this).parent().toggleClass('active');
        });
        // Close sidebar when click on backdrop
        $('.sidebar-layout-obfuscator').click(function(e) {
            e.preventDefault();
            $body.removeClass('sidebar-cover-visible'); // for use with cover mode
            layoutContainer.removeClass('sidebar-visible'); // for use on mobiles
            // restore icon
            $('.sidebar-toggler').parent().removeClass('active');
        });

        // escape key closes sidebar on desktops
        $(document).keyup(function(e) {
            if (e.keyCode === 27) {
                $body.removeClass('sidebar-cover-visible');
            }
        });

        // Handler to toggle sidebar visibility on desktop
        $('.covermode-toggler').click(function(e) {
            e.preventDefault();
            $body.addClass('sidebar-cover-visible');
        });

        $('.sidebar-close').click(function(e) {
            e.preventDefault();
            $body.removeClass('sidebar-cover-visible');
        });

        // remove desktop offcanvas when app changes to mobile
        // so when it returns, the sidebar is shown again
        window.addEventListener('resize', function() {
            if (window.innerWidth < 768) {
                $body.removeClass('sidebar-cover-visible');
            }
        });

    }

})();