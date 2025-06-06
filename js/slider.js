const glide = new Glide('.glide', {
  type: 'carousel',
  startAt: 0,
  perView: 1,
  gap:20,
  focusAt:'center',
  swipeThreshold:100,
  animationDuration:1000,
    breakpoints: {
    768: {
      perView: 2
    },
    767:{
        perView:1,
    },
    425:{
        perView: 1,
        gap:10,
    }
  }
    
});
glide.mount();


window.addEventListener('resize', () => {
  glide.update(); // перерахунок ширин
});
//const glide_key = new Glide('.glide_key_more', {
//  type: 'carusel',
//  startAt: 0,
//  perView: 1,
//  gap:20,
//  focusAt:'center',
//  swipeThreshold:10,
//  animationDuration:1000,
//});
//glide_key.mount();

