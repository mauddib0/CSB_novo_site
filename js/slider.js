var glide = new Glide('.glide', {
  type: 'carousel',
  startAt: 0,
  perView: 1,
  gap:20,
  focusAt:'center',
swipeThreshold:10,
    animationDuration:1000,
});
glide.mount();