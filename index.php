<?php
/**
 * Created by PhpStorm.
 * User: pe
 * Date: 2020/8/7
 * Time: 11:22
 */

require_once 'vendor/autoload.php';

$client = new \aston_creator\piwigo_sdk_php\Client('http://demo.zhanghd.cn', 'zhang', 'a13692045316');

$data = 'iVBORw0KGgoAAAANSUhEUgAAAhwAAABkCAIAAABCcn6uAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3xpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDplZDY3MGUzYy0wY2MwLTRkNDctYTU5Yy1hZmE2Y2VhMmMzMDciIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QzI3Njk5QTQ5RTg2MTFFQTlFMDZGMUQ4NDMzRDYyMjkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QzI3Njk5QTM5RTg2MTFFQTlFMDZGMUQ4NDMzRDYyMjkiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2OTA0MTJCNjM5OUVFQTExOEQyN0E1QjVEMDY5OTYzMiIgc3RSZWY6ZG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOjg4MzJhY2Q0LTIyM2MtYTM0MC1hZDcxLWVmODg3NTU3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';

$original_sum = time();

$position = 1;

$client->images->addChunk($data, $original_sum, $position);

$client->images->add();

var_dump($result);exit;