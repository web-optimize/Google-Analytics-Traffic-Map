Instant Analytics Maps

How they work:

We use the PHP API for Google Analytics from http://www.swis.nl/ga/ (LGPL licensed) to request the most active (in terms of visitors) regions of the country, over the last 14 days.  We then generate a Google Static map highlighting these areas; the brightness of the pin correlates with the relative traffic volume.

How do you configure it?

You need to specify:

* Google Analytics Login and Password
* The Google Analytics Profile ID you wish to track.  This is not shown in an obvious place, but the documentation at http://www.google.com/support/forum/p/Google%20Analytics/thread?tid=73f5507df43705db&hl=en will let you find it.

* Optional settings:
-- Filter out non-USA visitors.  If you want just a pretty map of the USA, this is often a good choice
-- Horizontal and Vertical Size of default image
-- Days (base the stats on how long of a measurement window?)
-- Maximum dots to show.  The Google Static Maps system tends to barf if you feed it, say, 1,000 dots.  30-40 seems to be safe.


How do you deploy it?

Simple.  Just reference it as an image-- it comes through as a normal PNG (if it's correctly configured)
<img src="mapgen.php">

Anything you need special?

The PHP-XML extension should be installed-- but that is likely already there on most hosting setups.

Can I see an example?

Sure.  http://autoglassguru.com/mapgen.php

