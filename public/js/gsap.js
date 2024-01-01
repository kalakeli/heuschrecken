gsap.registerPlugin(ScrollTrigger)

// scroll to top
$(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        $('#btnTop').addClass('show');
    } else {
        $('#btnTop').removeClass('show');
    }
    });

    toTop = () => {
        gsap.to(window, {duration: 1.5, scrollTo: 0, ease: "power3.out"});
    }


// show / hide title in topbar navigation when header is moved to top
$(function() {
    gsap.to('#topbar-title', 
        { 
            scrollTrigger: {
                trigger: '.header', 
                start: 'top top',
                end: 'bottom center',
                scrub: 1,
                toggleAction: 'play pause reset reset',
                // markers: true,
            },
            opacity: 1,
            duration: 1,
        }
    );
});

// hanbdle mobile menu
function shMobileNav() {
    var x = document.getElementById("myNav");
    if (x.className === "nav justify-content-end topbar-ul") {
      x.className += " responsive";
    } else {
      x.className = "nav justify-content-end topbar-ul";
    }
  }
