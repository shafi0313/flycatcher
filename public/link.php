<?php

$target = "/home/yetfix/public_html/demomarketing/storage/app/public";
$shortcut = "/home/yetfix/public_html/demomarketing/public/storage";
symlink($target, $shortcut);