var glide = new Glide('.glide', {
  type: 'slider',
  startAt: 0,
  perView: 2,
  gap: 0,
  focusAt: 0,
  swipeThreshold: 10,
  animationDuration: 800,
  rewind: false,
  bound: false,
  breakpoints: {
      1024:{
      gap:10 
    },
      768:{
      gap:10 
    },
    425:{
      perView:1  
    },
    375: {
      perView: 1
    }
  }
});

glide.mount();

window.addEventListener('load', () => glide.update());
