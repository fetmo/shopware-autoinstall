<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Aggregation;

use ONGR\ElasticsearchDSL\Aggregation\Bucketing\GeoDistanceAggregation as Base;

/**
 * Class representing geo distance aggregation.
 *
 * @deprecated Aggregations was moved to it's type namespace. Add `Metric` or `Bucketing` after `Aggregation`.
 *     This class will be removed in 3.0.
 */
class GeoDistanceAggregation extends Base
{
}
