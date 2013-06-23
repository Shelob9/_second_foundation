_Second Foundation
==================
An advanced starter theme with a mobile-first, responsive design. It features AJAX page loads, Infinite Scroll, Masonry blog page, an optional front page slider, full screen backgrounds and user-configurable color options. Can be used as theme as is, but makes a great starter theme for custom designs, as it already has all of the cool features you need built-in.

You can download [version 1.0.4.3 (via WordPress.org)](http://wordpress.org/themes/download/_second-foundation.1.0.4.3.zip). The master branch is currently v1.0.5.3, which is finished and has been submitted to WordPress.org. It is pending review.

Documentation is available via [the wiki](https://github.com/Shelob9/_second_foundation/wiki), which is a work in progress.

New Features In v.1.0.5.x From 1.0.4.x 
======================================
* Full screen image background option. Can also be used for adding a background image to the header and footer.

* Responsive image sizing via Foundation's [Interchange](http://foundation.zurb.com/docs/components/interchange.html).

* More color customizations.

* Functions.php broken up into several files included files for ease of use and child theme override.

* Broke up all script enqueues into separate functions, along with initialization functions so they each have their own action that can be removed by child theme, as well as to improve performance.

* Added ability to use Masonry for blog.

* Separate background image options for header and content area.

* Sanitization functions for customizer. <em>Done</em>.

* Additional links to customizer. <em>Done</em>.

* Ability to move sidebar from left to right, or remove it via option. Can be overridden in templates.

Key Features:
============
* Mobile-first, fully responsive design.

* AJAX page loads.

* Infinite scroll.

* Home Page Slider.

* User options, via the customizer, to disable Infinite Scroll, Home page sider, AJAX page loads and to reconfigure header and menu.

Child Theme
===========
A starter child theme is available [here](https://github.com/Shelob9/second_speaker). It is designed to make it easy to override and if necessary replace scripts, styles and even whole parts of the parent theme's functions library. For more information see (the documentation) [https://github.com/Shelob9/_second_foundation/wiki/The-Great-Deactivator].


[Infinite Scroll Limitations](https://github.com/Shelob9/_second_foundation/wiki/Infinite-scroll)
===========================
* Activating Masonry deactivates, Infinite Scroll. I will make them play nice later.
* If a background image is set for the content area, infinite scroll may add articles on the blog page without the proper background.


Josh Pollock
============
* [Website](http://ComplexWaveform.com)<br />
* [Resume](http://ComplexWaveform.com/jp/Resume)<br />
* [Twitter](http://twitter.com/Josh412)

Foundation
==========
Homepage:      http://foundation.zurb.com<br />
Documentation: http://foundation.zurb.com/docs<br />
Download:      http://foundation.zurb.com/download.php


License Info
============
_Second Foundation is copyright 2013 Josh Pollock.<br />
_Second Foundation is licensed under the terms of the GPL v3.<br />
Underscores http://underscores.me/, (C) 2012-2013 Automattic, Inc.<br />
Underscores, like WordPress, is licensed under the GPLv2.<br />
Infinite Scroll https://github.com/paulirish/infinite-scroll (c) 2012-2013 Paul Irish.<br />
Infinite Scroll is licensed under the terms of the MIT Open Source License.<br />
Foundation http://foundation.zurb.com/, (c) 2013 ZURB.<br />
Foundation is licensed under the terms of the MIT Open Source License.<br />
Browser States https://github.com/browserstate (c) 2011+ by Benjamin Arthur Lupton http://balupton.com/<br />
Browser States is licensed under the terms of the New BSD License (BSD-3).<br />

