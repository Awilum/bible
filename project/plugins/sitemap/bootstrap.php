<?php

namespace Flextype\Plugin\Sitemap;

/**
 *
 * Flextype Sitemap Plugin
 *
 * @author Romanenko Sergey / Awilum <awilum@yandex.ru>
 * @link http://flextype.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

include_once 'app/Controllers/SitemapController.php';
include_once 'routes/web.php';
include_once 'dependencies.php';

flextype('entries')::macro('fetchXml', function(string $id, array $options) {
  return ['XML!'];
});

flextype('entries')::macro('fetchExtraData', function ($id, $options) {
    return ['id' => $id, 'options' => $options];
});
