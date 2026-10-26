import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Tempus from '@studio-freight/tempus'
import Lenis from '@studio-freight/lenis'

const lenis = new Lenis({
  duration: 1.2,
  easing: (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t)), // https://easings.net
  touchMultiplier: 0.5,
  wheelMultiplier: 0.5,
  smoothTouch: false
})

lenis.on('scroll', ScrollTrigger.update)

if (typeof window !== 'undefined') {
  gsap.defaults({ ease: 'none' })
  gsap.registerPlugin(ScrollTrigger)
//  ScrollTrigger.defaults({ markers: process.env.NODE_ENV === 'development' })

  // merge rafs
  gsap.ticker.lagSmoothing(0)
  gsap.ticker.remove(gsap.updateRoot)
  Tempus?.add((time) => {
    gsap.updateRoot(time / 1000)
    lenis.raf(time)
  }, 0)

  // reset scroll position
  window.scrollTo(0, 0)
  window.history.scrollRestoration = 'manual'
}
window.lenis = lenis;

window.addEventListener('beforeunload', (e) => {
  //  document.getElementsByTagName('html')[0].classList.add('loading')
},false)

document.getElementById("content").style.display = "none";
document.getElementsByTagName('html')[0].classList.add('loading')

window.addEventListener('load', () => {
  document.getElementById("content").style.display = "block";
  document.getElementsByTagName('html')[0].classList.remove('loading')



        gsap.utils.toArray('[data-aos="fade"]').forEach((element, i) => {
          //  gsap.set(element, {autoAlpha:0, y: 200})
            const anim = gsap.from(element,
              {
                autoAlpha: 0,
                duration: 0.5,
                ease: "power1.inOut",
              //  delay: box.dataset.delay ? box.dataset.delay: 0
              }
            );

            ScrollTrigger.create({
              trigger: element,
              start: "top 100%",
              animation: anim,
              toggleActions: 'play none none none',
              once: true,
            });


        });

        ScrollTrigger.batch('[data-aos="fade"]', {
          onEnter: batch => gsap.to(batch, {autoAlpha: 1, ease: "power1.inOut", stagger: {each: 0.1}, overwrite: true}),
        //  onLeaveBack: batch => gsap.set(batch, {autoAlpha: 0, y: 200, ease: "power1.inOut", stagger: {each: 0.05}, overwrite: true})
        });

        gsap.utils.toArray('[data-aos="fade-up"]').forEach((element, i) => {
          //  gsap.set(element, {autoAlpha:0, y: 200})
            const anim = gsap.from(element,
              {
                autoAlpha: 0,
                y: 200,
                duration: 0.2,
                ease: "power1.inOut",
              //  delay: box.dataset.delay ? box.dataset.delay: 0
              }
            );
            ScrollTrigger.create({
              trigger: element,
              start: "top 100%",
              animation: anim,
              toggleActions: 'play none none none',
              once: true,
            });


        });

        ScrollTrigger.batch('[data-aos="fade-up"]', {
          onEnter: batch => gsap.to(batch, {autoAlpha: 1, y: 0, ease: "power1.inOut", stagger: {each: 0.1}, overwrite: true}),
        //  onLeaveBack: batch => gsap.set(batch, {autoAlpha: 0, y: 200, ease: "power1.inOut", stagger: {each: 0.05}, overwrite: true})
        });




  const isMobile = !(window.matchMedia('(min-width: 1024px)').matches)

    if (!isMobile) {
      gsap.utils.toArray('.cta.first').forEach(el => {
        gsap.to(el, {
          yPercent: -25,
          ease: "none",
          scrollTrigger: {
            trigger: el,
            scrub: 1
          },
        });
      });

      gsap.utils.toArray('.cta.secound').forEach(el => {
        gsap.to(el, {
          yPercent: 25,
          ease: "none",
          scrollTrigger: {
            trigger: el,
            scrub: 1
          },
        });
      });




      gsap.utils.toArray(".picture").forEach(el => {
          gsap.to(el, {
            y: -100,
            ease: "none",
              scrollTrigger: {
                //  start: "top bottom",
                //  end: "top center",
              //    markers: true,
                  scrub: 1,
                  trigger: el
              },

          })
      })

    }


      gsap.utils.toArray('.counter').forEach(el => {
        gsap.to(el, {
          y: 300,
          ease: "none",
          scrollTrigger: {
            trigger: el,
          //  start: 'center center',
          //  markers: true,
            scrub: 1
          },
        });
      });

      gsap.utils.toArray('[data-aos="parallax"]').forEach(el => {
          gsap.to(el, {
            autoAlpha: 0,
            yPercent: 20,
            ease: "none",
              scrollTrigger: {
                  start: "top top",
                //  markers: true,
                  scrub: true,
                  trigger: el
              },

          })
      })
})