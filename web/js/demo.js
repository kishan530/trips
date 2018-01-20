WebFontConfig = {
  google: { families: [ 'Lato:400,700,300:latin' ] }
};
(function() {
  var wf = document.createElement('script');
  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

// Initialize Share-Buttons
$.contactButtons({
  effect  : 'slide-on-scroll',
  buttons : {
    'facebook':   { class: 'F', use: true, link: 'https://www.facebook.com/JustTripIndia/', extras: 'target="_blank"' },
    'linkedin':   { class: 'L', use: true, link: '' },
    'google':     { class: 'G',    use: true, link: '' },
    'phone':      { class: 'phone',    use: true, link: '+91-9663133008' },
    'email':      { class: 'email',    use: true, link: 'info@justtrip.in' }
  }
});