var settings = {
	tl: { radius: 10 },
	tr: { radius: 0 },
	bl: { radius: 0 },
	br: { radius: 0 },
	antiAlias: true
};
/* moooo */
$$('.round').each(function(rd) {
  curvyCorners(settings,rd);
});

