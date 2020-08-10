<?php
/**
 * Created by PhpStorm.
 * User: pe
 * Date: 2020/8/7
 * Time: 16:20
 */

namespace aston_creator\piwigo_sdk_php;


class Images
{
    private $validate;

    public function __construct()
    {
        $this->validate = new validate();
    }

    public function add(string $original_sum, array $param = null)
    {
        $temp = [
            'method' => 'pwg.images.add',
            'original_sum' => Validate::check('original_sum', $original_sum),
        ];

        if (isset($param['original_filename'])) {
            $temp['original_filename'] = Validate::check('original_filename', $param['original_filename']);
        }

        if (isset($param['name'])) {
            $temp['name'] = Validate::check('name', $param['name']);
        }

        if (isset($param['author'])) {
            $temp['author'] = Validate::check('author', $param['author']);
        }

        if (isset($param['date_creation'])) {
            $temp['date_creation'] = Validate::check('date_creation', $param['date_creation']);
        }

        if (isset($param['comment'])) {
            $temp['comment'] = Validate::check('comment', $param['comment']);
        }

        if (isset($param['categories'])) {
            $temp['categories'] = Validate::check('categories', $param['categories']);
        }

        if (isset($param['tag_ids'])) {
            $temp['tag_ids'] = Validate::check('tag_ids', $param['tag_ids']);
        }

        if (isset($param['level'])) {
            $temp['level'] = Validate::check('level', $param['level'], null, 'i');
        }

        if (isset($param['check_uniqueness'])) {
            $temp['check_uniqueness'] = Validate::check('check_uniqueness', $param['check_uniqueness'], null, 'b');
        }

        if (isset($param['image_id'])) {
            $temp['image_id'] = Validate::check('image_id', $param['image_id'], null, 'i');
        }

        return Http::post($temp);
    }

    /**
     * Add a chunk of a file
     * 添加文件块
     * @param string $data base64数据
     * @param string $original_sum 原始标识
     * @param string $position 位置
     * @return mixed
     * @throws \Exception
     */
    public function addChunk(string $data, string $original_sum, string $position)
    {
        return Http::post([
            'data' => Validate::check('data', $data),
            'original_sum' => $original_sum,
            'position' => $position,
            'type' => 'file',
            'method' => 'pwg.images.addChunk'
        ]);
    }

    public function addComment(int $image_id, $content, $key, $author = null)
    {
        return Http::post([
            'image_id' => $image_id,
            'content' => $content,
            'key' => $key,
            'author' => empty($author) ? '' : $author,
            'method' => 'pwg.images.addChunk'
        ]);
    }

    public function addFile(int $image_id, $sum)
    {
        return Http::post([
            'image_id' => $image_id,
            'sum' => $sum,
            'method' => 'pwg.images.addFile'
        ]);
    }

    public function addSimple(array $param = null)
    {
        $array = ['method' => 'pwg.images.addSimple'];

        if (isset($param['category'])) {
            Validate::check('category', $param['category'], '[]', 'i');
            $array['category'] = $param['category'];
        }

        if (isset($param['name'])) {
            Validate::check('name', $param['name']);
            $array['name'] = $param['name'];
        }

        if (isset($param['author'])) {
            Validate::check('author', $param['author']);
            $array['author'] = $param['author'];
        }

        if (isset($param['comment'])) {
            Validate::check('comment', $param['comment']);
            $array['comment'] = $param['comment'];
        }

        if (isset($param['level'])) {
            Validate::check('level', $param['level'], null, 'i');
            $array['level'] = $param['level'];
        }

        if (isset($param['tags'])) {
            Validate::check('tags', $param['tags'], '[]');
            $array['tags'] = $param['tags'];
        }

        if (isset($param['image_id'])) {
            Validate::check('image_id', $param['image_id'], null, 'i');
            $array['image_id'] = $param['image_id'];
        }

        $array['method'] = 'pwg.images.addFile';

        return Http::post($array);
    }

    /**
     * Checks if you have updated version of your files for a given photo, the answer can be "missing", "equals" or "differs".
     * 检查给定照片的文件版本是否更新，答案可能是“缺失”，“等于”或“不同”
     * @param int $image_id
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function checkFiles(int $image_id, array $param = null)
    {
        $array = [
            'image_id' => $image_id,
            'method' => 'pwg.images.checkFiles',
        ];
        if (isset($param['file_sum'])) {
            Validate::check('file_sum', $param['file_sum']);
            $array['file_sum'] = $param['file_sum'];
        }


        return Http::get($array);
    }

    /**
     * Checks if Piwigo is ready for upload.
     * 检查Piwigo是否准备好上传。
     * @return mixed
     */
    public function checkUpload()
    {
        return Http::get([
            'method' => 'pwg.images.checkUpload',
        ]);
    }

    /**
     * Deletes image(s).
     * 删除
     * @param array $image_id
     * @return mixed
     */
    public function delete(array $image_id)
    {
        return Http::post([
            'image_id' => $image_id,
            'method' => 'pwg.images.delete',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ]);
    }

    /**
     * Deletes orphans, by blocks. Returns how many orphans were deleted and how many are remaining.
     * 按块删除孤儿。 返回删除了多少孤儿以及剩余多少孤儿。
     * @param int|null $block_size
     * @return mixed
     */
    public function deleteOrphans(int $block_size = null)
    {
        $param = [
            'method' => 'pwg.images.deleteOrphans',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ];

        if ($block_size != null) {
            $param['block_size'] = $block_size;
        }

        return Http::post($param);
    }

    /**
     * Checks existence of images.
     * 检查图像是否存在
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function exist(array $param = null)
    {
        $array = ['method' => 'pwg.images.exist'];

        if (isset($param['md5sum_list'])) {
            Validate::check('md5sum_list', $param['md5sum_list']);
            $array['md5sum_list'] = $param['md5sum_list'];
        }

        if (isset($param['filename_list'])) {
            Validate::check('filename_list', $param['filename_list']);
            $array['filename_list'] = $param['filename_list'];
        }

        return Http::post($array);
    }

    /**
     * Returns information about an image
     * 返回有关图像的信息
     * @param int $image_id
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function getInfo(int $image_id, array $param = null)
    {
        $array = ['method' => 'pwg.images.getInfo', 'image_id' => $image_id];

        if (isset($param['comments_page	'])) {
            Validate::check('comments_page', $param['comments_page'], null, 'i');
            $array['comments_page	'] = $param['comments_page	'];
        }

        if (isset($param['comments_per_page'])) {
            Validate::check('comments_per_page', $param['comments_per_page'], null, 'i');
            $array['comments_per_page'] = $param['comments_per_page'];
        }

        return Http::get($array);
    }

    /**
     * Rates an image.
     * 为图像评分
     * @param int $image_id
     * @param float $rate
     * @return mixed
     */
    public function rate(int $image_id, float $rate)
    {
        return Http::post([
                'method' => 'pwg.images.rate',
                'image_id' => $image_id,
                'rate' => $rate
            ]
        );
    }

    /**
     * Returns elements for the corresponding query search
     * 返回相应查询搜索的元素
     * @param string $query
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function search(string $query, array $param = null)
    {
        $array = [
            'method' => 'pwg.images.search',
            'query' => $query,
        ];

        if (isset($param['per_page'])) {
            $array['per_page'] = Validate::check('pre_page', $param['per_page'], null, 'i');
        }

        if (isset($param['page'])) {
            $array['page'] = Validate::check('page', $param['page'], null, 'i');
        }

        if (isset($param['order'])) {
            $temp = ['id', 'file', 'name', 'hit', 'rating_score', 'date_creation', 'date_available', 'random'];
            Validate::check('order', $param['order']);
            $array['order'] = Validate::in_array('order', $param['order'], $temp);
        }

        if (isset($param['f_min_rate'])) {
            $array['f_min_rate'] = Validate::check('f_min_rate', $param['f_min_rate'], null, 'f');
        }

        if (isset($param['f_max_rate'])) {
            $array['f_max_rate'] = Validate::check('f_max_rate', $param['f_max_rate'], null, 'f');
        }

        if (isset($param['f_min_hit'])) {
            $array['f_min_hit'] = Validate::check('f_min_hit', $param['f_min_hit'], null, 'i');
        }

        if (isset($param['f_max_hit'])) {
            $array['f_max_hit'] = Validate::check('f_max_hit', $param['f_max_hit'], null, 'i');
        }

        if (isset($param['f_min_ratio'])) {
            $array['f_min_ratio'] = Validate::check('f_min_ratio', $param['f_min_ratio'], null, 'f');
        }

        if (isset($param['f_max_ratio'])) {
            $array['f_max_ratio'] = Validate::check('f_max_ratio', $param['f_max_ratio'], null, 'f');
        }

        if (isset($param['f_max_level'])) {
            $array['f_max_level'] = Validate::check('f_max_level', $param['f_max_level'], null, 'i');
        }

        if (isset($param['f_min_date_available'])) {
            $array['f_min_date_available'] = Validate::check('f_min_date_available', $param['f_min_date_available']);
        }

        if (isset($param['f_max_date_available'])) {
            $array['f_max_date_available'] = Validate::check('f_max_date_available', $param['f_max_date_available']);
        }

        if (isset($param['f_min_date_created'])) {
            $array['f_min_date_created'] = Validate::check('f_min_date_created', $param['f_min_date_created']);
        }

        if (isset($param['f_max_date_created'])) {
            $array['f_max_date_created'] = Validate::check('f_max_date_created', $param['f_max_date_created']);
        }

        return Http::get($param);
    }

    /**
     * Set md5sum column, by blocks. Returns how many md5sums were added and how many are remaining.
     * 设置md5sum列，按块。 返回添加了多少md5sum和剩余多少。
     * @param int|null $block_size
     * @return mixed
     */
    public function setMd5sum(int $block_size = null)
    {
        $param = [
            'method' => 'pwg.images.setMd5sum',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ];
        if ($block_size != null) {
            $param['block_size'] = $block_size;
        }
        return Http::post($param);
    }

    /**
     * Sets the privacy levels for the images.
     * 设置图像的隐私级别
     * @param int $image_id
     * @param int $level
     * @return mixed
     * @throws \Exception
     */
    public function setPrivacyLevel(int $image_id, int $level)
    {
        return Http::post([
            'method' => 'pwg.images.setPrivacyLevel',
            'image_id' => Validate::check('image_id', $image_id, '[]', 'i'),
            'level' => Validate::check('level', $level, null, 'i')
        ]);
    }

    /**
     * Sets the rank of a photo for a given album.
     * 设置给定相册的照片等级
     * @param $image_id
     * @param int $category_id
     * @param int|null $rank
     * @return mixed
     * @throws \Exception
     */
    public function setRank($image_id, int $category_id, int $rank = null)
    {
        $param = [
            'method' => 'pwg.images.setRank',
            'image_id' => Validate::check('image_id', $image_id, '[]', 'i'),
            'category_id' => Validate::check('category_id', $category_id, null, 'i')
        ];
        if ($rank != null) {
            $param['rank'] = $rank;
        }
        return Http::post($param);
    }

    /**
     * Sync metadatas, by blocks. Returns how many images were synchronized
     * 按块同步元数据。 返回同步了多少张图像
     * @param null $image_id
     * @return mixed
     * @throws \Exception
     */
    public function syncMetadata($image_id = null)
    {
        return Http::post([
            'method' => 'pwg.images.syncMetadata',
            'image_id' => Validate::check('image_id', $image_id, '[]', 'i'),
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ]);
    }

    /**
     * Add an image.
     * 添加图像
     * @param string|null $name
     * @param null $category
     * @param int|null $level
     * @return mixed
     * @throws \Exception
     */
    public function upload(string $name = null, $category = null, int $level = null)
    {
        $param = [
            'method' => 'pwg.images.upload',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ];

        if ($name != null) {
            $param['name'] = Validate::check('name', $name);
        }

        if ($category != null) {
            $param['category'] = Validate::check('category', $category, '[]', 'i');
        }

        if ($level != null) {
            $param['level'] = Validate::check('level', $level, null, 'i');
        }


        return Http::post($param);
    }
}