var glide = new Glide('.glide', {
  type: 'slider',
  startAt: 0,
  perView: 2,
  gap: 10,
  focusAt: 0,
  swipeThreshold: 10,
  animationDuration: 1500,
  rewind: false,
  bound: false,
});

glide.mount();