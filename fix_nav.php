<?php
$c = file_get_contents('resources/views/components/nav/layer-2.blade.php');
$p = 'Contact Us
                  </a>
              <span></span><span></span><span></span>';
$r = 'Contact Us
                  </a>
              </nav>
              <button class="navbar-mobile-toggle" id="mobile-toggle" aria-label="Toggle navigation">
                  <span></span><span></span><span></span>';
$c = str_replace($p, $r, $c);
file_put_contents('resources/views/components/nav/layer-2.blade.php', $c);
