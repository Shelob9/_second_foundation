_Second Foundation
==================
Second Foundation is a starter theme for WordPress by Josh Pollock. It is based on Foundation 4 by ZURB and Underscores (_S) by Automattic.

For the last stable release please download [version 1.0.4.3 (via WordPress.org)](http://wordpress.org/themes/download/_second-foundation.1.0.4.3.zip). The master branch is currently v1.0.5, which should work, but is not completley tested, finished.

1.0.5.1 will be the next version submitted to WordPress.org. See details below.

Documentation is availble via [the wiki](https://github.com/Shelob9/_second_foundation/wiki), which is a work in progress.

Key Features:
============
1) Mobile-first, fully responsive design.<br />
2) AJAX page loads.<br />
3) Infinite scroll.<br />
5) Home Page Slider.<br />
6) User options, via the customizer, to disable Infinite Scroll, Home page sider, AJAX page loads and to reconfigure header and menu.

Child Theme
===========
A starter child theme is availble [https://github.com/Shelob9/second_speaker](here). It is designed to make it easy to overide and if neccasary replace scripts, styles and even whole parts of the parent theme's fucntions library. For more information see [the documentation] (https://github.com/Shelob9/_second_foundation/wiki/The-Great-Deactivator).

New Features In v.1.0.5
==========================
1) Color options via the customizer. <em>Done</em><br />
2) Fully screen backgrounds. <em>Done, but limited by new feature #3.</em><br />
3) Responsive image sizing for full-screen backgrounds to avoid loading a large background image file for mobile. <em>Done-ish.</em>

<strong>1.0.5.1</strong>

1) All images responsive. <em>In Progress using Foudnation Interchange.</e>

2) More color customizations. <em>In Progress on branch redo.options.</em>

3) Breaking up functions into a lib for ease of use and child theme override. <em>Done.</em>

4) Break up all script enqueues into separate functions, along with initialization functions so they each have their own action that can be removed by child theme. Maybe by theme option late. <em>In Progress on branch breakup.enqueues. Almost done, except it broke infinite scroll:(</em>

5) Add option to use Masonry for blog. <em>Done.</em>

6) Redo full screen background using supersize.js since existing method kinda sucks since it tends to distort image.

7) Separate background image options for header and content area. <em>In Progress on branch redo.options. Options exist, not implemented.</em>

8) Sanitization functions for customizer. <em>Done</em>.

9) Additional links to customizer. <em>Done</em>.

10) Move sidebar from left to right, or remove it via option. Can be overridden in templates. <em>Done</em>. Later will build nicer over ride system--per post, per page, etc. For now just add conditional values for $sidebar.



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

