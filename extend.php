<?php

/*
 * This file is part of duroom/forum-widgets-core.
 *
 * Copyright (c) 2022 NKDuy
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace DuRoom\ForumWidgets;

use DuRoom\Extend;
use DuRoom\Frontend\Document;
use function DuRoom\ForumWidgets\Helper\duroom_cache_is_writable;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less')
        ->content(function (Document $document) {
            $document->payload['duroom-forum-widgets-core.cache_store_writable'] = duroom_cache_is_writable();
        }),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Settings)
        ->serializeToForum('duroom-forum-widgets-core.config', 'duroom-forum-widgets-core.config', function (?string $value): array {
            return $value ? json_decode($value, true) : [];
        })
        ->serializeToForum('duroom-forum-widgets-core.preferDataWithInitialLoad', 'duroom-forum-widgets-core.prefer_data_with_initial_load', 'boolval'),
];
