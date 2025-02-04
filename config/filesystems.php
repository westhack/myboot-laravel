<?php
$storage = require('./params/storage.php');

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => array_get($storage, 'driver', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

        'qiniu' => [
            'driver'  => 'qiniu',
            'domains' => [
                'default' => array_get($storage, 'qiniu_domain'),          //你的七牛域名
                'https'   => '',                              //你的HTTPS域名
                'custom'  => 'static.abc.com',                //Useless 没啥用，请直接使用上面的 default 项
            ],
            'access_key' => array_get($storage, 'qiniu_access_key'),  //AccessKey
            'secret_key' => array_get($storage, 'qiniu_secret_key'),  //SecretKey
            'bucket'     => array_get($storage, 'qiniu_bucket'),  //Bucket名字
            'notify_url' => array_get($storage, 'qiniu_notify_url'),  //持久化处理回调地址
            'access'     => array_get($storage, 'qiniu_access'),  //空间访问控制 public 或 private
            'hotlink_prevention_key' => null, // CDN 时间戳防盗链的 key。 设置为 null 则不启用本功能。
        ],

        'oss' => [
            'driver'        => 'oss',
            'access_id'     => array_get($storage, 'oss_access_id'),
            'access_key'    => array_get($storage, 'oss_access_key'),
            'bucket'        => array_get($storage, 'oss_bucket'),
            'endpoint'      => array_get($storage, 'oss_endpoint'), // OSS 外网节点或自定义外部域名
            //'endpoint_internal' => '<internal endpoint [OSS内网节点] 如：oss-cn-shenzhen-internal.aliyuncs.com>', // v2.0.4 新增配置属性，如果为空，则默认使用 endpoint 配置(由于内网上传有点小问题未解决，请大家暂时不要使用内网节点上传，正在与阿里技术沟通中)
            'cdnDomain'     => array_get($storage, 'oss_domain'), // 如果isCName为true, getUrl会判断cdnDomain是否设定来决定返回的url，如果cdnDomain未设置，则使用endpoint来生成url，否则使用cdn
            'ssl'           => array_get($storage, 'oss_ssl'), // true to use 'https://' and false to use 'http://'. default is false,
            'isCName'       => array_get($storage, 'oss_is_cname'), // 是否使用自定义域名,true: 则Storage.url()会使用自定义的cdn或域名生成文件url， false: 则使用外部节点生成url
            'debug'         => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
